<?php

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'firstname'=> 'Brad',
            'surname'  => 'Reed',
            'username' => 'noisyscanner',
            'email'    => 'noisyscanner@gmail.com',
            'password' => Hash::make('swag123'),
        ]);
    }

}
