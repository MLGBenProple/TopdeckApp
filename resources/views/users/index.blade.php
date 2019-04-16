@extends('layouts.app')
@section('content')
	<h3>profile</h3>
	<div class="jumbotron" id="profile-jumbotron">
	<div class="form">
		{!! Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
			<div class="form-group">
				<h3>{{Auth::user()->name}}</h3>
			<div class="profile-pic">
				<img src="/storage/profile_images/{{Auth::user()->profile_image}}"" class="profileImage img-fluid rounded-circle image" alt="Cinque Terre">
				<div class="middle">
						{{Form::file('profile_image')}}
				</div>
			</div> 
			<br />
		{{Form::hidden('_method', 'PUT')}}
		{{Form::submit('Update', ['class' => 'btn btn-primary'])}}
	{!! Form::close() !!}
</div>
	
@endsection