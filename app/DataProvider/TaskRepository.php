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

    public function getTasks()
    {
        $tasks = null;
        if ($date = Auth::user()->date) {
            if ($tasks = $date->tasks);
        }
        return $tasks;
    }

    public function createTask(TaskCreate $request)
    {
        $date = $this->dateRepository->getDate();

        if($date === null) {
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
