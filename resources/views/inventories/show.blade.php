@extends('layouts.app')

@section('content')
<a href="/inventories" class="btn btn-primary">Go Back</a>
<h1>{{$card->Name}}</h1>
<div>
	<img src="{{$card->Image}}">
	<br>
	{!! Form::open(['action' => ['InventoriesController@update', $card_user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
		<div class="form-group">
			{{Form::label('quantity', 'Quantity')}}
			{{Form::number('quantity', $card_user->quantity)}}
				{{Form::hidden('_method', 'PUT')}}
		{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
	{!! Form::close() !!}

{!! Form::open(['action' => ['InventoriesController@destroy', $card->id], 'method' => 'POST', 'class' => 'float-right']) !!}
		{{Form::hidden('_method', 'DELETE')}}
		{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
	{!! Form::close() !!}
</div>
@endsection