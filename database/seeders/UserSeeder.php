<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
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
            'jun',
        ];

        foreach ($users as $user) {
            $user = User::create(['name' => $user, 'password' => bcrypt('password'), 'email' => "$user@mail.com", 'approved_at' => now()]);
            Profile::create(['user_id' => $user->id, 'address' => 'Tarlac', 'phone' => '0912180883', 'description' => 'nothing', ]);
        }
    }
}
