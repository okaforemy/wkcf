@extends('layouts.app')
@section('content')
	<div class="col-md-10">
		@if (session('success'))
			    <div class="alert alert-success">
			        {{ session('success') }}
			    </div>
			@endif
		<h5>Shuffle quizz</h5>
		<a href="{{URL::route('ramdom')}}" class="btn btn-primary">Shuffle Quizz</a>
	</div>
@endsection