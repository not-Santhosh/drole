<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Programme;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $departments = ['Computer Science', 'Mathematics', 'Physics'];
        $programmes = ['UG', 'PG', 'PhD'];

        foreach ($departments as $deptName) {
            $department = Department::create([
                'name' => $deptName
            ]);

            foreach ($programmes as $progName) {
                Programme::create([
                    'department_id' => $department->id,
                    'name' => $progName
                ]);
            }
        }
    }
}
