<!DOCTYPE html>
<html>
<head>
    <title>Chess Game</title>
    <!-- Include necessary CSS for chessboard -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chessboard-1.0.0.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <section class="slide padding-top-md-4 padding-bottom-md-4" style="background: #F6F0E7; height: 100vw">
        <div class="content">
          <div class="container">
            <div class="wrap">
                <div class="fix-6-12 center">

     <div id="board"></div>
     <h1>Weiß am Zug</h1>

</div> 
</div>
</div>
</div>
</section> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chess.js/1.0.0/chess.min.js"></script>
    <script src="{{ asset('js/chessboard-1.0.0.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var initialPosition = '8/5r2/pR4p1/P1k5/2P1Kp2/1P6/8/8 w - - 0 1';
            var board = Chessboard('board', {
                draggable: true,
                position: initialPosition,
                onDrop: onDrop
            });
        
         
            function onDrop(source, target) {
                var move = source + target;
        
                // Get the CSRF token from the meta tag
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
                // Make an AJAX request to your Laravel route
                var url = '/post-puzzle-2';
                var data = {
                    move: move,
                };
        
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        console.log('Response:', response);
                        // Check if there's a cookie to redirect
                        if (response.redirect) {
                            window.location.href = response.redirect; // Redirect to the given URL
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        // Handle errors
                    }
                });
            }
        });
        </script>
        
</body>
</html>
