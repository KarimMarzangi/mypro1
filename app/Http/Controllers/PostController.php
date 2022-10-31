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

    public function show()
    {
        //sort
        $posts = Post::paginate(6);
        // dd($posts);
        return view('layouts.list', ['posts'=> $posts]);
    }
    public function postdetails($id)
    {
        $post = Post::findOrFail($id);
        
        
        return view('layouts.postdetails', ['post'=> $post]);
        

    }
}
