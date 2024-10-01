<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Employee;

class HealthCheckSeeder extends Seeder
{
    public function run()
    {
        // Create some companies
        Company::create([
            'name' => 'Company A',
            'email' => 'contact@companya.com',
            'website' => 'https://companya.com',
            'logo' => null // Add path if you have logos
        ]);

        Company::create([
            'name' => 'Company B',
            'email' => 'contact@companyb.com',
            'website' => 'https://companyb.com',
            'logo' => null // Add path if you have logos
        ]);

        // Create some employees
        Employee::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company_id' => 1, // Assuming Company A has ID 1
            'email' => 'john.doe@companya.com',
            'phone' => '1234567890',
            'profile_picture' => null // Add path if you have profile pictures
        ]);

        Employee::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'company_id' => 2, // Assuming Company B has ID 2
            'email' => 'jane.smith@companyb.com',
            'phone' => '0987654321',
            'profile_picture' => null // Add path if you have profile pictures
        ]);
    }
}
