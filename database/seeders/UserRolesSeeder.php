<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class UserRolesSeeder extends Seeder
{
    public function run()
    {
        // Create roles if they don't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'users']);

        // Admin user
        User::create([
            'firstname' => 'admin',
            'lastname' => 'first',
            'phoneNumber' => '1234567890',
            'status' => 'inprogress',
            'state' => 'Jammu and Kashmir',
            'hobbies' => 'reading,coding',
            'gender' => 'male',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
        ])->roles()->attach($adminRole->id);

        // Regular user
        User::create([
            'firstname' => 'Sadaf',
            'lastname' => 'Sajad',
            'phoneNumber' => '6005000000',
            'status' => 'inprogress',
            'state' => 'Jammu and Kashmir',
            'hobbies' => 'reading,coding',
            'gender' => 'female',
            'email' => 'sadaf@gmail.com',
            'password' => Hash::make('123456'),
            'images' => 'user_images/4r2hnZjjxhAyTHJUYSPtwoujpdbs2ZNQIjwfAMbj.jpg,user_images/3bk8JCw8lfKqKEGhmyr2ROF3PUmzTYDlGtYRMJ1c.jpg',
        ])->roles()->attach($userRole->id);
    }
}
