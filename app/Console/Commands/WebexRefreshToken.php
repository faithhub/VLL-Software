<?php

namespace App\Console\Commands;

use App\Models\Webex;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;

class WebexRefreshToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webex:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate Webex Access Token from Refresh Token saved';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

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
        $access_token =  Crypt::decryptString($webex->access_token);
        $access_token_expires =  Crypt::decryptString($webex->access_token_expires);
        $refresh_token_expires =  Crypt::decryptString($webex->refresh_token_expires);
        $refresh_token_active =  $webex->refresh_token_active;
        $access_token_active =  $webex->access_token_active;

        $now = Carbon::now();
        $check_access_token = $access_token_expires;
        $check_refresh_token = $refresh_token_expires;

        if ($now > $check_access_token) {
            $webex->access_token_active = false;
            $webex->save();
        }

        if ($now > $check_refresh_token) {
            $webex->refresh_token_active = false;
            $webex->save();
        }

        //Check if token has expired and set the value to false;
        if (!$access_token_active) {
            if ($now > $check_access_token) {
                $webex->access_token_active = false;
                $webex->save();
            }
        }
        if (!$refresh_token_active) {
            if ($now > $check_refresh_token) {
                $webex->refresh_token_active = false;
                $webex->save();
            }
        }

        //Check if the days interval is less than 3 days
        $check_days_left = $now->diffInDays($check_access_token);
        //Refresh token
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
            return true;
        } else {
            return false;
        }

        $this->info('Token has been refreshed successfully');
    }
}
