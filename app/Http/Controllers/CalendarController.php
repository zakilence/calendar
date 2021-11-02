<?php

namespace App\Http\Controllers;

use App\Event;
use App\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return response()->json(Calendar::all());
    }
    
    public function create(Request $request, Calendar $calendar)
    {
        $calendar->name = $request->input('name');
        $calendar->color = $request->input('color');
        $calendar->save();
        
        $calendars=Calendar::all();
        return response()->json($calendars);
    }
    
    public function update(Request $request, Calendar $calendar, Event $event)
    {
        $calendar->visibility = $request->input('visibility');
        $calendar->save();
        
        $calendars=Calendar::where('visibility',1)->get();
        if($calendars){
            $events = [];
            $events_all = [];
            foreach($calendars as $calendar){
                $events = $calendar->events->toArray();
                $events_all = array_merge($events_all,$events);
            }
        }
        else {
            $events=null;
        }
        return response()->json($events_all);
    }
    
    public function delete(Calendar $calendar)
    {
        $calendar->delete();
        $calendar=Calendar::get();
        return response()->json($calendar);
    }
}