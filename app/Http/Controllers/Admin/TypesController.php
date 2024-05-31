<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Project;
use App\Functions\Helper;
use App\Http\Requests\TypeRequest;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::orderBy('name')->get();
        return view('admin.types.index', compact('types'));
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
    public function store(TypeRequest $request)
    {
        $exist = Type::where('name', $request->name)->first();

        if ($exist) {
            return redirect()->route('admin.types.index')->with('error_msg', 'The type is already included in the list');
        } else {
            $input_data = $request->all();

            $input_data['slug'] = Helper::generateSlug($input_data['name'], Type::class);

            $new_type = new Type();
            $new_type->fill($input_data);
            $new_type->save();

            return redirect()->route('admin.types.index')->with('success_msg', 'The type has been successfully included in the list');
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
    public function update(TypeRequest $request, Type $type)
    {
        $exist = Type::where('name', $request->name)->first();

        if ($exist) {
            return redirect()->route('admin.types.index')->with('error_msg', 'The type is already included in the list');
        } else {
            $input_data = $request->all();

            $input_data['slug'] = Helper::generateSlug($input_data['name'], Type::class);

            $type->update($input_data);

            return redirect()->route('admin.types.index')->with('success_msg', 'The type has been successfully update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index')->with('delete_msg', 'The type ' . $type->name . ' has been successfully removed from the list');
    }

    public function projectsByType()
    {
        $types = Type::all();
        return view('admin.types.types-projects', compact('types'));
    }

    public function typeFilter(Type $type)
    {
        $projects = $type->projects;
        return view('admin.types.type-filter', compact('projects', 'type'));
    }
}
