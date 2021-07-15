<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Sujet;
use App\Notifications\NewCommentPosted;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Sujet $sujet)
    {
        request()->validate([
            'content' => 'required|min:5',
        ]);
        $comment = new Comment();
        $comment->content = request('content');
        $comment->user_id = auth()->user()->id;
        $sujet->comments()->save($comment);

        //noti
        $sujet->user->notify(new NewCommentPosted($sujet, auth()->user()));

        return redirect()->route('sujets.show', $sujet);
    }

    public function storereply(Comment $comment)
    {
        request()->validate([
            'replycomment' => 'required|min:3',
        ]);
        $replycomment = new Comment();
        $replycomment->content = request('replycomment');
        $replycomment->user_id = auth()->user()->id;
        $comment->comments()->save($replycomment);

        return redirect()->back();
    }

    public function addassolution(Sujet $sujet, Comment $comment)
    {
        if (auth()->user()->id === $sujet->user_id) {
            $sujet->solution = $comment->id;
            $sujet->save();

            return response()->json(['success' => ['success' => 'Marque comme solution']], 200);
        } else {
            return response()->json(['errors' => ['error' => 'Utilisateur non valide']], 401);
        }
    }
}
