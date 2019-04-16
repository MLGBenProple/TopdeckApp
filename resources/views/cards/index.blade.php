@extends('layouts.app')

@section('content')

	<h1>Cards</h1>
	{!! Form::open(['action' => 'CardsController@search', 'method' => 'POST']) !!}
		{{ csrf_field() }}
	    <div class="input-group">
	        {{Form::text('card', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
	    </div>
		{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
	{!! Form::close() !!}
	    
	@if(count($cards) > 0)
		@foreach($cards as $card)
			<div class="card">
				<div class="row">
						<div class="col-md-2">
							<a href="/cards/{{$card->id}}"><img src="{{$card->Image}}"></a>
						</div>
						<div class="col-md-3">
							Name: {{$card->Name}}<br>
							Boarder: {{$card->Boarder}}<br>
							Type: {{$card->Attribute}}<br>
							@if($card->Attack != null)
								Attribute: {{$card->Type}}<br>
								Level: {{$card->Level}}<br>
								Attack: {{$card->Attack}}<br>
								Defence: {{$card->Defence}}<br>
							@endif
						</div>
					<div class="col-md-7">
						Effect:<br> {{$card->Description}}
					</div>
				</div>
			</div>
		@endforeach
		{{$cards->links()}}
	@endif
@endsection