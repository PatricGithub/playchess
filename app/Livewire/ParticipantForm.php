<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Participant;
use Illuminate\Http\Request;


class ParticipantForm extends Component
{
    
    public $ranking;
    public $age;
    public $ageStarted;
    public $gender;
    public $frequencyPlaying;
    public $validatedCode;
    public $participantCode;

    public $frequencyPlayingOptions = [
        '0-1 Stunden pro Woche',
        '1-2 Stunden pro Woche',
        '2-3 Stunden pro Woche',
        '3-4 Stunden pro Woche',
        'Mehr als 4 Stunden pro Woche',
    ];

    public $genderOptions = [
        'männlich' => 'Männlich',
        'weiblich' => 'Weiblich',
    ];

    public function mount($validatedCode)
        {
            $this->validatedCode = $validatedCode;
        }

    public function render()
    {
        return view('livewire.participant-form');
    }

    public function saveParticipant(Request $request)
    {
        $validatedCode = $request->cookie('validated_code'); 
        \Log::info('Validated Code: ' . $this->validatedCode);
        // Validate the input data
        $this->validate([
            'ranking' => 'required',
            'age' => 'required',
            'ageStarted' => 'required',
            'gender' => 'required',
            'frequencyPlaying' => 'required',
         ]);

        // Save the participant data to the database
        Participant::create([
            'ranking' => $this->ranking,
            'age' => $this->age,
            'age_started' => $this->ageStarted,
            'gender' => $this->gender,
            'frequency_playing' => $this->frequencyPlaying,
            'unique_id' => $this->validatedCode,
        ]);
 
        return redirect()->to('/einleitung');
    }
}
