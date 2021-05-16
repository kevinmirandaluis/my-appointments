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
        'password' => bcrypt('123123'), // password
        'role' => 'admin'

    ]);

    User::create([
        'name' => 'Doctor Test',
        'email' => 'doctor@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('123123'), // password
        'role' => 'doctor'

    ]);

        User::create([
        'name' => 'Paciente Test',
        'email' => 'patient@gmail.com',
        'email_verified_at' => now(),
        'password' => bcrypt('123123'), // password
        'role' => 'patient'

    ]);


  	factory(User::class, 50)->states('patient')->create();

    }
}
