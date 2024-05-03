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
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Stevebauman\Location\Facades\Location;
use hisorange\BrowserDetect\Parser as Browser;

class MeetingController extends Controller
{

    public function settings()
    {
        try {
            $settings =
                Setting::all([
                    'key', 'value'
                ])
                ->keyBy('key')
                ->transform(function ($setting) {
                    return $setting->value;
                });

            if (Carbon::now() >= $settings['zoom_refresh_token_expires']) {

                $params = "code=" . $settings['zoom_code'] . "&grant_type=refresh_token&refresh_token=" . $settings['zoom_refresh_token'];
                // $params = [
                //     'grant_type' => 'refresh_token',
                //     'code' => $settings['zoom_code'],
                //     'refresh_token' => $settings['zoom_refresh_token']
                // ];
                // dd($settings, $params, $settings['zoom_refresh_token_expires'], 'fff');
                // dd($settings, $params, $settings['zoom_refresh_token_expires']);
                $response = Http::withHeaders([
                    'Authorization' => 'Basic ' . base64_encode($settings['zoom_client_id'] . ':' . $settings['zoom_client_secret']),
                    'Content-Type'  => 'application/x-www-form-urlencoded',
                ])
                    ->post('https://zoom.us/oauth/token', $params);

                $data = $response->json();
                if ($response->status() == 200) {

                    $params = [
                        'zoom_access_token' => $data['access_token'],
                        'zoom_refresh_token' => $data['refresh_token'],
                        'zoom_refresh_token_expires' => Carbon::now()->addSeconds($data['expires_in']),
                    ];

                    foreach ($params as $key => $value) {
                        $settings = Setting::where('key', $key)->first();
                        if (empty($settings)) {
                            $req = array("key" => $key, "value" => $value);
                            Setting::create($req);
                        } else {
                            $settings->value = $value;
                            $settings->save();
                        }
                    }

                    return
                        Setting::all([
                            'key', 'value'
                        ])
                        ->keyBy('key')
                        ->transform(function ($setting) {
                            return $setting->value;
                        });
                } else {
                    return false;
                }
            } else {

                //code...
                return $settings;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
            //throw $th;
        }
    }

    public function refress_access_token()
    {
        try {
            //code...
            $settings = $this->settings();
            $params = "code=" . $settings['zoom_code'] . "&grant_type=refresh_token&refresh_token=" . $settings['zoom_refresh_token'];
            // $params = [
            //     'grant_type' => 'refresh_token',
            //     'code' => $settings['zoom_code'],
            //     'refresh_token' => $settings['zoom_refresh_token']
            // ];
            // dd($settings, $params, $settings['zoom_refresh_token_expires'], 'fff');
            // dd($settings, $params, $settings['zoom_refresh_token_expires']);
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($settings['zoom_client_id'] . ':' . $settings['zoom_client_secret']),
                'Content-Type'  => 'application/x-www-form-urlencoded',
            ])
                ->post('https://zoom.us/oauth/token', $params);

            $data = $response->json();
            if ($response->status() == 200) {

                $params = [
                    'zoom_access_token' => $data['access_token'],
                    'zoom_refresh_token' => $data['refresh_token'],
                    'zoom_refresh_token_expires' => Carbon::now()->addSeconds($data['expires_in']),
                ];

                foreach ($params as $key => $value) {
                    $settings = Setting::where('key', $key)->first();
                    if (empty($settings)) {
                        $req = array("key" => $key, "value" => $value);
                        Setting::create($req);
                    } else {
                        $settings->value = $value;
                        $settings->save();
                    }
                }
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
            //throw $th;
        }
    }

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
        // Webex::create([
        //     'refresh_token' => Crypt::encryptString("ODZiYmFiZGQtNTkxOC00ZDk0LWI3ZTQtNGY1NThhZDNiMWQ1NTY3ZWY2MjYtYWQ0_PE93_8419c701-37c9-4dbf-b218-12dcd2362fa6"),
        //     'baseURL' => Crypt::encryptString("https://webexapis.com/v1"),
        //     'client_id' => Crypt::encryptString("C65a8125a8e6f4a5ee0abf414876ac23404b5e22437850a6e2c925977101db161"),
        //     'client_secret' => Crypt::encryptString("41029563be946aad75e3f0f9ef6e37681046e237e04b6e9520960b4e2ae4214f"),
        //     'redirect_uri' => Crypt::encryptString("https://virtuallawlibrary.com/"),
        //     'access_token' => Crypt::encryptString("NDI1ZGEwNTgtYzE0ZC00MzgyLTkxNWEtODVkNTZiY2JkZGE4MTMyNzcxNTktNmE5_PE93_8419c701-37c9-4dbf-b218-12dcd2362fa6"),
        //     'access_token_expires' => Crypt::encryptString(Carbon::now()->addSeconds("2023-12-10 21:13:16")->format('Y-m-d H:i:s')),
        //     'refresh_token_expires' => Crypt::encryptString(Carbon::now()->addSeconds("2024-02-10 21:13:16")->format('Y-m-d H:i:s')),
        //     'refresh_token_active' => true,
        //     'access_token_active' => true,
        // ]);
        // Webex::create([
        //     'refresh_token' => Crypt::encryptString("DQ4M2RkZmItN2NiZi00OWUyLWI4YzUtOTZhYWFkM2IyNzE4NTRkMGE4ZTEtZDk0_PE93_8419c701-37c9-4dbf-b218-12dcd2362fa6"),
        //     'baseURL' => Crypt::encryptString("https://webexapis.com/v1"),
        //     'client_id' => Crypt::encryptString("C8d8e2787e4bc4fb9ccd20f0c5db3ed00b340fab128168581282ea2d50273d1a7"),
        //     'client_secret' => Crypt::encryptString("c685d4aa33aa2fb34f34cf4d7522db58b6292bf06f8683c3f507c6bc32b09f7a"),
        //     'redirect_uri' => Crypt::encryptString("https://virtuallawlibrary.com/"),
        //     'access_token' => Crypt::encryptString("NDYyN2I0NTItYTIyNy00YzdhLTg1OGEtOTYxM2FkMDhlMDU0NTdiZTE4OWItN2Q0_PE93_8419c701-37c9-4dbf-b218-12dcd2362fa6"),
        //     'access_token_expires' => Crypt::encryptString(Carbon::now()->addSeconds("2023-11-26 21:13:16")->format('Y-m-d H:i:s')),
        //     'refresh_token_expires' => Crypt::encryptString(Carbon::now()->addSeconds("2024-02-10 21:13:16")->format('Y-m-d H:i:s')),
        //     'refresh_token_active' => true,
        //     'access_token_active' => true,
        // ]);
        try {
            $data['title'] = "Classes";
            $data['date_now'] = Carbon::now();
            $data['meetings'] = Meeting::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
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
            // $ip = $request->getClientIp();
            // $loc = Location::get($ip);
            // dd(Carbon::now()->timezone($loc->timezone ?? "Africa/Lagos")->addSeconds(3599), $loc);

            if ($_POST) {
                $rules = array(
                    'university_id' => ['required', 'string', 'max:255'],
                    'title' => ['required', 'string', 'max:50', 'min:3'],
                    'duration' => ['required'],
                    'password' => ['required', 'string', 'min:5', 'max:10'],
                    'start' => ['required'],
                    // 'start' => ['required', 'before:end'],
                    // 'end' => ['required', 'after:start']
                );

                $messages = [
                    'title.required' => "The Class Title is required",
                    'title.string' => "The Class Title must be string",
                    'title.max' => "The Class Title must not more than 50 characters",
                    'title.min' => "The Class Title must not less than 3 characters",
                    'password.min' => "The Class Password must not less than 5 characters",
                    'password.max' => "The Class Password must not more than 20 characters",
                    'start.required' => "The Class Start Date is required",
                    'start.before' => "The Class Start Date must be a date before the Class End Date",
                    // 'end.after' => "The Class End Date must be a date after the Class Start date",
                    // 'end.required' => "The Class End Date is required",
                ];

                $validator = Validator::make($request->all(), $rules, $messages);

                if ($validator->fails()) {
                    Session::flash('warning', __('All fields are required'));
                    return back()->withErrors($validator)->withInput();
                }

                $start = Carbon::parse($request->start)->format('Y-m-d H:i:s');
                // $end = Carbon::parse($request->end)->format('Y-m-d H:i:s');
                $title = $request->title;
                $duration = $request->duration;
                $password = $request->password ?? Str::random(10);

                $params = [
                    'topic' => $title,
                    'type'  => 2,
                    'start_time' => $start,
                    'duration' => $duration,
                    'password' => $password,
                    'settings'   => [
                        'host_video'        => false,
                        'participant_video' => true,
                        'cn_meeting'        => false,
                        'in_meeting'        => false,
                        'join_before_host'  => true,
                        'mute_upon_entry'   => true,
                        'watermark'         => false,
                        'use_pmi'           => false,
                        'approval_type'     => 0,
                        'registration_type' => 0,
                        'audio'             => 'voip',
                        'auto_recording'    => 'none',
                        'waiting_room'      => false,
                    ],
                ];

                // $this->refress_access_token();

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $this->settings()['zoom_access_token'],
                    'Content-Type'  => 'application/json',
                    'cache-control' => 'no-cache',
                ])
                    ->withOptions([
                        'verify' => false, // Skip SSL verification
                    ])
                    ->post('https://api.zoom.us/v2/users/me/meetings', $params);

