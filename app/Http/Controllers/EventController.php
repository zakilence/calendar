<?php

namespace App\Http\Controllers;

use App\Event;
use App\Calendar;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
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

    public function show(int $id)
    {
        return response()->json(Event::find($id));
    }

    public function create(Request $request, Event $event)
    {
        $event->name = $request->input('name');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->description = $request->input('description');
        $event->color = $request->input('color');
        $event->calendar_id = $request->input('calendar_id');
        $event->save();
        
        $events=Event::all();
        return response()->json($events);
    }

    public function save(Request $request)
    {
        $event = Event::find($request->id);

        return $this->_saveEvent($request, $event);
    }
    
    public function delete(Event $event)
    {
        $event->delete();
        $event=Event::get();
        return response()->json($event);
    }


    public function _saveEvent(Request $request,Event $event)
    {
        $event->name = $request->input('name');
        $event->start = new Carbon($request->input('start')); // JSからのデータを日時形式に変換
        $event->end = new Carbon($request->input('end')); // JSからのデータを日時形式に変換
        $event->timed = $request->input('timed');
        $event->calendar_id = $request->input('calendar_id');
        $event->description = $request->input('description');
        $event->color = $request->input('color');

        if ($event->save()) {
            return response()->json($event);
        } else {
            return response()->json(['error' => 'Save Error']);
        }
    }
}