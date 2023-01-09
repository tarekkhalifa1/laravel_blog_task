@extends('layouts.app')

@section('title', 'All Posts')


@section('content')

    <h1 class="mt-5 text-center text-secondary">Deleted Posts</h1>
    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Creation Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $key => $post)
            <tr>
                <td>{{ $loop->index + 1}}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->author->name }}</td>
                <td>{{ $post->updated_at->format('Y/m/d')}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endsection