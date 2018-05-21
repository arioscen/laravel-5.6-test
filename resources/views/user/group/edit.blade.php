@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <h5 class="card-header">Edit Group</h5>
                    <div class="card-body">
                    <form action="{{ url('user/groups/'.$group->id) }}" method="POST">
                        {{ method_field('PATCH') }}
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $group->title }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" rows="5" id="description" name="description">{{ $group->description }}</textarea>                        
                        </div>                    
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>                    
                    </div>
                </div>
            </div>          
        </div>        
    </div>
@endsection