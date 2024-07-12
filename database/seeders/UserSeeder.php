<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Department;
use App\Models\Designation;

class UserSeeder extends Seeder
{
    public function run()
    {
        $departments = Department::all();
        $designations = Designation::all();

        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'name' => "User $i",
                'department_id' => $departments->random()->id,
                'designation_id' => $designations->random()->id,
                'phone_number' => '123-456-' . str_pad($i, 4, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
