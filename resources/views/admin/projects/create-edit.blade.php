@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>{{ $title_text }}</h2>

        <div class="form-custom-alerts">

            {{-- Lista errori inserimento/modifica --}}
            {{-- @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <p class="m-0">Errors were found when filling out the form:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
        </div>

        <form action="{{ $route }}" class="form-custom py-4" method="POST" enctype="multipart/form-data">
            @csrf
            @method($method)
            {{-- Title input --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    placeholder="Add project's title" name="title" value="{{ old('title', $project?->title) }}">

                @error('title')
                    <div id="title" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Data input --}}
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date"
                    value="{{ old('date', $project?->date) }}">

                @error('date')
                    <div id="date" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Type select --}}
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type_id">
                    <option value="">Select a project type</option>
                    @foreach ($types as $type)
                        <option @if (old('type_id', $project?->type?->id) == $type->id) selected @endif value="{{ $type->id }}">
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Technologies checkbox --}}
            <div class="mb-3">
                <div class="btn-group" role="group">
                    @foreach ($technologies as $technology)
                        <input type="checkbox" class="btn-check" id="tech_{{ $technology->id }}" name="technologies[]"
                            value="{{ $technology->id }}" @if (
                                ($errors->any() && in_array($technology->id, old('technologies', []))) ||
                                    (!$errors->any() && $project?->technologies->contains($technology))) checked @endif>
                        <label class="btn btn-custom-primary-outline btn-check-custom w-auto"
                            for="tech_{{ $technology->id }}">{{ $technology->name }}</label>
                    @endforeach
                </div>
            </div>

            {{-- Description textarea --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                    rows="6" placeholder="Add project's description">{{ old('description', $project?->description) }}</textarea>

                @error('description')
                    <div id="description" class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Image input --}}
            <div class="mb-3">
                <label for="img" class="form-label">Image</label>
                <input type="file" class="form-control" id="img" placeholder="Add project's image" name="img"
                    onchange="showImg(event)">
                <img id="thumb" class="thumb-custom py-4" src="{{ asset('storage/' . $project?->img) }}"
                    onerror="this.src = '/img/img-placeholder.png'">
            </div>

            <button class="btn btn-custom-primary w-auto" type="submit">Submit</button>
            <button class="btn btn-secondary w-auto" type="reset">Reset</button>
        </form>
    </div>
@endsection

<script>
    function showImg(event) {
        const thumb = document.getElementById('thumb');
        thumb.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
