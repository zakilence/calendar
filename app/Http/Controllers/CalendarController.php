<?php

namespace App\Http\Controllers;

use App\Calendar;
use Illuminate\Http\Request;
use App\Http\Requests\CalendarRequest;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        return response()->json(Calendar::all());
    }

    public function show(int $id)
    {
        return response()->json(Calendar::find($id));
    }


    public function create(CalendarRequest $request)
    {
        $calendar = new Calendar();

        return $this->_saveCalendar($request, $calendar);
    }

    public function save(CalendarRequest $request)
    {
        $calendar = Calendar::find($request->id);

        return $this->_saveCalendar($request, $calendar);
    }

    public function destroy(Request $request)
    {
        $calendar = Calendar::find($request->id);
        $calendar->events()->each(function ($event) {
            $event->delete();
        });

        if ($calendar->delete()) {
            return response()->json($calendar);
        } else {
            return response()->json(['error', 'Delete Error']);
        }
    }

    private function _saveCalendar(CalendarRequest $request, $calendar)
    {
        $calendar->name = $request->input('name');
        $calendar->color = $request->input('color');
        $calendar->visibility = $request->input('visibility');
        $calendar->user_id = $request->input('user_id');

        if ($calendar->save()) {
            return response()->json($calendar);
        } else {
            return response()->json(['error' => 'Save Error']);
        }
    }
}