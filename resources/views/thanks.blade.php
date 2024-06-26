<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dankeschön</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Include Livewire Scripts -->
    @livewireStyles
</head>
<body>
    @php
    $validatedCode = request()->cookie('validated_code');
    @endphp

       
    <section class="slide padding-top-md-4 padding-bottom-md-4" style="background: #F6F0E7;">
        <div class="content">
          <div class="container">
            <div class="wrap">
                <div class="fix-8-12 center">
        <!-- Livewire Code Validation Component -->
                <h1>Vielen Dank für Ihre Teilnahme!</h1>
            </div> 
</div>
</div>
</div>
</section> 

    <!-- Include Livewire Scripts -->
    @livewireScripts
</body>
</html>
