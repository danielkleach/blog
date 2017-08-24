<?php

namespace App\Http\Controllers;

use App\Post;

class PublishedPostController extends Controller
{
    protected $postModel;

    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    public function store($slug)
    {
        $post = $this->postModel->where('slug', '=', $slug)->firstOrFail();

        $post->update([
            'published' => 1
        ]);
    }

    public function destroy($slug)
    {
        $post = $this->postModel->where('slug', '=', $slug)->firstOrFail();

        $post->update([
            'published' => 0
        ]);
    }
}
