<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public $user_type;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_type = Auth::user()->type;
            if ($this->user_type === 'guest') {
                return redirect('/');
            }
            return $next($request);
        });

    } //end of construct method to check user type

    public function index()
    {
        $posts = Post::all();
        if (Auth::user()->type === 'author') {
            $posts = Post::where('author_id', Auth::user()->id)->get();
        }

        return view('dashboard.posts.index', compact('posts'));
    } //end of index method

    public function create()
    {
        return view('dashboard.posts.create');
    } //end of create method

    public function store(StorePostRequest $request)
    {
        $image = $request->file('image');
        $path = public_path('\images\posts');
        $image->move($path, $image->getClientOriginalName());
        $imgName = '\images\posts\\' . $image->getClientOriginalName();

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imgName,
            'author_id' => Auth::user()->id
        ];

        $post = Post::create($data);
        return to_route('dashboard.posts.create')->with('message', 'Post created successfully');
    } //end of store post method

    public function edit(Post $post)
    {
        if(Auth::user()->id == $post->author->id){
            $post->find($post->id);
            return view('dashboard.posts.edit', compact('post'));
        }else {
            return view('errors.404');
        }

    } //end of edit method

    public function update(UpdatePostRequest $request, Post $post)
    {
        if (request()->hasFile('image')) {
            $image = $request->file('image');
            $path = public_path('\images\posts');
            $image->move($path, $image->getClientOriginalName());
            $imgName = '\images\posts\\' . $image->getClientOriginalName();
            $post->image =  $imgName; //update image in database
        }

        $post->title = request()->title;
        $post->content = request()->content;
        $post->save();

        return to_route('dashboard.posts.edit', $post->id)->with('message', 'Post updated successfully');
    } //end of update method

    public function destroy(Post $post)
    {
        $relatedComments = $post->comments;

        Post::find($post->id)->delete();
        foreach ($relatedComments as $comment) {
            $comment->delete();
        }

        return to_route('dashboard.posts.index')->with('message', 'Post deleted successfully');

    } // end of destroy method (soft delete)


    public function deletedPosts()
    {
        $posts = Post::onlyTrashed()->where('author_id', Auth::user()->id )->get();
        return view('dashboard.posts.deleted', compact('posts'));

    } //end of deleted posts method

} //end of post controller class
