<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use App\Functions\Helper;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET['toSearch'])) {
            $projects = Project::where('title', 'LIKE', '%' . $_GET['toSearch'] . '%')->paginate(5);
            $toSearch = $_GET['toSearch'];
        } else {
            $projects = Project::paginate(5);
            $toSearch = 'all';
        }

        $direction = 'desc';
        $types = Type::all();

        return view('admin.projects.index', compact('projects', 'direction', 'toSearch', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $route = route('admin.projects.store');
        $method = 'POST';
        $title_text = 'Add a new project';
        $project = null;
        $types = Type::orderBy('name')->get();
        $technologies = Technology::orderBy('name')->get();

        return view('admin.projects.create-edit', compact('route', 'method', 'title_text', 'project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();

        if (array_key_exists('img', $form_data)) {
            $img_path = Storage::put('uploads', $form_data['img']);
            $form_data['img'] = $img_path;
        }

        $form_data['slug'] = Helper::generateSlug($form_data['title'], Project::class);

        $new_project = new Project();

        if (array_key_exists('date', $form_data)) {
            $date_str = $form_data['date'];
            $date_timestamp = strtotime($date_str);
            $month = intval(date("m", $date_timestamp));
            $new_project->month_id = $month;
        }

        $new_project->fill($form_data);

        $new_project->save();

        if (array_key_exists('technologies', $form_data)) {
            $new_project->technologies()->attach($form_data['technologies']);
        }

        return redirect()->route('admin.projects.show', $new_project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $route = route('admin.projects.update', $project);
        $method = 'PUT';
        $title_text = 'Edit project';
        $types = Type::orderBy('name')->get();
        $technologies = Technology::orderBy('name')->get();

        return view('admin.projects.create-edit', compact('route', 'method', 'title_text', 'project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->all();

        if ($form_data['title'] !== $project->title) {
            $form_data['slug'] = Helper::generateSlug($form_data['title'], Project::class);
        } else {
            $form_data['slug'] = $project->slug;
        }

        if (array_key_exists('img', $form_data)) {
            $img_path = Storage::put('uploads', $form_data['img']);
            $form_data['img'] = $img_path;
        }

        if (array_key_exists('date', $form_data)) {
            $date_str = $form_data['date'];
            $date_timestamp = strtotime($date_str);
            $month = date("m", $date_timestamp);
            $project->month_id = $month;
        }

        $project->update($form_data);

        if (array_key_exists('technologies', $form_data)) {
            $project->technologies()->sync($form_data['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->img) {
            Storage::disk('public')->delete($project->img);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('delete_msg', 'The project ' . $project->title . ' has been successfully removed from the list');
    }

    // Custom function to order data in table
    public function orderBy($direction, $column, $toSearch)
    {

        $direction = $direction === 'desc' ? 'asc' : 'desc';

        if ($toSearch !== 'all') {
            $projects = Project::where('title', 'LIKE', '%' . $toSearch . '%')->orderBy($column, $direction)->paginate(5);
        } else {
            $projects = Project::orderBy($column, $direction)->paginate(5);
        }

        $types = Type::all();

        return view('admin.projects.index', compact('projects', 'direction', 'toSearch', 'types'));
    }

    // Custom function to filter data according to checkbox
    public function filterBy()
    {
        $types_checked = $_GET['types_checked'];

        $projects = Project::whereIn('type_id', $types_checked)->get();

        $direction = 'desc';
        $types = Type::all();
        $toSearch = 'all';

        return view('admin.projects.index', compact('projects', 'direction', 'types', 'toSearch'));
    }
}
