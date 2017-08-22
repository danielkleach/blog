<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postModel;

    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    public function index()
    {
        $latestPosts = $this->postModel->with('subject')->published()->simplePaginate(9);

        return $latestPosts;
    }

    public function show($slug)
    {
        $post = $this->postModel->where('published', true)->where('slug', '=', $slug)->firstOrFail();

        return view('posts.show', compact('post'));
    }

    public function store(Request $request)
    {
        $post = $this->postModel->create([
            'subject_id' => $request->subject_id,
            'date' => $request->date,
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'published' => $request->published
        ]);

        return view('posts.show', compact('post'));
    }

    public function update(Request $request, $slug)
    {
        $post = $this->postModel->where('slug', '=', $slug)->firstOrFail();

        $post->update($request->all());
    }

    public function destroy($slug)
    {
        $post = $this->postModel->where('slug', '=', $slug)->firstOrFail();

        $post->delete();
    }
}
