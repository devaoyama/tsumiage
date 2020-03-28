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

    public function getTweetCount()
    {
        return $this->getDate()->tweet_count;
    }

    public function countUp()
    {
        $date = $this->getDate();
        $date->tweet_count += 1;
        $date->save();
    }

    private function deleteOtherDate()
    {
        if ($otherDay = Auth::user()->date) {
            $otherDay->delete();
        }
    }
}
