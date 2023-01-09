@extends('layouts.app')

@section('title', 'Edit post')
@section('content')

    <!-- Edit Post Content -->
    <h2 class="text-center mt-5 text-warning">Edit post</h2>
    <form method="POST" action="{{ route('dashboard.posts.update', $post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Post Title"
                value="{{ $post->title }}">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="" cols="30" rows="5">{{ $post->content }}</textarea>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author Name</label>
            <input disabled type="text" class="form-control" id="author" value="{{ $post->author->name }}">
        </div>
        <div class="mb-3">
            <label for="created_at" class="form-label">Date of post</label>
            <input disabled type="text" class="form-control" id="created_at" value="{{ $post->created_at }}">
        </div>
        <div class="mb-3">
            <label for="updated_at" class="form-label">Last update</label>
            <input disabled type="text" class="form-control" id="updated_at" value="{{ $post->updated_at }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Post Image</label>
            <div class="mb-2">
                <img width="300" src="{{ $post->image }}" alt="post image">
            </div>
            <label for="date" class="form-label">Change image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="my-2 mb-4 btn btn-outline-warning">
            Update Post
        </button>
    </form>
    <!-- Edit Post Content -->
@endsection
