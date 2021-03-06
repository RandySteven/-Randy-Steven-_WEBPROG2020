<?php

use App\User;
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
        $admin = User::create([
            'name' => 'Pak Gober',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'phone_number' => '0812345678',
        ]);

        $admin->assignRole('admin');
    }
}
