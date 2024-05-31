@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="wrapper-projects d-flex flex-column align-items-center">
            <h2>Projects for technology {{ $technology->name }}</h2>

            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Technology</th>
                        <th scope="col">Projects</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td scope="row" class="text-center fw-semibold">{{ $technology->name }}</td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach ($projects as $project)
                                    <li>
                                        <a class="projects-link-custom"
                                            href="{{ route('admin.projects.show', $project) }}">{{ $project->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    @endsection
