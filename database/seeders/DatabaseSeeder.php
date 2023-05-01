<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            // UserSeeder::class,
            BankSeeder::class,
            // PostSeeder::class,
            // CommentSeeder::class,
        ]);

        // Setting::create([
        //     // [
        //     'key' => 'rent',
        //     'value' => 700,
        //     // ],
        //     // [
        //     //     'key' => 'paystack_public_key',
        //     //     'value' => 'pk_test_93253e4094828ef15dfd864b9decb3dfceb75a8f',
        //     // ],
        //     // [
        //     //     'key' => 'usd_rate',
        //     //     'value' => 650,
        //     // ]
        // ]);
    }
}