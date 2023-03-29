<?php

namespace Database\Seeders;
use App\Models\User;
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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'rol' => 'Admin'     
        ])->assignRole('Admin');

        User::factory(9)->create();

        User::create([
            'name' => 'Student',
            'email' => 'student@school.com',
            'password' => bcrypt('student123'), 
            'rol' => 'Student' 
        ])->assignRole('Student');

        User::factory(9)->create();

        User::create([
            'name' => 'Teacher',
            'email' => 'teacher@school.com',
            'password' => bcrypt('teacher123'),
            'rol' => 'Teacher'   
        ])->assignRole('Teacher');

        User::factory(9)->create();
    }
}
