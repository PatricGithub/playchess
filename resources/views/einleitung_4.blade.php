<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Anleitung</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .magazin ol,.magazin ul{font-family:"Times New Roman",Times,serif;font-size:20px;margin:1.56em 20px 0}.magazin ul,.magazin_paragraph,blockquote{letter-spacing:-.003em;line-height:28px}.link,.magazin a{text-decoration:underline}.magazin_headline,.magazin_paragraph,blockquote{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif}.no-border-blockquote{border-left:0 solid #000!important}blockquote{font-size:20px;margin:1.56em 0 0;background-color:#fafafa;color:#000;border-left:8px solid #000;padding:42px}.magazin ul{list-style-type:disc}.magazin a{cursor:pointer!important;transition:.4s}.magazin a:hover{opacity:.8}.magazin ol{letter-spacing:-.003em;line-height:30px}.magazin_paragraph{font-size:19px;font-weight:400;margin:1.56em 0 0!important}.magazin_headline{font-weight:600;margin:1.56em 0 1em!important;letter-spacing:0;font-size:44px}@media only screen and (max-width:767px){.magazin_headline{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-weight:600;margin:1.56em 0 1em!important;letter-spacing:0;font-size:24px}.magazin ul{font-size:18px!important;line-height:28px}blockquote{padding:42px 28px;font-size:18px}.fix-12-12,.fix-8-12{padding-left:9px;padding-right:9px}.fix-10-12,.magazin{padding-right:0}.fix-10-12{padding-left:0}}.magazine2 ul{list-style-type:none;padding-left:0;margin-bottom:0!important}.magazine2 ul li strong{font-size:18px}.magazine2 ul li{line-height: 28px; margin:10px 0 5px 5px;padding:0 0 0 25px!important;font-size:19px; position: relative;}.magazine2 ul li:before{font-size: 24px;content:"\2022";color:#e08e69;display:inline-block;position: absolute;left: 0px;}.magazine2 ul li:first-child{margin-top:30px}
        </style>
    @livewireStyles
</head>
<body> 
       
    <section class="slide padding-top-md-4 padding-bottom-md-4" style="background: #F6F0E7;">
        <div class="content">
          <div class="container">
            <div class="wrap">
                <div class="fix-8-12 left magazine2">
                    <h1>Allgemeiner Versuchsablauf</h1>
                    <p class="micro">Ihr Aufgabe ist es die Ähnlichkeit von verschiedenen Schachbrettern zu bewerten.</p>
                    <ul>
                      <li>Es werden Ihnen immer zwei Schachstellungen paarweise dargeboten.</li>
                      <li>Ein 3 Sekunden Countdown wird vor der Präsentation jedes Schachbretts angezeigt, damit Sie sich vorbereiten können.</li>
                      <li>Nun erhalten Sie die zwei Schachstellung, welche Sie vergleichen sollen. Sobald Sie fertig sind drücken Sie auf "Zur Bewertung". Die Zeit die Sie brauchen, bis Sie "Zur Bewertung" gedrückt haben, wird aufgezeichnet.</li>
                      <li>Bitte bewerten Sie, inwieweit Sie glauben, dass die beiden Schachbretter ähnlich sind. Verwenden Sie dazu die Skalierung, die von "Gar nicht ähnlich" bis "Sehr ähnlich" reicht.</li>
                      <li>Nach der Beurteilung der Schachbretter können Sie aus mehreren Antwortmöglichkeiten wählen, um zu begründen, worauf Sie Ihre Einschätzung der Ähnlichkeit gestützt haben.</li>
                    </ul>
                    <br>
                    <p class="micro">Sie werden zufällig einer der drei Zeitdruckbedingungen zugeteilt. Sobald Sie dann 10 Paare bewertet haben, werden Sie zur nächsten Zeitdruckbedingung weitergeleitet. Das Prozedere beginnt erneut. Sie müssen alle 3 Zeitdruckbedingungen durchlaufen, um erfolfreich teilzunehmen.</p>
                    <p class="micro margin-top-2">Es gibt keine richtigen oder falschen Antworten. Bitte geben Sie Ihre ehrliche Meinung an.</p>
                    <p class="micro margin-top-2">Bitte klicken Sie auf "Weiter", um mit dem Experiment zu beginnen.</p>
                    <br>
                    <a href="{{ route('condition') }}" class="button" style="border-radius: 7px; color: white; background-color: green;">Weiter</a>
                </div> 
            </div>
            </div>
            </div>
</section> 

    <!-- Include Livewire Scripts -->
    @livewireScripts
</body>
</html>
