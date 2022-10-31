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
        $posts = Post::withCount(['comments'])->orderBy('comments_count', 'desc')->paginate(6);
        // dd($posts);
        return view('layouts.list', ['posts'=> $posts]);
    }
    public function postdetails($id)
    {
        $post = Post::findOrFail($id);
        
        if($post){
            $comments = $post->comments()->get();
            return view('layouts.postdetails', ['post'=> $post, 'comments'=> $comments]);
        }
        return redirect()->back();
    }

    public function delete()
    {
        $posts = Post::paginate(10);
        // dd($posts);
        return view('layouts.delpost', ['posts'=> $posts]);
    }
    public function delpost($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();
    }
    public function deleteTrash()
    {
        $posts = Post::onlyTrashed()->paginate(10);
        // dd($posts);
        return view('layouts.delpostTrash', ['posts'=> $posts]);
    }
    public function delpostTrash($id)
    {
        $post = Post::where('id',$id)->forceDelete();
        return redirect()->back();
    }
    
    public function restorepostTrash($id)
    {
        $post = Post::onlyTrashed()->find($id)->restore();
        // $post->restore();
        return redirect()->back();
    }
}
