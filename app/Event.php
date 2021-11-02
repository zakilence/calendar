<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    
    public function calendar()
    {
        return $this->belongsTo('App\Calendar');
    }
}
