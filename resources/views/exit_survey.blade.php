<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fragebogen</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Include Livewire Scripts -->
    @livewireStyles
</head>
<body>
    @php
    $validatedCode = request()->cookie('validated_code');
    @endphp

       
    <section class="slide padding-top-md-4 padding-bottom-md-4" style="background: #F6F0E7; height: 100vw">
        <div class="content">
          <div class="container">
            <div class="wrap">
                <div class="fix-8-12 center">
        <!-- Livewire Code Validation Component -->
                @livewire('exit-survey', ['validatedCode' => $validatedCode])
            </div> 
</div>
</div>
</div>
</section> 

    <!-- Include Livewire Scripts -->
    @livewireScripts
</body>
</html>
