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

        if($date === null) {
            // 前のdateとtaskを削除
            $otherDay = Auth::user()->dates()->first();
            if ($otherDay) {
                $otherDay->delete();
            }

            // dateを作成
            $date = new Date();
            $date->date = Carbon::today();
            Auth::user()->dates()->save($date);
        }

        $task->title = $request->title;
        $date->tasks()->save($task);

        return redirect()->route('mypage');
    }

    public function changeStatus(Task $task)
    {
        $task->status = !$task->status;
        $task->save();

        return redirect()->route('mypage');
    }

    public function delete(Task $task)
    {
        $task->delete();

        return redirect()->route('mypage');
    }
}
