<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index()
    {
        $users = $this->userModel->get();

        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->userModel->findOrFail($id);

        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $post = $this->userModel->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return view('users.show', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = $this->userModel->where('id', '=', $id)->first();

        $post->update($request->all());
    }

    public function destroy($id)
    {
        $post = $this->userModel->where('id', '=', $id)->first();

        $post->delete();
    }
}
