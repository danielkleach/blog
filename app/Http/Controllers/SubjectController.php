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

    public function show($slug)
    {
        $subject = $this->subjectModel->where('slug', '=', $slug)->firstOrFail();

        return view('subjects.show', compact('subject'));
    }

    public function store(Request $request)
    {
        $subject = $this->subjectModel->create([
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return view('subjects.show', compact('subject'));
    }

    public function update(Request $request, $slug)
    {
        $subject = $this->subjectModel->where('slug', '=', $slug)->firstOrFail();

        $subject->update($request->all());
    }

    public function destroy($slug)
    {
        $subject = $this->subjectModel->where('slug', '=', $slug)->firstOrFail();

        $subject->delete();
    }
}
