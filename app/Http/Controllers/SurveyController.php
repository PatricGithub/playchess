<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function show()
    {
        return view('entry-survey');
    }

    public function exit_survey()
    {
        return view('exit_survey');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
