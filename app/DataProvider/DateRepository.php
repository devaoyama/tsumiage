<?php

namespace App\DataProvider;

use App\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DateRepository
{
    /** @var Date  */
    private $date;

    public function __construct(Date $date)
    {
        $this->date = $date;
    }

    public function getTodayDate()
    {
        return Auth::user()->dates()->where('date', Carbon::today())->first();
    }

    public function createDate()
    {
        $this->date->date = Carbon::today();
        return Auth::user()->dates()->save($this->date);
    }

    public function deleteOtherDate()
    {
        if ($otherDay = Auth::user()->dates()->first()) {
            $otherDay->delete();
        }
    }
}
