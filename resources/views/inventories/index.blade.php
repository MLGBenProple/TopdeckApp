@extends('layouts.app')

@section('content')
@if(count($inventorys) > 0)
	@foreach($inventorys as $inventory)
		<div class="card">
			<a href="/inventories/{{$inventory->id}}"><img src="{{$inventory->Image}}"></a>
		</div>
	@endforeach
@else
No cards found
@endif
@endsection