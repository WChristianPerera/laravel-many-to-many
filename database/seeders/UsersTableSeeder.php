<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'example',
                'email' => 'example@example.example',
                'password' => Hash::make('example'),
            ],
            [
                'name' => 'example2',
                'email' => 'example2@example.example',
                'password' => Hash::make('example2'),
            ],
        ];

        foreach ($users as $user_data) {
            
            User::create($user_data);

        }
    }
}
