<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Willkommen zur Studie</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
</head>
<body>
    <section class="slide padding-top-md-4 padding-bottom-md-4" style="background: #F6F0E7; height: 100vw">
        <div class="content">
            <div class="container">
                <div class="wrap">
                    <div class="fix-11-12 center">
                        {{-- Display the countdown --}} 
                        <h1 class="margin-top-10" id="countdown">3</h1> 
    
                        {{-- Display the chess boards --}}
                        <div id="chess-boards" style="display: none;">
                                <ul class="flex">
                                <li class="col-6-12">                                    
                                    <img src="{{ $trialOrder->image_path }}" alt="Photo 1">
                                </li>                                    
                                <li class="col-6-12">
                                    <img src="{{ $trialOrder->image_path2 }}" alt="Photo 2">
                                </li>
                                </ul>
                                <button id="show-form-button" class="button">Zur Bewertung</button>

                        </div>
    
                        {{-- Button to show the form --}}    
                        {{-- Feedback Form --}}
                        <form id="feedback-form" action="{{ route('submit-chess-experiment') }}" method="POST" style="display: none;" class="fix-6-12">
                            <h2>Bitte beantworten Sie die Fragen</h2>
                            <input type="hidden" id="reaction-time-input" name="reaction_time">
                            <input type="hidden" name="photo1_path" value="{{ $trialOrder->image_path }}">
                            <input type="hidden" name="nextimg" value="{{ $nextimg }}">
                            <input type="hidden" name="pairing_type" value="{{ $trialOrder->condition }}">
                            <input type="hidden" name="photo2_path" value="{{ $trialOrder->image_path2 }}">
                                                        <div class="likert-scale">
                                <label for="likert_similarity" class="label margin-top-2">Wie ähnlich sind sich die beiden Schachbretter?</label>
                                <select id="likert_similarity" name="likert_similarity" class="input" required>
                                    <option value="" disabled selected>Bitte wählen...</option>
                                    <option value="1">Gar nicht ähnlich</option>
                                    <option value="2">Wenig ähnlich</option>
                                    <option value="3">Ich kann mich nicht entscheiden</option>
                                    <option value="4">Ziemlich ähnlich</option>
                                    <option value="5">Sehr ähnlich</option>
                                </select>
                            </div>
                            <div class="margin-top-2">
                            <label for="description" class="label margin-top-2">Woran haben Sie die Ähnlichkeit fest gemacht?</label>
                            <select id="description" name="description" class="input" required>
                                <option value="" disabled selected>Bitte wählen...</option>
                                <option value="1">Die Schachbretter präsentieren eine fast identische Konstellation der Figuren.</option>
                                <option value="2">Beide Schachpartien können ähnlich zuende gespielt werden.</option>
                                <option value="3">Die Situationen/Probleme auf beiden Schachbrettern können ähnlich gelöst werden.</option>
                                <option value="4">Es gibt keine eindeutige Ähnlichkeit</option> 
                            </select>
                            </div>
                            @csrf
                            <br>
                            <button type="submit" class="box-weiter" style="margin-left: 0px; padding: 15px 45px 15px 45px">Weiter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{-- JavaScript for countdown and form visibility --}}
    <script>
        let seconds = 3;
        let countdown = setInterval(function() {
            document.getElementById('countdown').innerHTML = seconds;
            seconds--;
    
            if (seconds < 0) {
                startReactionTimer();
                clearInterval(countdown);
                document.getElementById('countdown').style.display = 'none';
                document.getElementById('chess-boards').style.display = 'block'; // Display the chess boards
    
                // Get the condition value from the blade
                let condition = "{{ $condition }}";
    
                // Check the condition for actions
                if (condition === 'Ohne Zeitlimit') { 
                } else if (condition === 'Zeitlimit: 30 Sekunden') {
                    // Wait for 30 seconds and then show the form button
                    setTimeout(function() { 
                        document.getElementById('show-form-button').click();
                    }, 30000); // 30 seconds in milliseconds
                } else if (condition === 'Zeitlimit: 15 Sekunden') {
                    // Wait for 15 seconds and then show the form button
                    setTimeout(function() { 
                        document.getElementById('show-form-button').click();
                    }, 15000); // 15 seconds in milliseconds
                }
            }
        }, 1000);
    
        // Function to handle form button click
        document.getElementById('show-form-button').addEventListener('click', function() {
            // Calculate and store reaction time in milliseconds
            let reactionTime = Date.now() - startTime;
            document.getElementById('reaction-time-input').value = reactionTime;
    
            // Hide the chess boards
            document.getElementById('chess-boards').style.display = 'none';
            // Show the feedback form
            document.getElementById('feedback-form').style.display = 'block';
        });
    
        let startTime; // Variable to store the start time of reaction timer
    
        function startReactionTimer() {
            startTime = Date.now(); // Record the start time of the reaction timer
        }
    </script>
</body>
</html>
