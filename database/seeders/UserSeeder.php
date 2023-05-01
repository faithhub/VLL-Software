<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createMultipleUsers = [
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'status' => 'active', 'role' => 'admin', 'password' => Hash::make('12345678')],
        ];

        $admin = User::where(['status' => 'admin', 'email' => 'admin@gmail.com'])->get();
        if ($admin->count() == 0) {
            User::insert($createMultipleUsers);
        }
    }
}
