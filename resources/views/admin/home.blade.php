@php
    use App\Functions\Helper;
@endphp

@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row wrapper-dashboard">
            <div class="col">
                <div class="highlights-box d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-laptop-code"></i>
                    <div><span class="fw-semibold">{{ $projects_tot }}</span> projects</div>
                    <a href="{{ route('admin.projects.create') }}"><i class="fa-solid fa-circle-plus icon-custom-add"></i></a>
                </div>
            </div>

            <div class="col">
                <div class="highlights-box d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-layer-group"></i>
                    <div><span class="fw-semibold">{{ $types_tot }}</span> types</div>
                    <a href="{{ route('admin.types.index') }}"><i class="fa-solid fa-circle-plus icon-custom-add"></i></a>
                </div>
            </div>

            <div class="col">
                <div class="highlights-box d-flex align-items-center justify-content-center">
                    <i class="fa-solid fa-robot"></i>
                    <div><span class="fw-semibold">{{ $technologies_tot }}</span> technologies</div>
                    <a href="{{ route('admin.technologies.index') }}"><i
                            class="fa-solid fa-circle-plus icon-custom-add"></i></a>
                </div>
            </div>
        </div>

    </div>

    <div class="container-fluid dashboard-data-box">
        <div class="row flex-wrap">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 text-center">LAST PROJECT</h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="fw-semibold">Title:</span> {{ $last_project->title }}
                        </li>
                        <li class="list-group-item">
                            <span class="fw-semibold">Month of release:</span> {{ $last_project->month->name }}
                        </li>
                        <li class="list-group-item">
                            <span class="fw-semibold">Type:</span> {{ $last_project->type->name }}
                        </li>
                        <li class="list-group-item">
                            <span class="fw-semibold">Technologies:</span>
                            @foreach ($last_project->technologies as $technology)
                                <span class="badge badge-custom mx-1">{{ $technology->name }}</span>
                            @endforeach
                        </li>
                        <li class="list-group-item">
                            {{ $last_project->description }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col">
                <div class="card h-100">
                    <div class="card-header">
                        <h6 class="m-0 text-center">PROJECTS TIMELINE</h6>
                    </div>
                    <div class="card-body text-center">
                        <div class="row">
                            @foreach ($months as $month)
                                <div class="col">
                                    {{ $month->name }}
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-2">
                            @foreach ($months as $month)
                                <div
                                    class="col projects-num-cell
                                    @if (count($month->projects) == 0) zero @elseif(count($month->projects) > 1) high @else small @endif">
                                    {{ count($month->projects) }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
