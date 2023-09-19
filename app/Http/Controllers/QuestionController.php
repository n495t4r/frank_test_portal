<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    function allQuestions(){
        $questions = Question::where('assessment_id', '=', 1)->get();
        $assessment = Assessment::where('id', '=', 1)->get();
        $assessmentDone = true;
        
        // $userAssessmentStatus = User::find('status', Where, Auth::user->status)
        if(Auth::user()->status == null)
            return view('dashboard', compact('questions', 'assessment'));
        else
            return view('dashboard', compact('assessmentDone'));
    }
}
