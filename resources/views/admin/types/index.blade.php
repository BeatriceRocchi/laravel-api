@extends('layouts.admin')

@section('content')
    <div class="wrapper-tech">
        <h2>Types list</h2>

        {{-- Lista errori inserimento/modifica --}}
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        {{-- Messaggio avvenuto caricamento/modifica --}}
        @if (session('success_msg'))
            <div class="alert alert-info" role="alert">
                {{ session('success_msg') }}
            </div>
        @endif

        {{-- Messaggio di errore nel caricamento/modifica --}}
        @if (session('error_msg'))
            <div class="alert alert-danger" role="alert">
                {{ session('error_msg') }}
            </div>
        @endif

        {{-- Messaggio di avvenuta eliminazione --}}
        @if (session('delete_msg'))
            <div class="alert alert-info" role="alert">
                {{ session('delete_msg') }}
            </div>
        @endif

        <form class="d-flex my-4" action="{{ route('admin.types.store') }}" method="POST">
            @csrf
            <input class="form-control me-2" placeholder="Add a type" name="name">
            <button class="btn btn-custom-primary-outline w-auto" type="submit">Add</button>
        </form>

        <table class="table table-hover">
            <thead class="text-center">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <td>
                            <form id="form-edit-{{ $type->id }}" action="{{ route('admin.types.update', $type) }}"
                                method="POST" class="m-0">
                                @csrf
                                @method('PUT')
                                <input type="text" value="{{ $type->name }}" name="name">
                            </form>
                        </td>

                        <td>
                            <div class="d-flex justify-content-center">
                                {{-- Edit button --}}
                                <button class="btn btn-custom-secondary me-2" onclick="submitInput({{ $type->id }})">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>

                                {{-- Delete button --}}
                                <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete the type {{ $type->name }} from the list?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


<script>
    function submitInput(id) {
        const input = document.getElementById(`form-edit-${id}`);
        input.submit();
    }
</script>
