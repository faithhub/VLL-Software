<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Meeting;
use App\Models\MeetingDetail;
use App\Models\Webex;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Offlineagency\LaravelWebex\LaravelWebex;

class MeetingController extends Controller
{

    public function refress_token()
    {
        try {
            //code...
            $webex = Webex::first();

            if (!$webex) {
                # code...
                return false;
            }

            $baseURL =  Crypt::decryptString($webex->baseUrl);
            $client_id =  Crypt::decryptString($webex->client_id);
            $client_secret =  Crypt::decryptString($webex->client_secret);
            $redirect_uri =  Crypt::decryptString($webex->redirect_uri);
            $refresh_token =  Crypt::decryptString($webex->refresh_token);
            $access_token_active =  $webex->access_token_active;

            if (!$access_token_active) {
                $response = Http::post($baseURL . "/access_token", [
                    'client_id' => $client_id,
                    'client_secret' => $client_secret,
                    'refresh_token' => $refresh_token,
                    'grant_type' => "refresh_token",
                    'redirect_uri' => $redirect_uri,
                ]);
                if ($response->status() == 200) {
                    $response_data = $response->json();
                    $webex->refresh_token = Crypt::encryptString($response_data['refresh_token']);
                    $webex->access_token = Crypt::encryptString($response_data['access_token']);
                    $webex->access_token_expires = Crypt::encryptString(Carbon::now()->addSeconds($response_data['expires_in'])->format('Y-m-d H:i:s'));
                    $webex->refresh_token_expires = Crypt::encryptString(Carbon::now()->addSeconds($response_data['refresh_token_expires_in'])->format('Y-m-d H:i:s'));
                    $webex->refresh_token_active = true;
                    $webex->access_token_active = true;
                    $webex->save();
                    return $webex;
                } else {
                    return $response;
                }
            }
            return $webex;
        } catch (\Throwable $th) {
            return $th->getMessage();
            //throw $th;
        }
    }

    public function bearerToken()
    {
        $header = $this->header('Authorization', '');
        if (Str::startsWith($header, 'Bearer ')) {
            return Str::substr($header, 7);
        }
    }

