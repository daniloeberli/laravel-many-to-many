@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="d-flex align-items-center">
            <a href="{{ route('admin.projects.index') }}" class="btn btn-primary btn-sm me-2">Back</a>
            <h2 class="fs-4 text-secondary my-4">Edit Project</h2>
        </div>

        <form action="{{ route('admin.projects.update', $project->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Project title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $project->title) }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Project description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ strip_tags($project->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="stack" class="form-label">Project stack</label>
                <textarea class="form-control" id="stack" name="stack" rows="3">{{ strip_tags($project->stack) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
            @if ($errors->any())
                <div class="mb-3">
                    <label class="form-check-label d-block" for="technologies">
                        Technology
                    </label>
                    @foreach ($technologies as $technology)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="technologies" name="technologies[]"
                                value="{{ $technology->id }}"
                                {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="technologies">{{ $technology->name }}</label>
                        </div>
                    @endforeach
                </div> 
            @else
                <div class="mb-3">
                    <label class="form-check-label d-block" for="technologies">
                        Technology
                    </label>
                    @foreach ($technologies as $technology)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="technologies" name="technologies[]"
                                value="{{ $technology->id }}"
                                {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="technologies">{{ $technology->name }}</label>
                        </div>
                    @endforeach
                </div>
            @endif

            <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
        </form>
    </div>
@endsection
