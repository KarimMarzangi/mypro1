<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function creatingcomment(Request $request, $id)
    {
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
        $comments = Comment::paginate(10);
        return view('layouts.delcomment', ['comments'=> $comments]);
    }
    public function delcomment($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back();
    }
    public function deletecommentTrash()
    {
        $comments = Comment::onlyTrashed()->paginate(10);
        return view('layouts.delcommentTrash', ['comments'=> $comments]);
    }
    public function delcommentTrash($id)
    {
        $comment = Comment::where('id',$id)->forceDelete();
        return redirect()->back();
    }
    
    public function restorecommentTrash($id)
    {
        $comment = Comment::onlyTrashed()->find($id)->restore();
        return redirect()->back();
    }

}
