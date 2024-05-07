<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use App\Models\Participant;
use App\Models\Condition;
use App\Models\TrialOrder;
use App\Models\Answer;
use App\Models\Image;
use App\Models\Judge;
use Illuminate\Support\Facades\Log;

class ChessExperimentController extends Controller
{    
    public function einleitung()
    { 
        return view('einleitung');
    }

    public function puzzle_1()
    {
        return view('puzzle_1');
    }

    public function puzzle_1_post(Request $request)
{
        // Correct move
        $correct = "e5f6";

        // Move sent from the frontend
        $move = $request->input('move');

        // Check if the move is correct
        if ($move === $correct) {
            $message = 'Correct move!';
            $isCorrect = 1;
        } else {
            $message = 'Incorrect move. Try again!';
            $isCorrect = 0;
        }

        // Set a cookie to store whether the puzzle was correct
        Cookie::queue('puzzle_1_solved', $isCorrect, 60); // 60 minutes expiry


        Log::info('Move: ' . json_encode($move));
        Log::info('Cookie puzzle_2_solved: ' . Cookie::get('puzzle_2_solved'));

        // Redirect to puzzle-2 route with the cookie
        // Construct the response data
            $responseData = [
                'message' => $message,
                'redirect' => route('puzzle_2'), // This is the route you want to redirect to
            ];

            // Return the response as JSON
            return response()->json($responseData);

    } 

public function puzzle_2()
    {
        return view('puzzle_2');
    }

    public function puzzle_2_post(Request $request)
    {
            // Correct move
            $correct = "e4d3";
    
            // Move sent from the frontend
            $move = $request->input('move');
    
            // Check if the move is correct
            if ($move === $correct) {
                $message = 'Correct move!';
                $isCorrect = 1;
            } else {
                $message = 'Incorrect move. Try again!';
                $isCorrect = 0;
            }
    
            // Set a cookie to store whether the puzzle was correct 
            Cookie::queue('puzzle_2_solved', $isCorrect, 60); // 60 minutes expiry
            // Redirect to puzzle-2 route with the cookie
            // Construct the response data
                $responseData = [
                    'message' => $message,
                    'redirect' => route('puzzle_3'), // This is the route you want to redirect to
                ];
    
                // Return the response as JSON
                return response()->json($responseData);
    
        } 

        public function puzzle_3()
        {
            return view('puzzle_3');
        }

        public function puzzle_3_post(Request $request)
    {
            // Correct move
            $correct = "f1e1";
    
            // Move sent from the frontend
            $move = $request->input('move');
    
            // Check if the move is correct
            if ($move === $correct) {
                $message = 'Correct move!';
                $isCorrect = 1;
            } else {
                $message = 'Incorrect move. Try again!';
                $isCorrect = 0;
            }
    
            // Set a cookie to store whether the puzzle was correct 
            Cookie::queue('puzzle_3_solved', $isCorrect, 60); // 60 minutes expiry

            $validatedCode = $request->cookie('validated_code');

            // Get the values of the puzzle solved cookies
            $puzzle1Solved = $request->cookie('puzzle_1_solved');
            $puzzle2Solved = $request->cookie('puzzle_2_solved');
            $puzzle3Solved = $request->cookie('puzzle_3_solved');;
            // Calculate the total number of puzzles solved
            $totalSolved = ($puzzle1Solved ? 1 : 0) + ($puzzle2Solved ? 1 : 0) + ($puzzle3Solved ? 1 : 0);
            // Check if the total number of puzzles solved is 2 or more
            if ($totalSolved >= 2) {
                // Find the participant by validated code
                $participant = Participant::where('unique_id', $validatedCode)->first();

                if ($participant) {
                    // Update the expertise based on the total solved puzzles
                    $expertise = ($totalSolved > 1) ? 'advance' : 'novice';
                    $participant->update(['expertise' => $expertise]);
                 }
            }
    
            // Redirect to puzzle-2 route with the cookie
            // Construct the response data
                $responseData = [
                    'message' => $message,
                    'redirect' => route('einleitung_2'), // This is the route you want to redirect to
                ];
    
                // Return the response as JSON
                return response()->json($responseData);
    
        } 

        public function einleitung_2(Request $request)
        {
            // Get the values of the puzzle solved cookies
            $puzzle1Solved = $request->cookie('puzzle_1_solved');
            $puzzle2Solved = $request->cookie('puzzle_2_solved');
            $puzzle3Solved = $request->cookie('puzzle_3_solved');
    
            // Pass the values to the view
            return view('einleitung_2', [
                'puzzle1Solved' => $puzzle1Solved,
                'puzzle2Solved' => $puzzle2Solved,
                'puzzle3Solved' => $puzzle3Solved,
            ]);
        }

        public function einleitung_3()
    {
        return view('einleitung_3');
    }

