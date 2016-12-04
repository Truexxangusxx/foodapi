<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
                'name' => 'carlos',
                'email' => 'angus@mail.com',
                'password' => Hash::make('123456')
            ]
        ];

        foreach ($users as $user){
            \App\User::create($user);
        }
    }
}
