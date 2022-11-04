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
        /*
            This method creates a post for the logged in user. only Mondary can see it.

        */
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
        /*
            This method sorts the posts based on the number of comments.

        */
        $posts = Post::withCount(['comments'])->orderBy('comments_count', 'desc')->paginate(6);
        
        return view('layouts.list', ['posts'=> $posts]);
    }
    public function postdetails($id)
    {
        /*
            This method displays the details of the post.

        */
        $post = Post::findOrFail($id);
        
        if($post){
            $comments = $post->comments()->get();
            return view('layouts.postdetails', ['post'=> $post, 'comments'=> $comments]);
        }
        return redirect()->back();
    }

    public function delete()
    {
        /*
            This method shows the list of posts to be deleted. only admin can see it.

        */
        $posts = Post::paginate(10);
        return view('layouts.delpost', ['posts'=> $posts]);
    }
    public function delpost($id)
    {
        /*
            This method deletes a post and send to Trash-list. only admin can see it.

        */
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();
    }
    public function deleteTrash()
    {
        /*
            This method shows the list of Trash-posts to be deleted. only admin can see it.

        */
        $posts = Post::onlyTrashed()->paginate(10);
        // dd($posts);
        return view('layouts.delpostTrash', ['posts'=> $posts]);
    }
    public function delpostTrash($id)
    {
        /*
            This method deletes a post forever. only admin can see it.

        */
        $post = Post::where('id',$id)->forceDelete();
        return redirect()->back();
    }
    
    public function restorepostTrash($id)
    {
        /*
            This method restores a deleted post. only admin can see it.

        */
        $post = Post::onlyTrashed()->find($id)->restore();
        return redirect()->back();
    }
}
