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

        if ($dateRepository->getDate()->date != $day->toDateString() && $dateRepository->getTweetCount() >= 2) {
            $dateRepository->createDate();
        }

        $tasks = $taskRepository->getTasks();

        if ($tasks) {
            $day = Carbon::parse($dateRepository->getDate()->date);
        }

        return view('mypage.index', [
            'today' => $day,
            'tasks' => $tasks,
        ]);
    }
}
