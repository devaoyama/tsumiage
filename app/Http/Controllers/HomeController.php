<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->dates()->where('date', Carbon::today())->first()->tasks()->get();

        return view('home.index', [
            'tasks' => $tasks,
        ]);
    }
}
