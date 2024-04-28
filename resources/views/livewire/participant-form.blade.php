<div>
    <h1>Fragebogen</h1>
    <form wire:submit.prevent="saveParticipant" class="fix-6-12 left">
        <div>
            <label for="ranking" class="label">Wie hoch ist Ihr Ranking/ELO?</label>
            <input type="text" id="ranking" wire:model.defer="ranking" class="input" required>
        </div>
<br>
        <div>
            <label for="age" class="label">Wie alt sind Sie?</label>
            <input type="number" id="age" wire:model.defer="age" class="input" required>
        </div>
<br>
        <div>
            <label for="ageStarted" class="label">Mit wie viel Jahren haben Sie angefangen Schach zu lernen/spielen?</label>
            <input type="number" id="ageStarted" wire:model.defer="ageStarted" class="input" required>
        </div>
<br>
        <div>
            <label for="gender" class="label">Geschlecht:</label>
            <select id="gender" wire:model.defer="gender" class="input" required>
                <option value="">Bitte auswählen</option>
                @foreach ($genderOptions as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
     </div>
<br>
        <div>
            <label for="frequencyPlaying" class="label">Wie oft haben Sie im letzten Jahr pro Woche Schach gespielt, oder sich mit Schach beschäftigt (Training, Analyse eigener/fremder Partien etc.)?</label>
            <select id="frequencyPlaying" wire:model.defer="frequencyPlaying" class="input" required>
                <option value="">Bitte auswählen</option>
                @foreach ($frequencyPlayingOptions as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
                </div>  
        <div>
            <button type="submit" class="box-weiter" style="margin-top: 25px; margin-left: 0px; padding: 15px 45px 15px 45px">Abschicken</button>
        </div>
    </form>
</div>
