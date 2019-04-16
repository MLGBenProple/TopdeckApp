@extends('layouts.app')

@section('content')
@if(count($wishlists) > 0)
	@foreach($wishlists as $wishlist)
		<div class="card">
			<a href="/wishlists/{{$wishlist->id}}"><img src="{{$wishlist->Image}}"></a>
		</div>
	@endforeach
@else
No cards found
@endif
@endsection