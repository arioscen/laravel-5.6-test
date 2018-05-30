@extends('layouts.base')

@section('content')
    @auth
        <div class="row">
            <div class="col-10 my-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Upload
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('user/files') }}" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="file">File</label>
                                <input type="file" class="form-control-file" id="file" name="file">
                            </div>
                        </div>                                                            
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>                        
                    </form>                    
                    </div>
                </div>
                </div>                
            </div>    
        </div>
    @endauth
    <div class="row">
        <div class="col-10">    
            <div class="card">
                <h5 class="card-header">Files</h5>
                <div class="card-body">
                    @foreach ($results as $result)
                        <div>
                            <a href="{{ url('user/files/download/'.$result[0]) }}">{{ $result[1] }}</a>
                        </div>
                    @endforeach
                </div>
            </div>    
        </div>
    </div>
@endsection