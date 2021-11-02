<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return response()->json(Group::all());
    }
    
    public function create(Request $request,Group $group)
    {
        $group->name = $group->input('name');
        $group->color = $group->input('color');
        $group->save();
        
        $groups=Group::all();
        return response()->json($groups);
    }
}
