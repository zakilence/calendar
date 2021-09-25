<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendars';
    protected $fillable = ['name','color','visibility'];
    
    public function events()
    {
        return $this->hasMany(App\Models\Event);
    }
}
