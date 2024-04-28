<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\ExitUmfrage;

class ExitSurvey extends Component
{
    public $instructionsClear;
    public $confidence;
    public $chessboardSpeed;

    public function render()
    {
        return view('livewire.exit-survey');
    }

    public function submitSurvey(Request $request)
    {
        $validatedCode = $request->cookie('validated_code');
        $participant = Participant::where('unique_id', $validatedCode)->first();
        // Get the condition of the participant
        $condition = $participant->condition;
        // Validate the input
        $this->validate([
            'instructionsClear' => 'required',
            'confidence' => 'required|integer|between:1,5',
            'chessboardSpeed' => 'required|in:slow,normal,fast',
        ]);

        // Save the survey data to the database
        ExitUmfrage::create([
            'instructionsClear' => $this->instructionsClear,
            'confidence' => $this->confidence,
            'chessboardSpeed' => $this->chessboardSpeed,
            'unique_id' => $validatedCode,
            'condition' => $condition,
        ]);
        
        return redirect()->to('/thank-you');

        // Redirect or do any other logic after submitting the survey
    }

}
