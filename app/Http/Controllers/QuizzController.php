<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\quizz;
use App\user_quizz;

class QuizzController extends Controller
{
    public function addQuizz(){
    	return view('addquiz');
    }

    public function registerQuizz(Request $request){
    	$request->validate([
    		'category'=>'required',
    		'question'=>'required|unique:quizzs',
    		'answer'=>'required',
    	]);

    	$quiz=new quizz;
    	$quiz->category=$request->category;
    	$quiz->question=$request->question;
    	$quiz->answer=$request->answer;
    	$quiz->save();
    	return redirect()->back()->with(['success'=>'Question added successfully'])->withInput();
    }

    public function viewQuizz(){
    	$quizz=quizz::all();
    	return view('viewquizz',compact('quizz'));
    }

    public function QuizzBasic(Request $request){
    	return view('quizz',['category'=>'basic']);
    }

    public function QuizzAdvanced(Request $request){
        return view('quizz',['category'=>'advanced']);
    }

    public function getSettings(){
        return view('settings');
    }

    public function del($myid, $num){
        for($i=1; $i<= $num; $i++){
            $del=user_quizz::Find($myid);
                    $del->delete();
                    $myid++;
        }
        return true;
    }

    public function insertShuffle($id,$allquiz, $total,$arr){
        for($i=1; $i<=$total; $i++){
         $val=$i-1;
                $find=new user_quizz;
                $find->user_id=$id;
                $find->shuffle=$arr[$val];
                 $find->original_count=$allquiz[$val]['id'];
                 $find->category=$allquiz[$val]['category'];
                $find->answered=0;
                $find->save();
        }

    }
    public function Ramdom(){
        $total=count(quizz::all());
        $allquiz=quizz::all();
        $arr=array();
        for($i=1; $i <= $total; $i++){
            $arr[]=$i;
        }
        shuffle($arr);
        $ids=user_quizz::where('user_id',auth()->user()->id)->get();
        $min=0;
        $max=0;
        if($ids){
            $min=$ids->min('id');
            $max=$ids->max('id');
        }
       

 // $find=new user_quizz;
        $id=auth()->user()->id;
        $findid=user_quizz::where('user_id',auth()->user()->id)->where('id',$min)->first();
        $myid=($findid['id'])?$findid['id']:0;
        //return $myid;
         $findone=user_quizz::where('user_id',auth()->user()->id)->where('id',$myid)->first();
         $num_quiz=user_quizz::where('user_id',auth()->user()->id)->get();
         $num=count($num_quiz);

      for($i=1; $i <=$total; $i++){

         //return $findone;
            if($findone !=""){
                if($total==$num){
                    $val=$i-1;
                    $find=user_quizz::find($myid);
                    $find->shuffle=$arr[$val];
                    $find->original_count=$allquiz[$val]['id'];
                    $find->category=$allquiz[$val]['category'];
                    $find->answered=0;
                     $myid++;
                    $find->save();
                }else{
                    if($this->del($myid, $num)){
                         $this->insertShuffle($id,$allquiz, $total,$arr);
                         break;
                    }
                }
                
            }else{
               $this->insertShuffle($id,$allquiz, $total,$arr);
               break;
            }
      }
       return redirect()->back()->with(['success'=>'the quizz was shuffled successfully']);
    }

    public function findQuizz(Request $request){
        //$quizzs=quizz::where('category',$request->category)->first();
        $quizz_b=user_quizz::where('shuffle',$request->number)->where('user_id',auth()->user()->id)->where('category','basic')->first();
        $quizz_a=user_quizz::where('shuffle',$request->number)->where('user_id',auth()->user()->id)->where('category','advanced')->first();
        $quiz_basic='';
        $quiz_advanced='';
        if($request->category=="basic"){
            $quiz_basic=($quizz_b)?quizz::where('id',$quizz_b->original_count)->where('category','basic')->first():'';
        }else if($request->category=="advanced"){
            $quiz_advanced=($quizz_a)?quizz::where('id',$quizz_a->original_count)->where('category','advanced')->first():'';
        }

        if($request->category=='basic'){
            if($quizz_b && $quizz_b->answered==1){
                return response()->json(['error'=>'This question has been taken']);
            }else{
                    return response()->json(['quizz'=>$quiz_basic, 'quiz_id'=>($quizz_b)?$quizz_b->shuffle:0,'basic_category'=>'basic']);
            }
        }

        if($request->category=='advanced'){
            if($quizz_a && $quizz_a->answered==1){
                return response()->json(['error'=>'This question has been taken']);
            }else{
                    return response()->json(['quizz'=>$quiz_advanced, 'quiz_id'=>($quizz_a)?$quizz_a->shuffle:0,'basic_category'=>'advanced']);
            }
        }
    
    }

    public function Answered(Request $request){
        //$quizz=quizz::find($request->id);
       if($request->category=='basic'){
         $quizz=user_quizz::where('user_id',auth()->user()->id)->where('shuffle',$request->id)->where('category','basic')->first();
            $quizz->answered=1;
            $quizz->save();
       }

       if($request->category=='advanced'){
         $quizz=user_quizz::where('user_id',auth()->user()->id)->where('shuffle',$request->id)->where('category','advanced')->first();
            $quizz->answered=1;
            $quizz->save();
       }
    }

    public function checkAnsweredbtn(Request $request){
        //$quizz=quizz::with('user_quizz')->get();
        if($request->category=='basic'){
             $quizz=user_quizz::where('user_id',auth()->user()->id)->where('category','basic')->get();
            $html='';
            foreach($quizz as $q){
                if($q->answered !=1){
                    $html.=' <span class="badge badge-primary">'.$q->shuffle.'</span> ';
                }

                if($q->answered==1){
                    $html.=' <span class="badge badge-danger">'.$q->shuffle.'</span> ';
                }
            }
            return response()->json(['html'=>$html,'basic_category'=>'basic']);
        }

        if($request->category=='advanced'){
             $quizz=user_quizz::where('user_id',auth()->user()->id)->where('category','advanced')->get();
            $html='';
            foreach($quizz as $q){
                if($q->answered !=1){
                    $html.=' <span class="badge badge-primary">'.$q->shuffle.'</span> ';
                }

                if($q->answered==1){
                    $html.=' <span class="badge badge-danger">'.$q->shuffle.'</span> ';
                }
            }
            return response()->json(['html'=>$html,'advanced_category'=>'advanced']);
        }
       
    }

    public function updateQuizz(Request $request){
        if($request->question ==''||$request->answer==''){
            return response()->json(['error'=>'value empty']);
        }

        $quiz=quizz::find($request->id);
        $quiz->question=$request->question;
        $quiz->answer=$request->answer;
        $quiz->save();
        return response()->json(['success'=>'quiz updated successfully']);
    }

    public function deleteQuizz(Request $request){
        $quizz=quizz::find($request->id);
        $quizz->delete();
        return response()->json(['success'=>'quizz deleted successfully']);
    }
}
