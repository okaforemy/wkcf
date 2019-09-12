@extends('layouts.app')

@section('content')
		<div class="col-md-5 center-div">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif

			@if (session('success'))
			    <div class="alert alert-success">
			        {{ session('success') }}
			    </div>
			@endif
			<h4 class="text-center mb-3 mt-2">Add Quizz</h4>
			<form action="{{URL::route('regquizz')}}" method="post">
				<select class="custom-select" name="category">
			    	<option value="">Select Category</option>
			    	<option value="">----------------</option>
			    	<option value="basic" {{ old('category')=='basic'?'selected':''}}>Basic</option> 
			    	<option value="advanced" {{ old('category')=='advanced'?'selected':''}}>Advanced</option> 
			  	</select>
			  	<br/>
			  	<textarea class="form-control mt-3" name="question" rows="2" placeholder="Add Question"> {{ old('addquestion') }}</textarea>
			  	<textarea class="form-control mt-3" rows="3" name="answer" placeholder="Add Answer"> {{ old('addanswer') }}</textarea>
			  	<div><button type="submit" class="btn btn-primary mt-3 float-right">Add Question</button></div>
			  	@csrf
			</form>
		</div>
@endsection