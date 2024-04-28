<div>
    <section class="slide padding-top-md-4 padding-bottom-md-4" style="background: #F6F0E7; height: 100vw">
        <div class="content">
            <div class="container">
                <div class="wrap">
                    <div class="fix-12-12 center">
                        {{-- Display the countdown --}}
                        <div id="countdown">
                            <h1 class="margin-top-10">{{ $seconds }}</h1>
                        </div>
    
                        {{-- Display the chess boards --}}
                        <div id="chess-boards" wire:ignore>
                            @foreach($trialOrders as $trialOrder)
                                <ul class="flex">
                                    <li class="col-6-12">                                    
                                        <img src="{{ $trialOrder->photo1_path }}" alt="Photo 1">
                                    </li>                                    
                                    <li class="col-6-12">
                                        <img src="{{ $trialOrder->photo2_path }}" alt="Photo 2">
                                    </li>
                                    <p>Pairing Type: {{ $trialOrder->pairing_type }}</p>
                                </ul>
                            @endforeach
                        </div>
    
                        {{-- Button to show the form --}}
                        @if($showFormButton)
                            <button wire:click="showForm">Show Feedback Form</button>
                        @endif
    
                        {{-- Feedback Form --}}
                        @if($showFormButton)
                            <form wire:submit.prevent="submitForm" style="display: none;">
                                {{-- Hidden input field to store reaction time --}}
                                <input type="hidden" id="reaction-time-input" name="reaction_time_{{ $trialOrders[0]->id }}">
                                <input type="hidden" name="photo1_path_{{ $trialOrders[0]->id }}" value="{{ $trialOrders[0]->photo1_path }}">
                                <input type="hidden" name="photo2_path_{{ $trialOrders[0]->id }}" value="{{ $trialOrders[0]->photo2_path }}">
                                <input type="hidden" name="reaction_time_{{ $trialOrders[0]->id }}" value="{{ $trialOrders[0]->reaction_time }}">
                                <label for="description_{{ $trialOrders[0]->id }}" class="label">Description:</label>
                                <input type="text" wire:model.defer="description" name="description_{{ $trialOrders[0]->id }}" class="input" id="description_{{ $trialOrders[0]->id }}">
                                @csrf
                                <button type="submit">Continue</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Livewire JavaScript --}}
    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.on('startCountdown', () => {
                    let countdown = setInterval(function() {
                        @this.seconds--;
                    }, 1000);
    
                    Livewire.on('countdownEnded', () => {
                        clearInterval(countdown);
                        document.getElementById('countdown').style.display = 'none';
                        document.getElementById('chess-boards').style.display = 'block'; // Display the chess boards
    
                        // Get the condition value from the blade
                        let condition = "{{ $condition }}";
    
                        // Check the condition for actions
                        if (condition === 'Ohne Zeitlimit') {
                            @this.showForm();
                        } else if (condition === 'Zeitlimit: 30 Sekunden') {
                            // Wait for 30 seconds and then show the form button
                            setTimeout(function() {
                                @this.showForm();
                            }, 30000); // 30 seconds in milliseconds
                        } else if (condition === 'Zeitlimit: 15 Sekunden') {
                            // Wait for 15 seconds and then show the form button
                            setTimeout(function() {
                                @this.showForm();
                            }, 15000); // 15 seconds in milliseconds
                        }
                    });
                });
            });
        </script>
    @endpush
    
</div>