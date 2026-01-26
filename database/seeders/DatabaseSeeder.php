<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        // Users - Use updateOrCreate to avoid duplicates
        $admin = User::updateOrCreate(
            ['aa_email' => 'admin@example.com'],
            [
                'aa_name' => 'Admin User',
                'aa_password' => bcrypt('password'),
                'aa_role' => 'admin',
            ]
        );
        
        
    

      
    }
}
