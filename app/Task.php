<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function date()
    {
        return $this->belongsTo('App\Date');
    }
}
