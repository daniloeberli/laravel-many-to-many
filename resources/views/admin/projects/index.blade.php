@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        Lista progetti
    </h2>
</div>
<div class="container">
    <a href="{{route('admin.projects.create')}}" class="btn btn-primary btn-sm ms-2">Create new project</a>
    <div class="row">
        @foreach ($projects as $project)
            <div class="col col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title"> @if ($project->image) <a href="#" class="btn btn-sm btn-success">Image </a>
                          
                      @endif  {{$project->title}}</h5>
                      <h6 class="card-subtitle mb-2 text-body-secondary">{{$project->stack}}</h6>
                      <p class="card-text">{{$project->description}}</p>
                      <a href="{{route('admin.projects.show',$project->id)}}" class="btn btn-sm btn-primary">Show</a>
                      <a href="{{route('admin.projects.edit',$project->id)}}" class="btn btn-sm btn-warning">Edit</a>
                      <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                    </form>
                    </div>
                  </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