                if ($response->successful()) {
                    $meeting = Meeting::create([
                        'user_id' => Auth::user()->id,
                        'university_id' => $request->university_id,
                        'MTID' => $response->json()['id'],
                        'link' => $response->json()['join_url'],
                        'title' => $title,
                        'status' => $response->json()['status'],
                        'start' => $start,
                        'token' => md5(Str::orderedUuid()),
                        'end' => $duration,
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
                        'version' => $meeting->token,
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

                    Session::flash('success', 'Class created successfully');
                    return redirect()->route('teacher.meetings');
                } else {
                    $data['err_msg'] = $err_msg = $response->json()['message'] ?? "Something went wrong";
                    Session::flash('error', $err_msg);
                    return back()->withInput();
                }
            }
            //code...
            $data['title'] = "Create Class";
            return View('dashboard.teacher.meetings.create', $data);
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('teacher');
            //throw $th;
        }
    }


    public function view($id)
    {
        # code...
        try {
            $data['meeting'] = $meeting = Meeting::where(['user_id' => Auth::user()->id, 'id' => $id])->first();

            $data['date_now'] = Carbon::now();
            if (!$meeting) {
                Session::flash('error', "No record");
                return back();
            }

            $data['meetingDetails'] = $meetingDetails = MeetingDetail::where('meeting_id', $meeting->id)->first();

            // $webex_data = $this->refress_token();
            // $baseURL =  Crypt::decryptString($webex_data->baseUrl);
            // $access_token =  Crypt::decryptString($webex_data->access_token);


            // $token = "Bearer " . $access_token;
            // $baseURL = $baseURL . "/meetings";
            // $response = Http::accept('application/json')->withHeaders([
            //     'Authorization' => $token,
            // ])->get($baseURL);
            // $response->json();
            // dd($response->json());



            // $baseURL = $baseURL . "/meetings/" . $meeting->MTID;
            // $response2 = Http::accept('application/json')->withHeaders([
            //     'Authorization' => $token,
            // ])->get('https://webexapis.com/v1/meetings/postMeetingChats', ['meetingId' => $meeting->MTID]);
            // $response2->json();

            // $response3 = Http::accept('application/json')->withHeaders([
            //     'Authorization' => $token,
            // ])->get('https://webexapis.com/v1/meetingParticipants', ['meetingId' => $meeting->MTID]);
            // $response3->json();

            // // dd($response3->json());
            // $response = Http::accept('application/json')->withHeaders([
            //     'Authorization' => $token,
            // ])->get($baseURL);
            // $response->json();

            // $data['meeting_res'] = $meeting_res = $response->json();

            // if (!empty($response3->json())) {
            //     $data['participants'] = $participants = $response3->json()['items'] ?? [];
            // } else {
            // }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->settings()['zoom_access_token'],
                'Content-Type'  => 'application/json',
                'cache-control' => 'no-cache',
            ])
            ->withOptions([
                'verify' => false, // Skip SSL verification
            ])
            ->get('https://api.zoom.us/v2/meetings/' . $meeting->MTID);

            // dd($response->json());
            $data['participants'] = $participants = [];

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

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->settings()['zoom_access_token'],
                'Content-Type'  => 'application/json',
                'cache-control' => 'no-cache',
            ])
                ->withOptions([
                    'verify' => false, // Skip SSL verification
                ])
                ->delete('https://api.zoom.us/v2/meetings/' . $meeting->MTID);
            // ->delete('https://api.zoom.us/v2/meetings/75438753466');

            // dd($meeting, $meetingDetails);
            // dd($meeting, $meetingDetails, $response->json());
            // dd($response->json());
            // $webex_data = $this->refress_token();
            // $baseURL =  Crypt::decryptString($webex_data->baseUrl);
            // $access_token =  Crypt::decryptString($webex_data->access_token);


            // $token = "Bearer " . $access_token;
            // $baseURL = $baseURL . "/meetings/" . $meeting->MTID;
            // $response = Http::accept('application/json')->withHeaders([
            //     'Authorization' => $token,
            // ])->delete($baseURL);
            // $response->json();

            // if ($response->status() != 204) {
            //     # code...
            //     $data['err_msg'] = $err_msg = $response->json()['message'];
            //     $data['webex_errors'] = $webex_errors = $response->json()['errors'];
            //     Session::flash('error', $err_msg);
            //     return back()->withInput()->with(['webex_errors' => $webex_errors]);
            // }

            Material::where('publisher', $meeting->id)->delete();
            $meeting->delete();
            $meetingDetails->delete();

            Session::flash('success', 'Class deleted successfully');
            return redirect()->route('teacher.meetings');
        } catch (\Throwable $th) {
            Session::flash('warning', $th->getMessage());
            return back() ?? redirect()->route('teacher');
            dd($th->getMessage());
            //throw $th;
        }
    }

    public function create_meeting($data, $date, $timezone, $time)
    {
        try {
            //code...
            $start = Carbon::parse($date . ' ' . $time)->format('Y-m-d H:i:s');
            // $end = Carbon::parse($request->end)->format('Y-m-d H:i:s');
            $title = $data['title'];
            // return [$data, $dates[0], $title];
            $duration = 60;
            $password = Str::random(10);

            $params = [
                'topic' => $title,
                'type'  => 2,
                'start_time' => $start,
                'duration' => $duration,
                'password' => $password,
                'timezone' => $timezone,
                'host_email' => Auth::user()->email,
                'settings'   => [
                    'host_video'        => false,
                    'participant_video' => true,
                    'cn_meeting'        => false,
                    'in_meeting'        => false,
                    'join_before_host'  => true,
                    'mute_upon_entry'   => true,
                    'show_share_button' => false,
                    'watermark'         => false,
                    'use_pmi'           => false,
                    'approval_type'     => 0,
                    'registration_type' => 0,
                    'audio'             => 'voip',
                    'auto_recording'    => 'none',
                    'waiting_room'      => false,
                ],
            ];

            // $this->refress_access_token();

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->settings()['zoom_access_token'],
                'Content-Type'  => 'application/json',
                'cache-control' => 'no-cache',
            ])
                ->withOptions([
                    'verify' => false, // Skip SSL verification
                ])
                ->post('https://api.zoom.us/v2/users/me/meetings', $params);

            if ($response->successful()) {
                $meeting = Meeting::create([
                    'user_id' => Auth::user()->id,
                    // 'university_id' => $request->university_id,
                    'MTID' => $response->json()['id'],
                    'link' => $response->json()['join_url'],
                    'title' => $title,
                    'status' => $response->json()['status'],
                    'start' => $start,
                    'token' => md5(Str::orderedUuid()),
                    'end' => $duration,
                    'details' => $response->json(),
                    'password' => $password
                ]);

                MeetingDetail::create([
                    'meeting_id' => $meeting->id,
                ]);

                return ['meeting' => $meeting, 'status' => true];
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
            return false;
        }
    }
}