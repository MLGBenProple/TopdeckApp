@extends('layouts.app')

@section('content')
<a href="/wishlists" class="btn btn-primary">Go Back</a>
<h1>{{$card->Name}}</h1>
<div>
	<img src="{{$card->Image}}">
	<br>
	{!! Form::open(['action' => ['WishlistsController@update', $wishlist->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
		<div class="form-group">
			{{Form::label('quantity', 'Quantity')}}
			{{Form::number('quantity', $wishlist->quantity)}}
				{{Form::hidden('_method', 'PUT')}}
		{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
	{!! Form::close() !!}

{!! Form::open(['action' => ['WishlistsController@destroy', $card->id], 'method' => 'POST', 'class' => 'float-right']) !!}
		{{Form::hidden('_method', 'DELETE')}}
		{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
	{!! Form::close() !!}
</div>
@endsection