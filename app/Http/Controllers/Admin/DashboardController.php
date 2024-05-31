<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Month;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

class DashboardController extends Controller
{
    public function index()
    {
        $projects_tot = Project::count();
        $types_tot = Type::count();
        $technologies_tot = Technology::count();
        $months = Month::all();

        $last_project = Project::orderBy('date', 'desc')->first();
        return view('admin.home', compact('projects_tot', 'types_tot', 'technologies_tot', 'last_project', 'months'));
    }
}
