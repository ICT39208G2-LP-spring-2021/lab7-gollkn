@extends('layouts.app')

@section('content')



    <form action={{ route('login') }} method="post">
        @csrf
        <label for="Email">Email:</label>
        <input type="email" name="Email">
        @error('Email')
            {{ $message }}
        @enderror
        <label for="Password">Password:</label>
        <input type="password" name="Password">
        @error('Password')
            {{ $message }}
        @enderror
        <input type="submit" value="Login">
        @error('StatusId')
            {{ $message }}
        @enderror
    </form>
    @if (session()->has('unverified-email'))
        {{ session('unverified-email') }}
    @endif




@endsection
