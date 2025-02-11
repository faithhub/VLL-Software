<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ZoomController extends Controller
{

    public function __construct()
    {
    }
    

    public function index(Request $request)
    {
        // dd(Carbon::now()->addSeconds(3599), $settings['zoom_access_token']);

        if (!$request->code) {
            $this->get_oauth_step_1();
        } else {
            $getToken = $this->get_oauth_step_2($request->code);

            $params = [
                'zoom_code' => $request->code,
                'zoom_access_token' => $getToken['access_token'],
                'zoom_refresh_token' => $getToken['refresh_token'],
                'zoom_refresh_token_expires' => Carbon::now()->addSeconds($getToken['expires_in']),
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



            $get_zoom_details = $this->create_a_zoom_meeting([
                'topic'      => 'Interview With Code-180',
                'start_time' => date('Y-m-dTh:i:00') . 'Z',
                'agenda'     => "We are having interview with @code-180",
                'jwtToken'   => $getToken['access_token'],
            ]);

            return $get_zoom_details;
            return view('welcome')->with('respond', json_encode($get_zoom_details));
        }
    }

    private function get_oauth_step_1()
    {
        $redirectURL  = 'http://127.0.0.1:8000/zoom-meeting-create';
        $authorizeURL = 'https://zoom.us/oauth/authorize';
        $clientID     = env("ZOOM_CLIENT_ID");
        $clientSecret = env("ZOOM_CLIENT_SECRECT");
        // dd($clientID, "dffddf");
        $authURL = $authorizeURL . '?client_id=' . $clientID . '&redirect_uri=' . $redirectURL . '&response_type=code&scope=&state=xyz';
        header('Location: ' . $authURL);
        exit;
    }

    private function get_oauth_step_2($code)
    {
        $tokenURL    = 'https://zoom.us/oauth/token';
        $redirectURL = 'http://127.0.0.1:8000/zoom-meeting-create';
        $clientID     = env("ZOOM_CLIENT_ID", "MThuvyIZQiSaw7V7uWLp5w");
        $clientSecret = env("ZOOM_CLIENT_SECRECT", "Xw5TT71QNZwm9tucT3gUbYE3BvYET1v8");
        $curl   = curl_init();
        $params = array(
            CURLOPT_URL => $tokenURL . "?"
                . "code=" . $code
                . "&grant_type=authorization_code"
                . "&client_id=" . $clientID
                . "&client_secret=" . $clientSecret
                . "&redirect_uri=" . $redirectURL,
            CURLOPT_RETURNTRANSFER      => true,
            CURLOPT_MAXREDIRS           => 10,
            CURLOPT_TIMEOUT             => 30,
            CURLOPT_HTTP_VERSION        => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST       => "POST",
            CURLOPT_NOBODY              => false,
            CURLOPT_HTTPHEADER          => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
                "accept: *",
            ),
        );
        curl_setopt_array($curl, $params);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        return $response;
    }

    private function create_a_zoom_meeting($meetingConfig = [])
    {
        $requestBody = [
            'topic'      => $meetingConfig['topic'] ?? 'New Meeting General Talk',
            'type'       => $meetingConfig['type'] ?? 2,
            'start_time' => $meetingConfig['start_time'] ?? date('Y-m-dTh:i:00') . 'Z',
            'duration'   => $meetingConfig['duration'] ?? 30,
            'password'   => $meetingConfig['password'] ?? mt_rand(),
            'timezone'   => 'Asia/Kolkata',
            'agenda'     => $meetingConfig['agenda'] ?? 'Interview Meeting',
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

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Skip SSL Verification
        curl_setopt_array($curl, array(
            CURLOPT_URL            => "https://api.zoom.us/v2/users/me/meetings",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => json_encode($requestBody),
            CURLOPT_HTTPHEADER     => array(
                "Authorization: Bearer " . $meetingConfig['jwtToken'],
                "Content-Type: application/json",
                "cache-control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return [
                'success'  => false,
                'msg'      => 'cURL Error #:' . $err,
                'response' => null,
            ];
        } else {
            return [
                'success'  => true,
                'msg'      => 'success',
                'response' => json_decode($response, true),
            ];
        }
    }
}
