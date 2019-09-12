@extends('layouts.app')

@section('content')
	<div class="col-md-12">
		<div class="alert-success col-md-6 quiz-success mb-4 mt-3">
			<p></p>
		</div>
		<table class="table table-striped table-responsive table-sm">
			<thead>
				<tr>
					<td>S/N</td>
					<td>Question</td>
					<td>Answer</td>
					<td width="180px">Action</td> 
				</tr>
			</thead>
			<tbody>
				<?php $i=1; ?>
				@foreach($quizz as $quiz)
				<tr id="del{{$quiz->id}}">
					<td>{{$i++}}</td>
					<td contenteditable="false">{{$quiz->question}}</td> 
					<td contenteditable="false">{{$quiz->answer}}</td>
					<td width="180px">
						<button type="submit" class="btn btn-sm btn-primary edit-quizz">edit</button>
						<button type="submit" class="btn btn-success btn-sm update-quizz" disabled data-id="{{$quiz->id}}" data-url="{{URL::route('updatequiz')}}">update</button>
						<button type="submit" class="btn btn-sm btn-danger delete-quizz" data-id="{{$quiz->id}}" data-url="{{URL::route('deletequizz')}}">delete</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection	