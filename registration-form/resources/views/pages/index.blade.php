@extends('layouts.app')

@section('content')

    @guest
    <ul>
        <li>
            <a href="{{ route('register') }}">register</a>
        </li>
        <li>
            <a href="{{ route('login') }}">login</a>
        </li>

    </ul>
    @endguest
    
    @auth
    <ul>
        <li>
            <a href="{{ route('home') }}">home</a>
        </li>
        <li>
            <a href="{{ route('log-out') }}">log out</a>
        </li>

    </ul>  
    @endauth

@endsection
