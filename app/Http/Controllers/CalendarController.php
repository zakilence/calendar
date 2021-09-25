<?php

namespace App\Http\Controllers;

use App\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index(Calendar $calendar)
    {
        return view('index')->with(['calendars' => $calendar->get()]);
    }
}
