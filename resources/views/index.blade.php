<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calendar</title>
        
        @csrf

        <!-- Fonts -->
        <link href="css/homestyle.css" rel="stylesheet">
    </head>
    <body>
        <div class="contents">
            <h1 class="title">Vische</h1>
            <div class="flex-center position-ref full-height">
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>
                        
                            @if(Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
            <header>
                <div class="header_list">
                    <a class="text" href='/'>MyPage</a>
                    <a>|</a>
                    <a class="text" href='group'>Group</a>
                </div>
            </header>
            <a class="button btn_border">+Event</a>
        </div>
        <div id="app" class="calendar">
            <home-component></home-component>
        </div>
    </body>
</html>

