@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        Lista tipologie
    </h2>
</div>
<div class="container">
    <a href="{{route('admin.types.create')}}" class="btn btn-primary btn-sm ms-2">Create new type</a>
    <div class="row">
        @foreach ($types as $type)
            <div class="col col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">{{$type->name}}</h5>
                      <h6 class="card-subtitle mb-2 text-body-secondary">{{$type->slug}}</h6>
                      <a href="{{route('admin.types.show',$type->id)}}" class="btn btn-sm btn-primary">Show</a>
                      <a href="{{route('admin.types.edit',$type->id)}}" class="btn btn-sm btn-warning">Edit</a>
                      <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST">
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
