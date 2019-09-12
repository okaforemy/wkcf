@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4 class="text-center">Welcome to Who Knows the Faith Quizz Programme</h4>
            <div class="quizz-link-div text-center">
                <div class="quizz-link">
                    <a href="{{URL::route('quizzbasic')}}"><span class="advance-basic" style="background: #229954"><p>Basic</p></span></a> <a href="{{URL::route('quizzadvanced')}}" class="quizz-link"><span class="advance-basic" style="background: #C70039"><p>Advanced</p></span></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
