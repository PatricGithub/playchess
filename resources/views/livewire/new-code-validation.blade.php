<div>
    <form wire:submit.prevent="checkCode">
         <ul class="flex">
            <li class="col-8-12">        
                <input type="text" id="code" wire:model.defer="code" class="input" required placeholder="Bitte tragen Sie Ihren sechs stelligen Code hier ein">
            </li>
            <li class="col-4-12">
                <button type="submit" class="box-weiter" style="width:100%; margin-top: 5px">Weiter</button>
            </li>
        </ul>
    </form>

    @if($errorMessage)
        <div style="color: red;">{{ $errorMessage }}</div>
    @endif
</div>
