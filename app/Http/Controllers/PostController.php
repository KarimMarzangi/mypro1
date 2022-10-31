<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createpost()
    {
        return view('layouts.postcreate');
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:64',
            'description' => 'required',
        ]);
        
        $user = auth()->user();
        $post = new Post([
            'title'=> $validated['title'], 
            'description' => $validated['description'],

        ]);
        $user->posts()->save($post);
        return Redirect()->back()->with(['message' => 'Post created...']);
    }
}
