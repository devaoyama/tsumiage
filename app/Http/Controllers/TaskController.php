<?php

namespace App\Http\Controllers;

use App\DataProvider\TaskRepository;
use App\Http\Requests\TaskCreate;
use App\Task;

class TaskController extends Controller
{
    public function create(TaskCreate $request, TaskRepository $repository)
    {
        if ($repository->createTask($request)) {
            return redirect()->route('mypage');
        }

        return redirect()->route('mypage')->with('error', 'タスクは5個までしか登録できません');
    }

    public function changeStatus(Task $task, TaskRepository $repository)
    {
        $repository->changeStatus($task);

        return redirect()->route('mypage');
    }

    public function delete(Task $task, TaskRepository $repository)
    {
        $repository->deleteTask($task);

        return redirect()->route('mypage');
    }
}
