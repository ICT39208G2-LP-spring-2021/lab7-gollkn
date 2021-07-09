@extends('layouts.app')

@section('content')

@auth
{{auth()->user()->FirstName}} {{auth()->user()->LastName}}    
@endauth

    
@endsection