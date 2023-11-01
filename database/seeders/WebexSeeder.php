<?php

namespace Database\Seeders;

use App\Models\Webex;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class WebexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createMultipleUsers = [
            [
                'client_id' => Crypt::encryptString("C8d8e2787e4bc4fb9ccd20f0c5db3ed00b340fab128168581282ea2d50273d1a7"),
                'client_secret' => Crypt::encryptString("c685d4aa33aa2fb34f34cf4d7522db58b6292bf06f8683c3f507c6bc32b09f7a"),
                'redirect_uri' => Crypt::encryptString("https://virtuallawlibrary.com/"),
                'refresh_token' => Crypt::encryptString("NDQ4M2RkZmItN2NiZi00OWUyLWI4YzUtOTZhYWFkM2IyNzE4NTRkMGE4ZTEtZDk0_PE93_8419c701-37c9-4dbf-b218-12dcd2362fa6"),
                'code' => Crypt::encryptString(""),
                'baseUrl' => Crypt::encryptString("https://webexapis.com/v1"),
                'access_token' => Crypt::encryptString(""),
                'access_token_expires' => Crypt::encryptString(""),
                'refresh_token_expires' => Crypt::encryptString(""),
                'refresh_token_active' => true,
                'access_token_active' => true,
            ],
        ];

        $teacher = Webex::first();

        if (!$teacher) {
            Webex::insert($createMultipleUsers);
        }
    }
}
