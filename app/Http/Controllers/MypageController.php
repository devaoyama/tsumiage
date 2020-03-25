<?php

namespace App\Http\Controllers;

use App\DataProvider\TaskRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index(TaskRepository $repository)
    {
        Carbon::setLocale('ja_JP');
        $today = Carbon::today();
        $tasks = $repository->getTodayTasks($today);

        return view('mypage.index', [
            'today' => $today,
            'tasks' => $tasks,
        ]);
    }
}
