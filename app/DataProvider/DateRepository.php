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

    public function getDate()
    {
        return Auth::user()->date;
    }

    public function createDate()
    {
        $this->deleteOtherDate();
        $this->date->date = Carbon::today();
        Auth::user()->date()->save($this->date);
        return $this->date;
    }

    public function changeStatusTrue()
    {
        $date = $this->getDate();
        $date->status = true;
        $date->save();
    }

    private function deleteOtherDate()
    {
        if ($otherDay = Auth::user()->date) {
            $otherDay->delete();
        }
    }
}
