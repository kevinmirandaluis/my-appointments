<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


    	User::create([
		'name' => 'Kevin Miranda',
        'email' => 'kevin151720@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('kevin123123'), // password
        'dni' => '72410052',
        'address' => '',
        'phone' => '',
        'role' => 'admin'

    ]);


  	factory(User::class, 50)->create();

    }
}
