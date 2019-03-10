<!DOCTYPE html>
<!-- 
Developed By Rajesh Upadhayaya
Email Id: rajeshupadhayaya@gmail.com
Contact: 7032725900
 -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <?php //echo public_path(); ?>
</head>
<body>
    <!-- <div id="app"> -->
        
    <nav class="navbar navbar-main sticky-top navbar-expand-lg navbar-sticky navbar-transparent">
        <div class="container">
          <a class="navbar-brand" href="{{route('home')}}">{{ config('app.name', 'Laravel') }}</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse menu-item" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-lg-center">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('journal') }}">Journal</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('guidelines') }}">Guidelines</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('menuscript') }}">Submit Menuscript</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('contactus') }}">Contact Us</a>
              </li>
              
            </ul>
          </div>
      </div>
    </nav>
    <main>
        @yield('content')
    </main>

    <!-- footer -->
    <footer class="footer">
      
      <div class="top-footer gray-bg">
        <div class="container">
          <div class="row">
            <div class="col-sm-4">
              <p>{{ config('app.name', 'Laravel') }} Licence</p>
              
              <img alt="Creative Commons License" style="border-width:0;float:left;" src="https://i.creativecommons.org/l/by/4.0/88x31.png"></br>
              <p>This work is licensed under a Creative Commons Attribution 4.0 International License.</p>
            </div>

            <div class="col-sm-4">
              <p>Quick Links</p>
              <ul style="padding: 0">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('journal') }}">Journal</a></li>
                <li><a href="{{ route('guidelines') }}">Guidelines</a></li>
                <li><a href="{{ route('menuscript') }}">Submit Menuscript</a></li>
              </ul>
            </div>
            
            <div class="col-sm-4">
              <p>Contact Info</p>
              <div class="row">
                <div class="col-sm-1">
                  <i class="fas fa-map-marker"></i>
                </div>
                <div class="col-sm-11">
                  <address>Test Address</address>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-1">
                  <i class="fas fa-phone"></i>
                </div>
                <div class="col-sm-11">
                  <p>+91 123-456-789</p>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-1">
                  <i class="fas fa-envelope"></i>
                </div>
                <div class="col-sm-11">
                  <address>info@testemail.com</address>
                </div>
              </div>

              <ul class="faico">
                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="bottom-footer">
        <div class="container">
          <div class="row">
            <div class="col-sm-4">
              <p>&copy; {{ config('app.name', 'Laravel') }}</p>
            </div>
            <div class="col-sm-4">
              
            </div>
            <div class="col-sm-4 text-right">
              <span style="font-size:7px;">Developed By: <a href="mailto:rajeshupadhayaya@gmail.com">Rajesh</a></span>
            </div>
          </div>
        </div>
      </div>
    </footer>
    
</body>
</html>

