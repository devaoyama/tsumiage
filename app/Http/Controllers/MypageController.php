<?php

namespace App\Http\Controllers;

use App\DataProvider\DateRepository;
use App\DataProvider\TaskRepository;
use Carbon\Carbon;

class MypageController extends Controller
{
    public function index(TaskRepository $taskRepository, DateRepository $dateRepository)
    {
        Carbon::setLocale('ja_JP');
        $day = Carbon::today();

        if ($date = $dateRepository->getDate()) {
            if ($date->date != $day->toDateString() && $dateRepository->getTweetStatus()) {
                $date = $dateRepository->createDate();
                $day = Carbon::parse($date->date);
            }
            if ($date->date != $day->toDateString() && !$date->tasks->count()) {
                $date = $dateRepository->createDate();
                $day = Carbon::parse($date->date);
            }
        }

        $tasks = $taskRepository->getTasks();
        if ($tasks && $tasks->count()) {
            $day = Carbon::parse($dateRepository->getDate()->date);
        }

        return view('mypage.index', [
            'today' => $day,
            'tasks' => $tasks,
            'dateStatus' => $date->date != Carbon::today()->toDateString(),
        ]);
    }
}
