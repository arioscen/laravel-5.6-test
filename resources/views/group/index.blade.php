@extends('layouts.base')

@section('content')
    <div class="container">
        @auth
            <div class="row justify-content-center">
                <div class="col-10">
                    <a class="btn btn-primary" href="{{ url('user/groups/create') }}" role="button">Create Group</a>
                </div>    
            </div>
            <br>
        @endauth
        @foreach ($groups as $group)
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">
                        <a href="{{ url('groups/'.$group->id) }}"><h5 class="card-header">{{ $group->title }}</h5></a>
                        <div class="card-body">
                            <p class="card-text">{{ $group->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-2 align-self-center">
                    @auth
                        @if ($group->user_id == Auth::user()->id)
                            <a class="btn btn-success" href="{{ url('user/groups/'.$group->id.'/edit') }}" role="button">Edit</a>
                            <form action="{{ url('user/groups/'.$group->id) }}" method="POST" style="display: inline;">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>                        
                        @endif
                    @endauth
                </div>            
            </div>        
            @if(!$loop->last)
                <br>
            @endif        
        @endforeach
    </div>
@endsection