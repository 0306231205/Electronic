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
            "email" => "admin1@gmail.com",
            "phone" => "1234567892",
            "role" => 1,
            "status" => 0,
            "name" => "Nguyen Van L"
        ]);
    }
}
