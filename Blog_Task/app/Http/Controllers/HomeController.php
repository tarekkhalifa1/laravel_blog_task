<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $posts = Post::orderBy('created_at')->get();
        return view('index', compact('posts'));

    } //end of index method


    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('post',  compact('post', 'comments'));

    } //end of show post and comments method

} //end of home controller class
