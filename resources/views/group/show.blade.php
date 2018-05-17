@extends('layouts.base')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <h1>{{ $group->title }}</h1>
        </div>          
    </div>
    <br>
    @auth
        <div class="row justify-content-center">
            <div class="col-6 align-self-center">
                @if (DB::table('group_user')->whereGroupId($group->id)->whereUserId(Auth::user()->id)->count())
                    <form action="{{ url('user/groups/leave') }}" method="POST" style="display: inline;">
                        {{ csrf_field() }}
                        <input hidden name="group_id" value="{{ $group->id }}">
                        <input hidden name="user_id" value="{{ Auth::user()->id }}">
                        <button type="submit" class="btn btn-warning">Leave Group</button>
                    </form>                
                @else
                    <form action="{{ url('user/groups/join') }}" method="POST" style="display: inline;">
                        {{ csrf_field() }}
                        <input hidden name="group_id" value="{{ $group->id }}">
                        <input hidden name="user_id" value="{{ Auth::user()->id }}">
                        <button type="submit" class="btn btn-success">Join Group</button>
                    </form>
                @endif                
                <a class="btn btn-primary" href="{{ url('user/posts/create').'?group_id='.$group->id }}" role="button">Create post</a>
            </div>                   
        </div>
        <br>
    @endauth
    @foreach ($group->posts as $post)
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card">
                <a href="#"><h5 class="card-header">{{ $post->title }}</h5></a>
                <div class="card-body">
                    <p class="card-text">{{ $post->content }}</p>
                </div>
                </div>
            </div>
            <div class="col-2 align-self-center">
                @auth
                    @if ($post->user_id == Auth::user()->id)
                        <a class="btn btn-success" href="{{ url('user/posts/'.$post->id.'/edit') }}" role="button">Edit</a>
                        <form action="{{ url('user/posts/'.$post->id) }}" method="POST" style="display: inline;">
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
@endsection