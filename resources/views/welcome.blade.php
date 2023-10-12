<!DOCTYPE html>
<html lang="it">
 <head>
   <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Farmacia Lodi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap core CSS -->
  <link href = "https://casaromei.cultura.gov.it/css/bootstrap.min.css" rel="stylesheet" />
  <link href = "https://casaromei.cultura.gov.it/css/modern-business.css" rel="stylesheet" />
  <link href = "https://casaromei.cultura.gov.it/css/style.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="app.css">

  <!-- <link rel="stylesheet" href="https://casaromei.cultura.gov.it/css/immagini.css"/> -->
 </head>
 <body>


<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/nav.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('css/testo.css') }}"/>
<!-- ==================================================================== -->



</header>

 <!-- section-header.// -->
<!-- ========================= SECTION CONTENT ========================= -->

<nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-primary">
  <div class="container" >
  <a class="navbar-brand" href="/"><b>Farmacia Lodi</b></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  

<div align:right class="d-none d-lg-block " >
    @if (Route::has('login'))
                
                    @auth
                        
                            <a href="{{ url('/dashboard') }}" class="navbar-brand2" style="margin-right:10px;">Dashboard</a><p></p>
                        
                        
                    @else
                        <a href="{{ route('login') }}" class="navbar-brand2" style="margin-right:10px;">Login</a> 

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="navbar-brand2">Registrazione</a>
                        @endif
                    @endauth
                
            @endif
</div>
    <!--<img src="img/ingl.png"> -->
</nav>


</div>

  <header style="max-height: 400px overflow: hidden;"> 

  <link href = "https://casaromei.cultura.gov.it/css/card.css" rel="stylesheet"/>

  <img class= "Imm" src="{{ asset('farmacia-interno.jpg') }}">
   
  </header>


  <!-- Page Content -->

  <div class="container">
      <hr>
   



    <!-- Features Section -->
    <div class="row">
      <div class="col-lg-8" >
        <br>
        <p style="font-size:20px;">La farmacia Lodi è ubicata a Ferrara in via Dei Calzolai 446 con ampia area di sosta davanti alla farmacia. 
                        È diretta dal 1998 dalla dottoressa Menegatti e dal suo staff, quattro farmacisti a disposizione del cliente. 
                        Comunicazione, Cortesia, Collaborazione, Competenza professionale: un mix di qualità per soddisfare pienamente 
                        un bisogno di salute sempre più complesso ed articolato.
                        Un grande assortimento di farmaco e parafarmaco che puoi trovare e un laboratorio che allestisce in giornata e se richiesto 
                        spedisce a domicilio tutte le Tue preparazioni galeniche.</p>
      </div>
      <div class="col-lg-4 center">
        

      <img style="width:100%;max-width:400px"src="{{ asset('farmacia-interno2.png') }}">
      

      <!-- The Modal -->
      <div id="myModal" class="modal">
        <span class="close" >&times;
        </span>
        <img class="modal-content" id="img01">
        <div id="caption">
        </div>
      </div>

            </div>
    </div>

    <!-- /.row -->

    <hr>

    <div class="row d-flex align-items-stretch" style="margin-top:7%;"> 
    <div class="col-lg-6"> 
        <div class="card h-auto">
            <h4 class="card-header txt">Servizi</h4>
            <script>
                feather.replace()
            </script>
            <div class="card-body">
                <table class="servizi">
                    <tr>
                        <td> • Tampone Rapido CoVID-19</td>
                    </tr>
                    <tr>
                        <td> • Holter cardiaco e pressorio</td>
                    </tr>
                    <tr>
                      <td> • Elettrocardiogramma</td>
                    </tr>
                    <tr>
                      <td> • Test Beta-HCG</td>
                    </tr>
                    <tr>
                      <td> • Glicemia (emoglobina glicata)</td>
                    </tr>
                    <tr>
                      <td> • Analisi Vitamina D</td>
                    </tr>
                    <tr>
                      <td> • Esame Colesterolo e Trigliceridi</td>
                    </tr>
                    <tr>
                      <td> • Controllo della vista</td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6"> <!-- Aggiunto div col-lg-6 per la seconda card -->
        <div class="card h-auto">
            <h4 class="card-header txt">Orari </h4>
            <script>
                feather.replace()
            </script>
            <div class="card-body">
                <table class="tab-orari">
                    <tbody class="txt">
                    <tr><td class="sx">Lunedì</td><td class="dx">8:00 - 19:30</td></tr>
           <tr><td class="sx">Martedì</td><td class="dx">8:00 - 19:30</td></tr>
           <tr><td class="sx">Mercoledì</td><td class="dx">8:00 - 19:30</td></tr>
           <tr><td class="sx">Giovedì</td><td class="dx">8:00 - 19:30</td></tr>
           <tr><td class="sx">Venerdì</td><td class="dx">8:00 - 19:30</td></tr>
           <tr><td class="sx">Sabato</td><td class="dx">8:00 - 14:30</td></tr>
           <tr><td class="sx">Domenica</td><td class="dx">Chiuso</td></tr>
           <tr><td><br></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
 

</body>


</html>
<style>
.privacy{
  color:white;
}
.privacy:hover{
  color:white;
}
.credit{
  padding-left:60px;
  font-size:13px;
  padding-top:30px;
  padding-right:60px;
}
</style>
<!-- Footer -->
<footer class="footer">
    <div class="box dark thick">
    <div class="row white">
      </div>
 
     <!-- <a href="#" ><img class="social align-items-center" src="img/fb.png"></a>-->
      </div>
    <div class="row end">
  		<div class="col-lg-6 col-sm-6 col-xs-7">
      <h6 class = "titolo_fot"> Contatti </h6>
      <div class = "testo">
      <br>Via Dei Calzolai 446 Ferrara<br>
       Email: 
       <a href="mailto:drm-ero.casaromei-fe@cultura.gov.it"> 
        farmaciaLodi@gmail.it </a><br>
        Telefono:
          <a href="tel:+39 0532 234130"> +39 0533 232130</a>
          <h6 class = "titolo" style="margin-left:0px"></h6>
         
      </div>
      
      </div>

      <div class="col-lg-6 col-sm-6 col-xs-7">
      <h6 class = "titolo_fot">Dove trovarci</h6>
      <div class="google-maps2">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2826.0746522382065!2d11.656435476043177!3d44.90147717080863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x477e51119a844597%3A0x9b4fc8b9a0f00a4d!2sVia%20dei%20Calzolai%2C%20446%2C%2044123%20Francolino%20FE!5e0!3m2!1sit!2sit!4v1697017528102!5m2!1sit!2sit" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>      </div>
      </div>
     
    </div>
  
</div>
<div class="row white">
      </div>
      </footer>

   




 </body>