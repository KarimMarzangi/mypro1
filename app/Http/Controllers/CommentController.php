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
}
