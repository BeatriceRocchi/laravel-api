<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTechnologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < count(config('projects')) * 1.5; $i++) {
            $project = Project::inRandomOrder()->first();
            $technology_id = Technology::inRandomOrder()->first()->id;

            $project->technologies()->attach($technology_id);
        }
    }

    // TODO: per sito portfolio inserire dati reali senza estrazione random
}
