<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Functions\Helper;
use App\Http\Requests\TechnologyRequest;

class TechnologiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::orderBy('name')->get();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TechnologyRequest $request)
    {
        $exist = Technology::where('name', $request->name)->first();

        if ($exist) {
            return redirect()->route('admin.technologies.index')->with('error_msg', 'The technology is already included in the list');
        } else {
            $input_data = $request->all();

            $input_data['slug'] = Helper::generateSlug($input_data['name'], Technology::class);

            $new_technology = new Technology();
            $new_technology->fill($input_data);
            $new_technology->save();

            return redirect()->route('admin.technologies.index')->with('success_msg', 'The technology has been successfully included in the list');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TechnologyRequest $request, Technology $technology)
    {
        $exist = Technology::where('name', $request->name)->first();

        if ($exist) {
            return redirect()->route('admin.technologies.index')->with('error_msg', 'The technology is already included in the list');
        } else {
            $input_data = $request->all();

            $input_data['slug'] = Helper::generateSlug($input_data['name'], Technology::class);

            $technology->update($input_data);

            return redirect()->route('admin.technologies.index')->with('success_msg', 'The technology has been successfully update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index')->with('delete_msg', 'The technology ' . $technology->name . ' has been successfully removed from the list');
    }



    public function techFilter(Technology $technology)
    {
        $projects = $technology->projects;
        return view('admin.technologies.tech-filter', compact('projects', 'technology'));
    }
}
