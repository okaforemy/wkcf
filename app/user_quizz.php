<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_quizz extends Model
{
    public function quizz(){
    	return $this->belongsTo('App\quizz','id');
    }
}
