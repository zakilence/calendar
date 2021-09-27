<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendars';
    
    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
