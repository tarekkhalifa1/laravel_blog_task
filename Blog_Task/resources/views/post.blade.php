@extends('layouts.app')
@section('title', 'Blog')
@section('content')
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7 mb-5">
            <div>
                <h1>{{ $post->title }}</h1>
                <img class="w-100 my-2" width="400" src="{{ $post->image }}" alt="">
                <p>Posted by <span class="text-success">{{ $post->author->name }}</span><br><span
                        class="text-primary">{{ $post->created_at }}</span>
                </p>
                <hr>
                <h5 class="text-secondary">{{ $post->content }}</h5>
            </div>
        </div>
        <h3 class="text-dark h3">Comments</h3>
        <div>
            @auth
                @if (auth()->user()->type === 'guest')
                    <h2 class="text-center pb-3">Add your comment</h2>
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <textarea class="form-control" name="comment" id="" cols="30" rows="5">{{ old('comment') }}</textarea>
                        <button type="submit" class="my-3 btn btn-outline-primary">
                            Add comment
                        </button>
                    </form>
                @endif
            @endauth
            @guest
                    <div class="d-flex justify-content-center align-items-center gap-3 mb-4">
                        <h3 class='text-center my-2'><a class="text-decoration-none" href="{{route('login')}}">Login</a> to comment!</h3>
                    </div>
            @endguest
            @if (count($comments) == 0)
                    <p class="text-center text-warning h5">No comments yet</p>
            @endif
            @foreach ($comments as $comment)
                <div class="bg-light p-2 my-4">
                    <h1 class="text-dark">{{ $comment->comment }}</h1>
                    <span class="text-dark">{{ $comment->user->name }}</span><br>
                    <span class="text-dark">{{ $comment->created_at }}</span>
                </div>
            @endforeach
        </div>
    </div>
@endsection
