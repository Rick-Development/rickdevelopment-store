<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'firstname' => 'Mr',
            'lastname' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'address' => null,
            'password' => Hash::make('Admin@123'), // new hashed password
            'balance' => 0.00,
            'avatar' => 'images/avatars/IznVolJNmnIP15R_1763882748.png',
            'facebook_id' => null,
            'google_id' => null,
            'microsoft_id' => null,
            'vkontakte_id' => null,
            'envato_id' => null,
            'github_id' => null,
            'is_admin' => 1,
            'was_subscribed' => 0,
            'email_verified_at' => now(),
            'kyc_status' => 0,
            'google2fa_status' => 0,
            'google2fa_secret' => null,
            'status' => 1,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
