<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index()
    {
        Carbon::setLocale('ja_JP');
        $today = Carbon::today();
        $tasks = null;
        if ($dates = Auth::user()->dates()->where('date', $today)->first()) {
            if ($dates->tasks()->get()->count()) {
                $tasks = $dates->tasks()->get();
            }
        }

        return view('mypage.index', [
            'today' => $today,
            'tasks' => $tasks,
        ]);
    }
}
