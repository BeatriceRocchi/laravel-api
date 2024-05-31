<form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
    onclick="return confirm('Are you sure you want to delete the project {{ $project->title }} from the records?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button>
</form>
