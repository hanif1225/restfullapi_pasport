<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
           'name'     => 'admin',
           'role'     => 'admin',
           'email'    => 'admin@gmail.com',
           'password' => bcrypt('admin123'),
           'created_at' => now(),
           'updated_at' => now()
       ]);

       User::create([
           'name'     => 'customer1',
           'role'     => 'customer',
           'email'    => 'customer1@gmail.com',
           'password' => bcrypt('customer123'),
           'created_at' => now(),
           'updated_at' => now()
       ]);

       User::create([
           'name'     => 'customer2',
           'role'     => 'customer',
           'email'    => 'customer2@gmail.com',
           'password' => bcrypt('customer123'),
           'created_at' => now(),
           'updated_at' => now()
       ]);


    }
}
