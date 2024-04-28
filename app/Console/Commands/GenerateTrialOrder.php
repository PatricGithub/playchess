<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TrialOrder;
use Illuminate\Support\Facades\Log;

class GenerateTrialOrder extends Command
{
    protected $signature = 'trial:order {sets : The number of sets of orders to generate}';

    protected $description = 'Generate permuted trial order';

    public function handle()
{
    $sets = $this->argument('sets');
    $matches = [];
    $control = [];
    $superficial = [];

    // Load matches folder
    for ($i = 1; $i <= 10; $i++) {
        $matches[] = glob(public_path('stimuli/matches/' . $i . '/*'));
        Log::info("Matches Array: " . json_encode($matches));
    }

    // Load control folder
    $control = glob(public_path('stimuli/control/*'));

    // Load superficial folder
    for ($i = 1; $i <= 5; $i++) {
        $superficial[] = glob(public_path('stimuli/superficial/' . $i . '/*'));
    }

    for ($setNumber = 1; $setNumber <= $sets; $setNumber++) {
        $pairings = [];

        // Create pairings based on your rules
        foreach ($matches as $matchSet) {
            foreach ($matchSet as $match) {
                // Rule 1: Match with second photo from the same subfolder
                $pairings[] = [$match, $matchSet[1]];

                // Rule 2: Match with a photo from the control folder
                $pairings[] = [$match, $control[array_rand($control)]];

                // Rule 3: Match with a photo from the superficial folder
                $pairings[] = [$match, $superficial[rand(0, 4)][array_rand($superficial[rand(0, 4)])]];
            }
        }

        // Create pairings for control folder
        foreach ($control as $controlPhoto) {
            // Rule 1: Match with a photo from the matches folder
            $pairings[] = [$controlPhoto, $matches[array_rand($matches)][array_rand($matches[array_rand($matches)])]];

            // Rule 2: Match with a photo from the same control folder
            $pairings[] = [$controlPhoto, $this->getRandomPhotoWithoutCurrent($control, $controlPhoto)];

            // Rule 3: Match with a photo from the superficial folder
            $pairings[] = [$controlPhoto, $superficial[rand(0, 4)][array_rand($superficial[rand(0, 4)])]];
        }

        // Create pairings for superficial folder
        foreach ($superficial as $superficialSet) {
            foreach ($superficialSet as $superficialPhoto) {
                // Log details before each pairing
                Log::info("Superficial Set: $superficialPhoto");

                // Rule 1: Match with a photo from the matches folder
                $matchFromMatches = $matches[array_rand($matches)][array_rand($matches[array_rand($matches)])];
                Log::info("Match from Matches: $matchFromMatches");
                $pairings[] = [$superficialPhoto, $matchFromMatches];

                // Rule 2: Match with a photo from the same superficial folder
                $sameSuperficial = $superficialSet[1];
                Log::info("Same Superficial: $sameSuperficial");
                $pairings[] = [$superficialPhoto, $sameSuperficial];

                // Rule 3: Match with a photo from the control folder
                $controlPhoto = $this->getRandomPhotoWithoutCurrent($control, $superficialPhoto);
                Log::info("Control Photo: $controlPhoto");
                $pairings[] = [$superficialPhoto, $controlPhoto];
            }
        }

        // Shuffle the pairings to create a random order
        shuffle($pairings);

        // Save pairings for this set to the database
        foreach ($pairings as $pairing) {
            // Replace folder paths with an empty string
            $photo1 = str_replace(public_path(''), '', $pairing[0]);
            $photo2 = str_replace(public_path(''), '', $pairing[1]);

            $pairingType = $this->getPairingType($photo1, $photo2);

            $this->line("Set: $setNumber, Photo 1: $photo1, Photo 2: $photo2, Pairing Type: $pairingType");

            TrialOrder::create([
                'set_number' => $setNumber,
                'photo1_path' => $photo1,
                'photo2_path' => $photo2,
                'pairing_type' => $this->getPairingType($photo1, $photo2),
            ]);
        }

        $this->info("Set $setNumber of trial orders saved to the database.");
    }

    $this->info("All $sets sets of trial orders saved to the database.");
}


    private function getPairingType($photo1, $photo2)
    {
        // Determine pairing type based on the paths
        if (strpos($photo1, 'matches') !== false && strpos($photo2, 'matches') !== false) {
            return 'matches_matches';
        } elseif (strpos($photo1, 'matches') !== false && strpos($photo2, 'control') !== false) {
            return 'matches_control';
        } elseif (strpos($photo1, 'matches') !== false && strpos($photo2, 'superficial') !== false) {
            return 'matches_superficial';
        } elseif (strpos($photo1, 'control') !== false && strpos($photo2, 'matches') !== false) {
            return 'control_matches';
        } elseif (strpos($photo1, 'control') !== false && strpos($photo2, 'control') !== false) {
            return 'control_control';
        } elseif (strpos($photo1, 'control') !== false && strpos($photo2, 'superficial') !== false) {
            return 'control_superficial';
        } elseif (strpos($photo1, 'superficial') !== false && strpos($photo2, 'matches') !== false) {
            return 'superficial_matches';
        } elseif (strpos($photo1, 'superficial') !== false && strpos($photo2, 'control') !== false) {
            return 'superficial_control';
        } else {
            return 'superficial_superficial';
        }
    }

    private function getRandomPhotoWithoutCurrent($photos, $currentPhoto)
    {
        $index = array_search($currentPhoto, $photos);
        if ($index !== false) {
            unset($photos[$index]);
        }
        return $photos[array_rand($photos)];
    }

}
