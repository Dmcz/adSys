<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Questions;

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
}
