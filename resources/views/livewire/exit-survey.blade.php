<div>
    <div>
        <h1>Feedback zu Ihrer Erfahrung</h1>
    
        <form wire:submit.prevent="submitSurvey">
            <div class="form-group">
                <label for="instructionsClear" class="label">1. Haben Sie die Anweisungen verständlich gefunden?</label> 
                <select class="input" wire:model="instructionsClear" required>
                    <option value="">Bitte wählen...</option>
                    <option value="1">Ja</option>
                    <option value="2">Nein</option> 
                </select>
                @error('instructionsClear') <span class="error">{{ $message }}</span> @enderror
            </div>
    
            <div class="margin-top-2">
                <label for="confidence" class="label">2. Wie zuversichtlich mit der Richtigkeit Ihrer Antworten?</label>
                <select class="input" wire:model="confidence" required>
                    <option value="">Bitte wählen...</option>
                    <option value="1">Gar nicht zuversichtlich</option>
                    <option value="2">Nicht sehr zuversichtlich</option>
                    <option value="3">Neutral</option>
                    <option value="4">Zuversichtlich</option>
                    <option value="5">Sehr zuversichtlich</option>
                </select>
                @error('confidence') <span class="error">{{ $message }}</span> @enderror
            </div>
    
            <div class="margin-top-2">
                <label for="chessboardSpeed" class="label">3. Bewerten Sie die Geschwindigkeit, mit der die beiden Schachbretter angezeigt wurden.</label>
                <select class="input" wire:model="chessboardSpeed" required>
                    <option value="">Bitte wählen...</option>
                    <option value="slow">Zu langsam</option>
                    <option value="normal">Genau richtig</option>
                    <option value="fast">Zu schnell</option>
                </select>
                @error('chessboardSpeed') <span class="error">{{ $message }}</span> @enderror
            </div>
    
            <button type="submit" class="box-weiter margin-top-2" style="margin-left: 0px; padding: 15px 45px 15px 45px">Absenden</button>
        </form>
    </div>
    
</div>
