
<!doctype html>
<html class="no-js" lang>
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Coming Soon | SKIPTOTRACE</title>
<meta name="description" content>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="SoonLaunch">

<link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon_io/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon_io/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon_io/favicon-16x16.png')}}">

<link rel="stylesheet" href="{{asset('home/css/bootstrap-4.5.0.min.css')}}">
<link rel="stylesheet" href="{{asset('home/css/lineicons.css')}}">
<link rel="stylesheet" href="{{asset('home/css/animate.css')}}">
<link rel="stylesheet" href="{{asset('home/css/style.css')}}">
</head>
<body>
<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

<main class="main-14">
  @if (Route::has('login'))
      <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
          @auth
              <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
          @else
              <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

              @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="ml-4 mr-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
              @endif
          @endauth
      </div>
  @endif

<div class="main-wrapper demo-14">

<img src="{{asset('home/img/shape-1.svg')}}" alt class="shape shape-1">
<img src="{{asset('home/img/shape-2.svg')}}" alt class="shape shape-2">
<img src="{{asset('home/img/shape-3.svg')}}" alt class="shape shape-3">
<img src="{{asset('home/img/shape-4.svg')}}" alt class="shape shape-4">
<img src="{{asset('home/img/shape-5.svg')}}" alt class="shape shape-5">
<img src="{{asset('home/img/shape-6.svg')}}" alt class="shape shape-6">

<div class="container">
<div class="row align-items-center">
<div class="col-xl-5 col-lg-6 col-md-6">

<div class="img-wrapper wow fadeInLeft" data-wow-delay=".2s">
<img src="{{asset('home/img/img-1.svg')}}" alt>
</div>

</div>
<div class="col-xl-7 col-lg-6 col-md-6 odd-col">

<div class="content-wrapper">
<h1 class="wow fadeInDown" data-wow-delay=".2s">Coming Soon</h1>
<p class="wow fadeInUp" data-wow-delay=".4s">Currently we are working on our brand new website and will be lunching soon.</p>
<div class="wow fadeInLeft" data-wow-delay=".2s" data-countdown="2024/1/31"></div>



</div>

</div>
</div>
</div>
</div>
</main>


<script src="{{asset('home/js/modernizr-3.5.0.min.js')}}"></script>
<script src="{{asset('home/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('home/js/popper.min.js')}}"></script>
<script src="{{asset('home/js/bootstrap-4.5.0.min.js')}}"></script>
<script src="{{asset('home/js/countdown.js')}}"></script>
<script src="{{asset('home/js/wow.min.js')}}"></script>
<script src="{{asset('home/js/main.js')}}"></script>

</body>
</html>
