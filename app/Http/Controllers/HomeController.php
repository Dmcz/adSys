<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Questions;
use \App\Models\QuestionResults;
use App\Http\Requests\CreateAnserRequset;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function questionnaire($no = '')
    {
        $question = Questions::where('no',$no)->first();
        if(empty($question)){
            abort(404);
        }
        

        return view('questionnaire',[
            'question' => $question
        ]);
    }

    public function questionnaireSave(CreateAnserRequset $request, $no = '')
    {
        $question = Questions::where('no',$no)->first();
        if(empty($question)){
            abort(404);
        }


        $data = $request->validated();

        $questionResults = new QuestionResults();
        $questionResults->user_id = $question->user_id;
        $questionResults->question_id = $question->id;
        $questionResults->contact_name = $data['contact_name'];
        $questionResults->contact_mobile = $data['contact_mobile'];
        $questionResults->content = $data['radioData'];

        $action = $questionResults->save();

        if($action){
            return response()->json([
                'status' => 'success',
                'msg' => $question->redirect_text
            ]);
        }else{
            return response()->json([
                'status' => 'fail',
                'msg' => '提交失败'
            ]);
        }
    }
}
