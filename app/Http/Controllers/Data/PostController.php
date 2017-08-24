<?php

namespace App\Http\Controllers\Data;

use App\Post;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    protected $postModel;

    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    /**
     * Returns all blog posts.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $posts = $this->postModel->with('subject')->get();

        return Datatables::of($posts)->make(true);
    }
}
