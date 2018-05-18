@extends('layouts.base')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <h5 class="card-header">Create Group</h5>
                <div class="card-body">
                <form action="{{ url('user/groups') }}" method="POST">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                    </div>                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>                    
                </div>
            </div>
        </div>          
    </div>        
@endsection