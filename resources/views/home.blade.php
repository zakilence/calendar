@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">My Scheduler</div>
                <div class="card-body">
                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}" />
                    <div id="app">
                        <home-component></home-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
