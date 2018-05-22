@extends('layouts.base')

@section('content')
    <div class="col-6">
        <div class="card">
            <h5 class="card-header">Create Post</h5>
            <div class="card-body">
            <form action="{{ url('user/posts') }}" method="POST">
                {!! csrf_field() !!}
                <input hidden name="group_id" value="{{ $group_id }}">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" rows="5" id="content" name="content"></textarea>
                </div>                    
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>                    
            </div>
        </div>
    </div>          
@endsection