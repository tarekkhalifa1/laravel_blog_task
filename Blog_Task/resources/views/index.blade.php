@extends('layouts.app')
@section('title', 'Blog')
@section('content')
    <div class="row gx-4 gx-lg-5 justify-content-center">
        @foreach ($posts as $post)
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div>
                    <a class="text-decoration-none text-dark" href="{{route('post.show', $post->id) }}">
                        <h1>{{ $post->title }}</h1>
                        <img class="w-100 my-2" width="400" src="{{$post->image}}" alt="">
                        <h5 class="text-secondary">{{ $post->content }}</h5>
                    </a>
                    <p>Posted by <span class="text-success">{{ $post->author->name }}</span>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
