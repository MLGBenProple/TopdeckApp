@extends('layouts.app')

@section('content')
@if(count($matches)>0)
@foreach($matches as $match)
Match Found! card: {{$match->card_id}}!
@endforeach
@endif
@endsection