@extends('layouts.app')
@section('content')
    <div class="jumbotron text-center">
        <h1>welcome to laravel</h1>
        <p>This is the Home page</p>
        @if(!Auth::guest())
        @else
        <a class="btn btn-success btn-lg" href="/login" role="button">Log-In</a>
        <a class="btn btn-primary btn-lg" href="/register" role="button">Register</a>
        @endif
    </div>
@endsection