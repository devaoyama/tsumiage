<?php

namespace App\DataProvider;

use App\Http\Requests\TaskCreate;
use App\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository
{
    /** @var Task */
    private $task;

    /** @var DateRepository */
    private $dateRepository;

    public function __construct(Task $task, DateRepository $dateRepository)
    {
        $this->task = $task;
        $this->dateRepository = $dateRepository;
    }

    public function getTodayTasks($today)
    {
        $tasks = null;
        if ($dates = Auth::user()->dates()->where('date', $today)->first()) {
            if ($tasks = $dates->tasks()->get());
        }
        return $tasks;
    }

    public function createTask(TaskCreate $request)
    {
        $date = $this->dateRepository->getTodayDate();

        if($date === null) {
            // 前のdateとtaskを削除
            $this->dateRepository->deleteOtherDate();

            // dateを作成
            $date = $this->dateRepository->createDate();
        }

        $this->task->title = $request->title;
        $date->tasks()->save($this->task);
    }

    public function changeStatus(Task $task)
    {
        $task->status = !$task->status;
        $task->save();
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
    }
}
