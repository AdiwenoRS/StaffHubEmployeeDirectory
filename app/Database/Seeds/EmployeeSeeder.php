<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'       => 'Alice Smith',
                'email'      => 'alice@company.com',
                'department' => 'IT',
                'position'   => 'Senior Developer',
            ],
            [
                'name'       => 'Bob Jones',
                'email'      => 'bob@company.com',
                'department' => 'HR',
                'position'   => 'HR Manager',
            ],
            [
                'name'       => 'Charlie Brown',
                'email'      => 'charlie@company.com',
                'department' => 'Marketing',
                'position'   => 'SEO Specialist',
            ],
        ];

        // Using Query Builder to insert data
        $this->db->table('employees')->insertBatch($data);
    }
}