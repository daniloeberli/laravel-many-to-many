@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('admin.projects.index') }}">Go back to the projects</a>
        <h2 class="fs-4 text-secondary my-4">
            {{ $type->name }}
        </h2>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <ul>
                    @foreach ($type->projects as $project)
                        <li><a href="{{ route('admin.projects.edit', $project) }}">{{ $project->title }}</a></li>
                    @endforeach
                </ul>
                <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
@endsection
