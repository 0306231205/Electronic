<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::create([
            "username" => "admin1",
            "password" => Hash::make("123456"),
            "email" => "admin@gmail.com",
            "phone" => "0923117865",
            "role" => 1,
            "status" => 1,
            "name" => "Nguyen Minh B"
        ]);
    }
}