    public function index(Request $request)
    {
        # code...
        try {
            $data['title'] = "Meetings";
            $data['date_now'] = Carbon::now();
            $data['meetings'] = Meeting::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
            return View('dashboard.teacher.meetings.index', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('teacher');
            dd($th);
            //throw $th;
        }
    }

    public function create(Request $request)
    {
        try {
            if ($_POST) {
                $rules = array(
                    'university_id' => ['required', 'string', 'max:255'],
                    'title' => ['required', 'string', 'max:50', 'min:5'],
                    'password' => ['required', 'string', 'min:5', 'max:20'],
                    'start' => ['required', 'before:end'],
                    'end' => ['required', 'after:start']
                );

                $messages = [
                    'title.required' => "The Meeting Title is required",
                    'title.string' => "The Meeting Title must be string",
                    'title.max' => "The Meeting Title must not more than 50 characters",
                    'title.min' => "The Meeting Title must not less than 10 characters",
                    'password.min' => "The Meeting Password must not less than 5 characters",
                    'password.max' => "The Meeting Password must not more than 20 characters",
                    'start.required' => "The Meeting Start Date is required",
                    'start.before' => "The Meeting Start Date must be a date before the Meeting End Date",
                    'end.after' => "The Meeting End Date must be a date after the Meeting Start date",
                    'end.required' => "The Meeting End Date is required",
                ];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                $start = Carbon::parse($request->start)->format('Y-m-d H:i:s');
                $end = Carbon::parse($request->end)->format('Y-m-d H:i:s');
                $title = $request->title;
                $password = $request->password ?? Str::random(10);

                $params = [
                    'title' => $title,
                    'start' => $start,
                    'end' => $end,
                    'password' => $password
                ];


                $webex_data = $this->refress_token();
                $baseURL =  Crypt::decryptString($webex_data->baseUrl);
                $access_token =  Crypt::decryptString($webex_data->access_token);

                $token = "Bearer " . $access_token;
                $response = Http::accept('application/json')->withHeaders([
                    'Authorization' => $token,
                ])->post($baseURL . "/meetings", $params);
                $response->json();

                if ($response->status() != 200) {
                    # code...
                    $data['err_msg'] = $err_msg = $response->json()['message'];
                    $data['webex_errors'] = $webex_errors = $response->json()['errors'];
                    Session::flash('error', $err_msg);
                    return back()->withInput()->with(['webex_errors' => $webex_errors]);
                }

                $meeting = Meeting::create([
                    'user_id' => Auth::user()->id,
                    'university_id' => $request->university_id,
                    'MTID' => $response->json()['id'],
                    'link' => $response->json()['webLink'],
                    'title' => $title,
                    'start' => $start,
                    'end' => $end,
                    'details' => $response->json(),
                    'password' => $password
                ]);

                MeetingDetail::create([
                    'meeting_id' => $meeting->id,
                ]);

                Material::create([
                    'user_id' => Auth::user()->id,
                    'title' => $title,
                    'version' => $request->version ?? null,
                    'citation' => 'new_meeting',
                    'publisher' => $meeting->id,
                    'price' => 'free',
                    'amount' => $request->amount ?? null,
                    'material_type_id' => 5,
                    'year_of_publication' => 0,
                    'privacy_code' => $password,
                    'test_country_id' => Auth::user()->country_id,
                    'university_id' => Auth::user()->university_id,
                    'uploaded_by' => 'teacher',
                    'material_cover_id' => null,
                ]);

                Session::flash('success', 'Meeting created successfully');
                return redirect()->route('teacher.meetings');
            }
            //code...
            $data['title'] = "";
            return View('dashboard.teacher.meetings.create', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('teacher');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function view($id)
    {
        # code...
        try {
            $data['meeting'] = $meeting = Meeting::where(['user_id' => Auth::user()->id, 'id' => $id])->first();

            if (!$meeting) {
                Session::flash('error', "No record");
                return back();
            }

            $data['meetingDetails'] = $meetingDetails = MeetingDetail::where('meeting_id', $meeting->id)->first();

            $webex_data = $this->refress_token();
            $baseURL =  Crypt::decryptString($webex_data->baseUrl);
            $access_token =  Crypt::decryptString($webex_data->access_token);


            $token = "Bearer " . $access_token;
            // $baseURL = $baseURL . "/meetings";
            // $response = Http::accept('application/json')->withHeaders([
            //     'Authorization' => $token,
            // ])->get($baseURL);
            // $response->json();
            // dd($response->json());



            $baseURL = $baseURL . "/meetings/" . $meeting->MTID;
            // $response2 = Http::accept('application/json')->withHeaders([
            //     'Authorization' => $token,
            // ])->get('https://webexapis.com/v1/meetings/postMeetingChats', ['meetingId' => $meeting->MTID]);
            // $response2->json();

            $response3 = Http::accept('application/json')->withHeaders([
                'Authorization' => $token,
            ])->get('https://webexapis.com/v1/meetingParticipants', ['meetingId' => $meeting->MTID]);
            $response3->json();

            // dd($response3->json());
            $response = Http::accept('application/json')->withHeaders([
                'Authorization' => $token,
            ])->get($baseURL);
            $response->json();

            $data['meeting_res'] = $meeting_res = $response->json();

            if (!empty($response3->json())) {
                $data['participants'] = $participants = $response3->json()['items'];
            } else {
                $data['participants'] = $participants = [];
            }

            // if ($response->status() != 200) {
            //     # code...
            //     $data['err_msg'] = $err_msg = $response->json()['message'];
            //     $data['webex_errors'] = $webex_errors = $response->json()['errors'];
            //     Session::flash('error', $err_msg);
            //     return back()->withInput()->with(['webex_errors' => $webex_errors]);
            // }
            // dd($response->json(), $response->json()['id'], $response2->json(), $response3->json());

            // dd($response3->json(), $response3->status());
            return View('dashboard.teacher.meetings.view', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('teacher');
            dd($th);
            //throw $th;
        }
    }

    public function delete($id)
    {
        # code...
        try {
            $meeting = Meeting::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
            $meetingDetails = MeetingDetail::where('meeting_id', $meeting->id)->first();

            $webex_data = $this->refress_token();
            $baseURL =  Crypt::decryptString($webex_data->baseUrl);
            $access_token =  Crypt::decryptString($webex_data->access_token);


            $token = "Bearer " . $access_token;
            $baseURL = $baseURL . "/meetings/" . $meeting->MTID;
            $response = Http::accept('application/json')->withHeaders([
                'Authorization' => $token,
            ])->delete($baseURL);
            $response->json();

            if ($response->status() != 204) {
                # code...
                $data['err_msg'] = $err_msg = $response->json()['message'];
                $data['webex_errors'] = $webex_errors = $response->json()['errors'];
                Session::flash('error', $err_msg);
                return back()->withInput()->with(['webex_errors' => $webex_errors]);
            }

            Material::where('publisher', $meeting->id)->delete();
            $meeting->delete();
            $meetingDetails->delete();
            
            Session::flash('success', 'Meeting deleted successfully');
            return redirect()->route('teacher.meetings');
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('teacher');
            dd($th->getMessage());
            //throw $th;
        }
    }
}