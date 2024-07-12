<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Designation;

class DesignationSeeder extends Seeder
{
    public function run()
    {
        $designations = ['Manager', 'Developer', 'Designer', 'Accountant'];
        foreach ($designations as $designation) {
            Designation::create(['name' => $designation]);
        }
    }
}
