<?php

namespace App\Http\Controllers;

use App\Date;
use App\Http\Requests\TaskCreate;
use App\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function showCreateForm()
    {
        return view('task.create');
    }

    public function create(TaskCreate $request, Task $task)
    {
        $date = Auth::user()->dates()->where('date', Carbon::today())->first();

        if($date == null) {
            $date = new Date();
            $date->date = Carbon::today();
            Auth::user()->dates()->save($date);
        }

        $task->title = $request->title;
        $date->tasks()->save($task);

        return redirect()->route('home');
    }
}
