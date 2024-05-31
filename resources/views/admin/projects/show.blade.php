@extends('layouts.admin')

@section('content')
    <h2>Project details</h2>

    <div class="card m-4">
        <div class="d-flex">
            <div class="card-img-box">
                <img src="{{ asset('storage/' . $project->img) }}" class="card-img-top" alt="{{ $project->title }}"
                    onerror="this.src = '/img/img-placeholder.png'">
            </div>
            <div class="card-body">
                <h3>{{ $project->title }}</h3>

                <p class="my-4">{{ $project->description }}</p>

                @if ($project->type)
                    <div class="my-4"><i class="fa-solid fa-layer-group"></i> {{ $project->type->name }}</div>
                @endif

                @if ($project->technologies)
                    <div class="d-flex justify-content-end">
                        <i class="fa-solid fa-robot"></i>
                        @foreach ($project->technologies as $technology)
                            <span class="badge badge-custom mx-1">{{ $technology->name }}</span>
                        @endforeach
                    </div>
                @endif

                <div class="d-flex mt-4">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-custom-primary btn-link-custom me-2">
                        <i class="fa-solid fa-arrow-rotate-left"></i>
                    </a>
                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-custom-secondary me-2"><i
                            class="fa-solid fa-pen-to-square"></i></a>

                    @include('admin.partials.delete_form')
                </div>

            </div>
        </div>
    </div>
@endsection
