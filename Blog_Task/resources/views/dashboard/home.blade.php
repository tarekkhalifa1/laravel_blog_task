@extends('layouts.app')
@section('title', 'Dashboard')
@section('navbar')

@endsection
@section('content')
    <h1 class="text-center">Dashboard</h1>

    <div class="mt-5 d-flex justify-content-center gap-5" role="group" aria-label="Basic example">
        @if (Auth::user()->type === 'admin')
        <a href="{{route('dashboard.author.create')}}" class="btn btn-success">Create Author</a>
        @else
        <a href="{{ route('dashboard.posts.create') }}" class="btn btn-success">Create Post</a>
        @endif
        <a href="{{route('dashboard.posts.index')}}" class="btn btn-primary">All Posts</a>
        <a href="{{route('dashboard.deleted.posts')}}" class="btn btn-danger">Deleted Posts</a>
      </div>

@endsection
