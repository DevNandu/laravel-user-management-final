<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = ['IT', 'HR', 'Finance', 'Marketing'];
        foreach ($departments as $department) {
            Department::create(['name' => $department]);
        }
    }
}
