@extends('layouts.app')

@section('content')
	<div class="col-md-12" id="quizz-div">
		<div class="col-md-12 mb-5" id="answered-btn">
			
		</div>
		<p class="quiz-p">Please go to settings and shuffle the quiz to start, if shuffled already you can continue with your quiz. To view answer to the chosen question, you can use the keyboard shortcut by pressing the letter 'a' on your keyboard, good luck!</p>
		<form>
		<input type="hidden" name="category" id="category" value="{{$category}}">
		<input type="hidden" id="url" value="{{URL::route('findquizz')}}">
		<div class="col-md-10">
			<div class="col-md-4 mb-3">
				<div class="form-row">
					<div class="col-md-8">
						<input type="text" class="form-control" id="question_no" name="question_no" placeholder="Question No.">
					</div>
					<div class="col-md-4">
						<button type="" class="mt-1 btn btn-primary btn-sm" id="quizz-submit">Submit</button>
					</div>
				</div>
			</div>
			<label for="quizz-question">Question</label>
			<textarea class="form-control" rows="2" id="quizz-question" disabled></textarea><br/>
			<input type="hidden" value="" id="quizz-ans-hidden">
			<input type="hidden" value="" id="quizz-id">
			<input type="hidden" value="{{URL::route('answered')}}" id="quizz-answered-url">
			<input type="hidden" value="{{URL::route('answeredbtn')}}" id="answeredbtn">
			<label for="quizz-answer">Answer</label>
			<textarea class="form-control" rows="4" id="quizz-answer"></textarea><br/>
			<button type="submit" class="btn btn-success float-right" disabled id="btn-quizz-answer">Answer</button>
		</div>
	</form>
	</div>
@endsection