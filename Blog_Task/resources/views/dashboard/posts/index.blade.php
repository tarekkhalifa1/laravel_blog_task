@extends('layouts.app')
@section('title', 'All Posts')
@section('content')
    <h1 class="mt-5 text-center text-secondary">All Posts</h1>
    <a class="btn btn-primary" href="{{ route('dashboard.posts.create') }}">Create Post</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Creation Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($posts as $key => $post)
            <tr>
                <td>{{ $loop->index + 1}}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->author->name }}</td>
                <td>{{ $post->updated_at->format('Y/m/d')}}</td>
                <td class="d-flex gap-3">
                    <a class="btn btn-sm btn-warning" title="edit" href="{{ route('dashboard.posts.edit', $post->id) }}"><i
                            class="fa-regular fa-pen-to-square"></i></a>
                    <form method="POST" action="{{ route('dashboard.posts.destroy', $post->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('are you sure?')"
                            title="delete"><i class="fa-regular fa-trash-can"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endsection