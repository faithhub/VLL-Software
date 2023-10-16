<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createMultipleUsers = [
            ['name' => 'Teacher', 'email' => 'teacher@gmail.com', 'status' => 'active', 'role' => 'teacher', 'password' => Hash::make('12345678')],
        ];

        $teacher = User::where(['email' => 'teacher@gmail.com'])->get();
        if ($teacher->count() == 0) {
            User::insert($createMultipleUsers);
        }
    }
}
