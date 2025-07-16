<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        Staff::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => md5('12345678') // Using MD5 as per the login controller
        ]);

        // Regular staff user
        Staff::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => md5('password123')
        ]);
    }
}
