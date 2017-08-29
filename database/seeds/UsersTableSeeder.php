<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::Class)->create([
            'first_name' => 'Daniel',
            'last_name' => 'Leach',
            'email' => 'danielkleach@gmail.com',
            'password' => 'Test123'
        ]);
    }
}
