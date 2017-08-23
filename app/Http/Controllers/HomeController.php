<?php

namespace App\Http\Controllers;

use App\Post;

class HomeController extends Controller
{
    protected $postModel;

    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    public function index()
    {
        $latestPosts = $this->postModel->with('subject')->published()->simplePaginate(9);

        return view('index', compact('latestPosts'));
    }
}
