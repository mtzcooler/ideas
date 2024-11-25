<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Idea $idea) {
        Comment::create([
            'user_id' => Auth::id(),
            'idea_id' => $idea->id,
            'content' => request()->get('content', ''),
        ])->save();

        return redirect()->route('ideas.show', $idea->id)->with('success', "Comment posted successfully!");
    }
}
