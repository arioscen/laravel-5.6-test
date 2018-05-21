@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <h5 class="card-header">{{ $post->title }}</h5>
                    <div class="card-body">
                        <p class="card-text">{!! nl2br(htmlspecialchars($post->content)) !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">New Comment</div>
                    <div class="card-body">
                        <form action="{{ url('comments') }}" method="POST">
                            {!! csrf_field() !!}
                            <input hidden name="post_id" value="{{ $post->id }}">
                            <div class="form-group">
                                @auth
                                    <input hidden name="name" value="{{ Auth::user()->name }}">
                                    <div>{{ Auth::user()->name }}</div>
                                @endauth
                                @guest
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="">
                                @endguest
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
            <div class="col-2"></div>
        </div>
        <br>
        @foreach ($post->comments as $comment)
            <div class="row justify-content-center">
                <div class="col-4">
                    <div class="card">
                        <p class="card-header">{{ $comment->name }}</p>
                        <div class="card-body">
                            <p class="card-text">{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>        
            @if(!$loop->last)
                <br>
            @endif        
        @endforeach
    </div>
@endsection