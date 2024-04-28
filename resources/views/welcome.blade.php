<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Willkommen zur Studie</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Include Livewire Scripts -->
    @livewireStyles
</head>
<body>
    <section class="slide padding-top-md-4 padding-bottom-md-4" style="background: #F6F0E7; height: 100vw">
        <div class="content">
          <div class="container">
            <div class="wrap">
                <div class="fix-8-12 center">
        <h1>Willkommen zur Studie Kategorisierung im Schach</h1>
        <p>Bitte geben Sie zunächst Ihren Code ein um teilzunehmen:</p>
        <!-- Livewire Code Validation Component -->
        @livewire('new-code-validation')
    </div> 
</div>
</div>
</div>
</section> 

    <!-- Include Livewire Scripts -->
    @livewireScripts
</body>
</html>
