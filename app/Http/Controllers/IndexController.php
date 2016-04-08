<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
        return View('index', ['tasks' => $this->getTasks()]);
    }

    // get tasks and convert to array
    private function getTasks(){
        //$tasks = Task::orderBy('done', 'asc')->orderBy('deadline', 'asc')->get();
        $tasks = DB::table('tasks')
            ->leftJoin('comments', 'tasks.id', '=', 'comments.task_id')
            ->select('tasks.id', 'tasks.done', 'tasks.task', 'tasks.deadline', DB::raw('count(comments.name) as comments'))
            ->groupBy('tasks.id')
            ->orderBy('done', 'asc')
            ->orderBy('deadline', 'asc')
            ->get();
        return $tasks;
    }
}
