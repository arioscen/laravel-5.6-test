@extends('layouts.base')
@section('title', 'Create File')
@section('content')
    <div class="col-6">
        <div class="card">
            <h5 class="card-header">Create File</h5>
            <div class="card-body">
                <form action="{{ url('user/files') }}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control-file" id="file" name="file">
                    </div>                                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>                    
            </div>
        </div>
    </div>          
@endsection