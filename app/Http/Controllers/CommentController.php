<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests;
use Request;

class CommentController extends Controller
{
    // create new comment
    public function create(Requests\CommentRequest $request, $task_id)
    {
        $inputs = $request->all();
        $comment = Comment::create(['name' => $inputs['name'], 'comment' => $inputs['comment'], 'task_id' => $task_id]);
        if (Request::ajax()) {
            return Date('M j Y', strtotime($comment->created_at->toDateTimeString()));
        }
        return true;
    }
}
