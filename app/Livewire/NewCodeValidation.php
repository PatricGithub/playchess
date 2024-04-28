<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;
use App\Models\Code;

class NewCodeValidation extends Component
{
    public $code;
    public $errorMessage;

    public function render()
    {
        return view('livewire.new-code-validation');
    }

    public function checkCode()
    {
        // Retrieve the code from the database
        $codeModel = Code::where('code', $this->code)->first();

        // Check if the code exists
        if ($codeModel) {
            // Check if the code has been used
            if ($codeModel->used) {
                $this->errorMessage = 'This code is already taken.';
            } else {
                // Set the code as used
                $codeModel->used = true;
                $codeModel->save();

                // Set the code as a cookie
                Cookie::queue('validated_code', $this->code, 60); // 60 minutes

                // Redirect to the 'entry-survey' URL
                return redirect()->to('/informed-consent');
            }
        } else {
            $this->errorMessage = 'Invalid code. Please try again.';
        }
    }
}