    public function einleitung_4()
    {
        Judge::where('taken', 1)->update(['taken' => 0]);
        return view('einleitung_4');
    }

    public function condition(Request $request)
{
    // Fetch conditions where taken = 0
    $availableConditions = Condition::where('taken', 0)->get();

    if ($availableConditions->isEmpty()) {
        // Reset all taken values to 0 if all conditions are taken
        Condition::query()->update(['taken' => 0]);

        // Fetch conditions again after reset
        $availableConditions = Condition::where('taken', 0)->get();
    }

    // Shuffle the available conditions
    $shuffledConditions = $availableConditions->shuffle();

    // Select the first condition
    $selectedCondition = $shuffledConditions->first();
    $selectedCondition->taken = 1;
    $selectedCondition->save();

    $validatedCode = $request->cookie('validated_code');
    $participant = Participant::where('unique_id', $validatedCode)->first();

    //save here the condition to the participant
    $participant->condition = $selectedCondition->condition;
    $participant->save();
    $nextimg = 1;

    $messages = [
        'Ohne Zeitlimit' => 'Du kannst Dir soviel Zeit lassen wie Du willst. Unter den 2 Schachbrettern wird der Button "Zur Bewertung" sein. Sobald Du auf ihn drückst, gelangst Du zur Bewertung. Viel Spaß beim Experiment.',
        'Zeitlimit: 30 Sekunden' => 'Du hast nur 30 Sekunden um deine Entscheidung zu treffen. Falls du nicht innerhalb von 30 Sekunden antworten kannst, wirst Du automatisch zur Bewertung weitergeleitet.  Unter den 2 Schachbrettern wird der Button "Zur Bewertung" sein. Sobald Du auf ihn drückst, gelangst Du zur Bewertung. Viel Spaß beim Experiment.',
        'Zeitlimit: 15 Sekunden' => 'Du hast nur 15 Sekunden um deine Entscheidung zu treffen. Falls du nicht innerhalb von 15 Sekunden antworten kannst, wirst Du automatisch zur Bewertung weitergeleitet.  Unter den 2 Schachbrettern wird der Button "Zur Bewertung" sein. Sobald Du auf ihn drückst, gelangst Du zur Bewertung. Viel Spaß beim Experiment..',
    ];

    // Pass the selected condition and its message to the blade template
    return view('condition', [
        'condition' => $selectedCondition->condition,
        'message' => $messages[$selectedCondition->condition],
        'nextimg' => $nextimg,
    ]);
}

public function chess_experiment($nextimg, Request $request)
{
    // Get the first trial order where taken = 0
    $trialOrder2 = Image::where('taken', 0)->get();
    $trialOrder3 = $trialOrder2->shuffle();
    $trialOrder = $trialOrder3->first();

    // If there are no trial orders available, redirect or handle accordingly
    if (!$trialOrder) {
        return redirect()->route('no-trial-orders');
    }

    // Update taken to 1 so it won't be used again
    $trialOrder->taken = 1;
    $trialOrder->save();

    // Get the validated code from the cookie
    $validatedCode = $request->cookie('validated_code');
    // Get the participant based on the validated code
    $participant = Participant::where('unique_id', $validatedCode)->first();
    // Get the condition of the participant
    $condition = $participant->condition;

    return view('chess_experiment', [
        'trialOrder' => $trialOrder,
        'condition' => $condition,
        'nextimg' => $nextimg,
    ]);
}

public function submitChessExperiment(Request $request)
{
    // Get the next image number from the request
    $nextimg = $request->input('nextimg');

    // Get the validated code from the cookie
    $validatedCode = $request->cookie('validated_code');

    // Get the participant based on the validated code
    $participant = Participant::where('unique_id', $validatedCode)->first();

    // Get the condition of the participant
    $condition = $participant->condition;

    // Process the submitted data for this specific pair
    $photo1Path = $request->input('photo1_path');
    $photo2Path = $request->input('photo2_path');
    $reactionTime = $request->input('reaction_time');
    $description = $request->input('description');
    $pairing_type = $request->input('pairing_type');
    $likert = $request->input('likert_similarity');

    // Save the answer to the database
    Answer::create([
        'validated_code' => $validatedCode,
        'likert' => $likert,
        'photo1_path' => $photo1Path,
        'photo2_path' => $photo2Path,
        'condition' => $condition,
        'reaction_time' => $reactionTime,
        'description' => $description, 
        'pairing_type' => $pairing_type, 
    ]);
    if ($nextimg == 30) {
        // Redirect to the desired route for image number 121
        return redirect()->route('exit_survey');
    }
    // Calculate the next image number
    $nextImageNumber = $nextimg + 1;

    // You can handle this redirection based on your logic
    return redirect()->route('chess_experiment2', ['nextimg' => $nextImageNumber]);
}
}