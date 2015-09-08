<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'name' => 'user',
            'email' => 'user@user.local',
            'password' => 0,
            'location' => '',
        ]);
    }

}