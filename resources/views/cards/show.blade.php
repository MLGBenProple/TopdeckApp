@extends('layouts.app')

@section('content')
<a href="/cards" class="btn btn-primary">Go Back</a>
<h1>{{$card->Name}}</h1>
<div>
	<img src="{{$card->Image}}">
	<p>
		Card ID:
		{{$card->Card_ID}}
		<br>
		Card Name:
		{{$card->Name}}
		<br>
		Card Boarder:
		{{$card->Boarder}}
		<br>
		Card Type:
		{{$card->Type}}
		<br>
		Card Desription:
		{{$card->Description}}
	</p>

{!! Form::open(['action' => 'InventoriesController@store', 'method' => 'POST']) !!}
	{{Form::hidden('CardID', "$card->id")}}
	{{Form::label('quantity', 'Quantity')}}
	{{Form::number('quantity', '1')}}
	{{Form::submit('Add to Inventory', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}

{!! Form::open(['action' => 'WishlistsController@store', 'method' => 'POST']) !!}
	{{Form::hidden('CardID', "$card->id")}}
	{{Form::label('quantity', 'Quantity')}}
	{{Form::number('quantity', '1')}}
	{{Form::submit('Add to Wishlist', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
</div>
@endsection