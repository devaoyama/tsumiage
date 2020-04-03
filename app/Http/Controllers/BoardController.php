<?php

namespace App\Http\Controllers;

use App\Date;
use Carbon\Carbon;

class BoardController extends Controller
{
    public function index()
    {
        $dates = Date::where('post_status', 1)
                    ->where('date', Carbon::today()->toDateString())
                    ->whereHas('user', function ($query) {
                        $query->whereHas('config', function ($query) {
                            $query->where('public', 1);
                        });
                    })
                    ->orderBy('updated_at', 'desc')
                    ->paginate(10);

        return view('board.index', [
            'dates' => $dates,
        ]);
    }
}
