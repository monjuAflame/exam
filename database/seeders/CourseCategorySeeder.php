<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Exception;
use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            CourseCategory::insert([
                ['name' => 'SSC'],
                ['name' => 'HSC'],
                ['name' => 'Undergrad'],
                ['name' => 'Postgrad'],
                ['name' => 'Admission'],
                ['name' => 'Job'],
                ['name' => 'Skill'],

            ]);
        } catch (Exception $e) {
            logger($e->getMessage());
        }

    }
}
