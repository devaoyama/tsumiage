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
        $dateStatus = null;
        $tasks = null;

        $needCreateDate = true;
        if ($date = $dateRepository->getDate()) {

            $tasks = $taskRepository->getTasks();

            if ($dateStatus = $date->date != $day->toDateString()) {

                if ($tasks && $tasks->count() && !$date->status) {

                    $needCreateDate = false;
                    $day = Carbon::parse($dateRepository->getDate()->date);
                }
            } else {
                $needCreateDate = false;
            }
        }

        if ($needCreateDate) {
            $tasks = null;
            $dateRepository->createDate();
        }

        return view('mypage.index', [
            'today' => $day,
            'tasks' => $tasks,
            'dateStatus' => $dateStatus,
        ]);
    }
}
