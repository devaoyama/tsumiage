<?php

namespace App\Http\Controllers;

use App\DataProvider\DateRepository;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public function create(DateRepository $repository)
    {
        $repository->createDate();
        return redirect()->route('mypage');
    }
}
