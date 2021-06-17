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
        $user = App\User::create([

            'name' => 'ahmad',
            'email' => 'ahmad@gmail.com',
            'password' => bcrypt('ahmad12345')
        ]);
    }
}
