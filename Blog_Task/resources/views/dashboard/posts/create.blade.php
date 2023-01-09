@extends('layouts.app')

@section('title', 'Create post')
@section('content')

    <!-- Create Post Content -->
    <h2 class="text-center mt-5 text-primary">Create New Post</h2>
    <form method="POST" action="{{route('dashboard.posts.store')}}" enctype="multipart/form-data">
        @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Post Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="" value="{{old('title')}}">
      </div>
      <div class="mb-3">
        <label for="date" class="form-label">Post Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="5">{{old('content')}}</textarea>
      </div>
    <div class="mb-3">
      <label for="image" class="form-label">Post Image</label>
      <input type="file" class="form-control" name="image" id="image">
    </div>
      <button type="submit" class="mt-3 btn btn-outline-primary">
            Create Post
      </button>
    </form>
    <!-- Create Post Content -->
@endsection