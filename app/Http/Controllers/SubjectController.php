<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subjectModel;

    public function __construct(Subject $subjectModel)
    {
        $this->subjectModel = $subjectModel;
    }

    public function index()
    {
        $subjects = $this->subjectModel->get();

        return view('subjects.index', compact('subjects'));
    }

    public function show($id)
    {
        $subject = $this->subjectModel->findOrFail($id);

        return view('subjects.show', compact('subject'));
    }

    public function store(Request $request)
    {
        $post = $this->subjectModel->create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return view('subjects.show', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = $this->subjectModel->where('id', '=', $id)->first();

        $post->update($request->all());
    }

    public function destroy($id)
    {
        $post = $this->subjectModel->where('id', '=', $id)->first();

        $post->delete();
    }
}
