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
        $posts = $this->postModel->with('subject')->published()->get();

        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = $this->postModel->where('published', true)->findOrFail($id);

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

    public function update(Request $request, $id)
    {
        $post = $this->postModel->where('id', '=', $id)->first();

        $post->update($request->all());
    }

    public function destroy($id)
    {
        $post = $this->postModel->where('id', '=', $id)->first();

        $post->delete();
    }
}
