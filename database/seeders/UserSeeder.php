<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'william',
            'leo',
        ];

        foreach ($users as $user) {
            \App\Models\User::create(['name' => $user, 'password' => bcrypt('password'), 'email' => "$user@mail.com"]);
        }
    }
}
