@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="wrapper-projects d-flex flex-column align-items-center">
            <h2>Projects by type</h2>

            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Type</th>
                        <th scope="col">Projects</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <td scope="row" class="text-center fw-semibold">{{ $type->name }}</td>
                            <td>
                                <ul class="list-unstyled">
                                    @foreach ($type->projects as $project)
                                        <li>
                                            <a class="projects-link-custom"
                                                href="{{ route('admin.projects.show', $project) }}">{{ $project->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @endsection
