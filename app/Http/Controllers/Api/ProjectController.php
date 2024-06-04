<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('type', 'technologies')->paginate(3);

        return response()->json($projects);
    }

    public function getTypes()
    {
        $types = Type::all();
        return response()->json($types);
    }

    public function getTechnologies()
    {
        $technologies = Technology::all();
        return response()->json($technologies);
    }

    public function getProjectBySlug($slug)
    {
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();

        if ($project) {
            $success = true;
            if ($project->img) {
                $project->img = asset('storage/' . $project->img);
            } else {
                $project->img = asset('storage/uploads/img-placeholder.png');
            }
        } else {
            $success = false;
        }
        return response()->json(compact('success', 'project'));
    }
}
