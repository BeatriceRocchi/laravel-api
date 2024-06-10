<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;
use App\Models\Month;
use App\Functions\Helper;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = config('projects');

        foreach ($projects as $project) {
            $new_project = new Project;

            $new_project->type_id = Type::where('name', $project['type'])->first()->id;
            $new_project->month_id = Month::where('name', $project['month'])->first()->id;
            $new_project->title = $project['title'];
            $new_project->link = $project['link'];
            $new_project->slug = Helper::generateSlug($new_project->title, Project::class);
            $new_project->img = $project['img'];
            $new_project->date = $project['date'];
            $new_project->description = $project['description'];

            $new_project->save();
        }
    }
}
