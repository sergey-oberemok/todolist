<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests;
use App\Task;
use Request;

class TaskController extends Controller
{
    // create new task ajax
    public function create(Requests\TaskRequest $request)
    {
        $inputs = $request->all();
        $task = Task::create(['task' => $inputs['task'], 'deadline' => $inputs['deadline']]);
        if (Request::ajax()) {
            return $task->id;
        }
        return true;
    }

    // task's done state changed
    public function editDone($id){
        $done = Request::input('done');
        $task = Task::where('id', $id)->get()->first();
        $task->done = ($done == 'true') ? true : null;
        $task->save();
        if(Request::ajax()){
            return 'true';
        }
        return true;
    }

    // show task as a page
    public function show($id){
        $task = Task::where('id', $id)->get()->first();
        $comments = Comment::where('task_id', $id)->orderBy('created_at', 'asc')->get();
        $array = array('task' => $task->toArray(), 'comments' => $comments->toArray());
        return View('task', $array);
    }

    // remove task
    public function remove($id){
        Task::where('id', $id)->delete();
        Comment::where('task_id', $id)->delete();
        if(Request::ajax()){
            return 'true';
        }
        return true;
    }
}
