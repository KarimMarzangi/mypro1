<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function creatingcomment(Request $request, $id)
    {
        /*
            This method creates a comment for the logged in user.

        */
        $validated = $request->validate([
            'comment' => 'required|max:254',
        ]);

        $comment = new Comment([
            'comment'=> $validated['comment'],
            'user_id' => auth()->user()->id, 

        ]);
        $post = Post::find($id);
        $post->comments()->save($comment);
        return Redirect()->back()->with(['messages'=>'ok']);
    }


    public function deletecomment()
    {
        /*
            This method shows the list of comments to be deleted. only admin can see it.

        */
        $comments = Comment::paginate(10);
        return view('layouts.delcomment', ['comments'=> $comments]);
    }
    public function delcomment($id)
    {
        /*
            This method deletes a comment and send to Trash-list. only admin can see it.

        */
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back();
    }
    public function deletecommentTrash()
    {
        /*
            This method shows the list of Trash-comments to be deleted. only admin can see it.

        */
        $comments = Comment::onlyTrashed()->paginate(10);
        return view('layouts.delcommentTrash', ['comments'=> $comments]);
    }
    public function delcommentTrash($id)
    {
        /*
            This method deletes a comment forever. only admin can see it.

        */
        $comment = Comment::where('id',$id)->forceDelete();
        return redirect()->back();
    }
    
    public function restorecommentTrash($id)
    {
        /*
            This method restores a deleted comment. only admin can see it.

        */
        $comment = Comment::onlyTrashed()->find($id)->restore();
        return redirect()->back();
    }

}
