@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('admin.projects.index')}}">Go back to the projects</a>
    <h2 class="fs-4 text-secondary my-4">
        {{$project->title}}
    </h2>
</div>
<div class="container">
    <div class="card">
        <img class="card-img-top" src="{{ asset('storage/' . $project->image) }}" alt="{{$project->title}}">
        <div class="card-body">
          @if ($project->type_id)
              <p>Type: {{$project->type->name}}</p>
          @endif  
          <p class="card-text">{{$project->stack}}</p>
          <p class="card-text">{{$project->description}}</p>
          <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection