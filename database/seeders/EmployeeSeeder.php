<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'employee_id' => 'EMP001',
                'name' => 'John Doe',
                'email' => 'john.doe@company.com',
                'password' => bcrypt('password'),
            ],
            [
                'employee_id' => 'EMP002',
                'name' => 'Jane Smith',
                'email' => 'jane.smith@company.com',
                'password' => bcrypt('password'),
            ],
            [
                'employee_id' => '1001',
                'name' => 'Rakib',
                'email' => 'rakib@company.com',
                'password' => bcrypt('Qwerty@@9876'),
            ],
        ];

        foreach ($employees as $employee) {
            Employee::firstOrCreate(['employee_id' => $employee['employee_id']], $employee);
        }
    }
}
