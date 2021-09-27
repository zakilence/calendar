<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    public function index()
    {
        return response()->json(Event::with('calendar')->get());
    }

    public function show(int $id)
    {
        return response()->json(Event::with('calendar')->find($id));
    }

    public function create(EventRequest $request)
    {
        $event = new Event();

        return $this->_saveEvent($request, $event);
    }

    public function save(EventRequest $request)
    {
        $event = Event::find($request->id);

        return $this->_saveEvent($request, $event);
    }

    public function destroy(Request $request)
    {
        $event = Event::find($request->id);

        if ($event->delete()) {
            return response()->json($event);
        } else {
            return response()->json(['error', 'Delete Error']);
        }
    }


    public function _saveEvent(EventRequest $request, $event)
    {
        $event->name = $request->input('name');
        $event->start = new Carbon($request->input('start')); // JSからのデータを日時形式に変換
        $event->end = new Carbon($request->input('end')); // JSからのデータを日時形式に変換
        $event->timed = 1;
        $event->calendar_id = 1;
        $event->description = $request->input('description');
        $event->color = $request->input('color');

        if ($event->save()) {
            return response()->json(Event::with('calendar')->find($event->id));
        } else {
            return response()->json(['error' => 'Save Error']);
        }
    }
}