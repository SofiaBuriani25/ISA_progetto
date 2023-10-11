<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://casaromei.cultura.gov.it/css/nav.css"/>

        <!-- Styles -->
       
    </head>
    <body class="antialiased">
        
    <div class="navbar">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        
                            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        
                        
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif




            

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="grid grid-cols-7 gap-6">
                    <div class="col-span-5">
            <p>Perdersi in un’atmosfera lontana nel tempo, immergersi in ambienti stupefacenti ed emozionanti, 
          scoprire dettagli, decorazioni e strutture ormai altrove dimenticate: 
          Casa Romei offre al visitatore la possibilità di vivere una esperienza unica e di comprendere gli stili ed i modi 
          di vivere della ricca quotidianità delle potenti famiglie della corte estense tra il XV e il XVI secolo.</p>
          <br>
          s 
          <br>
          <br>
          s 
          <br>
          <br>
          s 
          <br>
          <br>
          s 
          <br>
          <br>
          s 
          <br>
          <br>
          s 
          <br>
          <br>
          s 
          <br>
          <br>
          s 
          <br>
          <br>
          s 
          <br>
          <br>
          s 
          <br>
          <br>
          s 
          <br>
          </div>
          <div class="col-span-2">

                
                </div>
                </div>
            </div>
                    
                       <b> Sito in manutenzione</b>
                       <img src="{{ asset('logo.png') }}" alt="Logo" class="block" width="200" height="100">

                    <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var navbar = $(".navbar");
        var sticky = navbar.offset().top;

        $(window).scroll(function() {
            if ($(window).scrollTop() >= sticky) {
                navbar.addClass("sticky");
            } else {
                navbar.removeClass("sticky");
            }
        });
    });
</script>

</html>
