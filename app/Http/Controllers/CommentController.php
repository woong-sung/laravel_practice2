<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Board;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store(Request $request, Board $board)
    {
        $request = $request->validate([
            'content' => 'required'
        ]);
        $this->comment['user_id'] = auth()->user()->id;
        $this->comment['user_name'] = auth()->user()->name;
        $this->comment['board_id'] = $board->id;
        $this->comment['content'] = $request['content'];
        $this->comment->save();

        return redirect()->route('boards.show',$board->id);
    }

    public function destroy(Comment $comment)
    {
        $board_id = $comment->board_id;
        $comment->delete();
        return redirect()->route('boards.show',$board_id);
    }
}
