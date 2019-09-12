<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quizz extends Model
{
    public function user_quizz(){
    	return $this->hasMany('App\user_quizz','user_id');
    }
}
