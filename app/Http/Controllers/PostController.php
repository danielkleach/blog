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
        $posts = $this->postModel->published()->get();

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
            'user_id' => $request->user_id,
            'subject_id' => $request->subject_id,
            'date' => $request->date,
            'title' => $request->title,
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
