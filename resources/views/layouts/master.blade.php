<!DOCTYPE html>
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <title>@yield('title', "UdaipurRealtors: Buy/Sell/Rent Apartments, Houses, Offices in Udaipur")</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="Uraipur Realtors, apartments for rent, houses for rent, apartments, homes for rent, houses for rent near me, homes for rent near me, rental homes, for rent, rental properties, apartment finder, condos for rent, houses for rent by owner, apt for rent, flats to rent, cheap houses for rent, duplex for rent, places for rent near me, rent, apartment search, rentals near me, cheap apartments, townhomes for rent, for rent by owner, places for rent, studio apartments, 1 bedroom apartments for rent, rentals, house rentals, cheap apartments for rent, studios for rent, cheap homes for rent, 4 bedroom house for rent, rental, houses for rent near me cheap, one bedroom apartments, 1 bedroom apartments, 2 bedroom apartments, one bedroom apartment for rent, studio apartments for rent, real estate rent, 3 bedroom apartments, luxury apartments, rental properties near me, apt finder, furnished apartments, 1 bedroom house for rent, private rentals, apartment list, houses and apartments for rent, 2 bedroom apartments for rent">
    <meta name="google-site-verification" content="ZS50I9jRouqsX4Qni4dFHaQbNjkgELXzWs2yh9CdwBw" />

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
    <!-- Scripts -->
    <script>
    window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!}
    </script>
    <script type="text/javascript">
        window.smartlook||(function(d) {
        var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
        var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
        c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
        })(document);
        smartlook('init', '9f1e1d5c359a5e28eb9897400b5d481223ed7356');
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5bc2233208387933e5bb3749/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-126491044-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-126491044-1');
    </script>
</head>
<body>
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Header Container
        ================================================== -->
        <header id="header-container" class="header-style-2">
            <!-- Header -->
            <div id="header">
                <div class="container">
                    <!-- Left Side Content -->
                    <div class="left-side">
                        <!-- Logo -->
                        <div id="logo">
                            <a href="{{ route('index') }}"><img src="/images/logo.png" alt=""></a>
                            <!-- Logo for Sticky Header -->
                            {{-- <a href="{{ route('index') }}" class="sticky-logo"><img src="/images/logo-white.png" alt=""></a> --}}
                        </div>
                    </div>
                    <!-- Left Side Content / End -->
                    <!-- Right Side Content / End -->
                    <div class="right-side">
                        <ul class="header-widget">
                            @if(Auth::check())
                                <li class=""><a href="{{ route('dashboard.properties') }}" class="button border">Welcome, {{ Auth::user()->firstName() }}</a></li>
                            @else
                                <li class=""><a href="{{ route('login') }}" class="button border">Login/Register</a></li>
                            @endif
                            <li class="with-btn"><a href="{{ route('create') }}" class="button border">Submit Property</a></li>
                        </ul>
                    </div>
                    <!-- Right Side Content / End -->
                </div>
                <!-- Mobile Navigation -->
                <div class="menu-responsive">
                    <i class="fa fa-reorder menu-trigger"></i>
                </div>
                <!-- Main Navigation -->
                <nav id="navigation" class="style-2">
                    <div class="container">
                        <ul id="responsive">
                            <li><a class="current" href="{{ route('index') }}">Home</a></li>
                            <li>
                                <a href="#">Buy</a>
                                <ul>
                                    <li><a href="{{ route('properties.index').'?type=plot&status=sell' }}">Plot</a></li>
                                    <li><a href="{{ route('properties.index').'?type=apartment&status=sell' }}">Apartment</a></li>
                                    <li><a href="{{ route('properties.index').'?type=house&status=sell' }}">House</a></li>
                                    <li><a href="{{ route('properties.index').'?type=commercial&status=sell' }}">Commercial</a></li>
                                    <li><a href="{{ route('properties.index').'?type=land&status=sell' }}">Land</a></li>
                                    <li><a href="{{ route('properties.index').'?type=farmhouse&status=sell' }}">FarmHouse</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Rent</a>
                                <ul>
                                    <li><a href="{{ route('properties.index').'?type=plot&status=rent' }}">Plot</a></li>
                                    <li><a href="{{ route('properties.index').'?type=apartment&status=rent' }}">Apartment</a></li>
                                    <li><a href="{{ route('properties.index').'?type=house&status=rent' }}">House</a></li>
                                    <li><a href="{{ route('properties.index').'?type=commercial&status=rent' }}">Commercial</a></li>
                                    <li><a href="{{ route('properties.index').'?type=land&status=rent' }}">Land</a></li>
                                    <li><a href="{{ route('properties.index').'?type=paying-guest&status=rent' }}">Paying Guest</a></li>
                                    <li><a href="{{ route('properties.index').'?type=hostel&status=rent' }}">Hostel</a></li>
                                    <li><a href="{{ route('properties.index').'?type=farmhouse&status=rent' }}">FarmHouse</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('create') }}">Sell</a></li>
                            <li><a href="{{ route('properties.index') }}">All Properies</a></li>
                            <li>
                                <a href="{{ route('ur-specials') }}">UR Specials</a>
                                <ul>
                                    <li><a href="{{ route('ur-specials') }}#vastu-consultation">Vastu consultation</a></li>
                                    <li><a href="{{ route('ur-specials') }}#2D-3d-designing">2D &amp; 3D Designing</a></li>
                                    <li><a href="{{ route('ur-specials') }}#farm-house-development">Farm House Development</a></li>
                                    <li><a href="{{ route('ur-specials') }}#property-photoshoot">Property Photoshoot</a></li>
                                    <li><a href="{{ route('ur-specials') }}#landscaping">Landscaping</a></li>
                                    <li><a href="{{ route('ur-specials') }}#home-loan">Home Loan</a></li>
                                    <li><a href="{{ route('ur-specials') }}#new-home-construction">New Home Construction</a></li>
                                    <li><a href="{{ route('ur-specials') }}#remodeling-renovation">Remodeling &amp; Renovation</a></li>
                                    <li><a href="{{ route('ur-specials') }}#movers-packers">Movers &amp; Packers</a></li>
                                    <li><a href="{{ route('ur-specials') }}#property-news">Property News</a></li>
                                    <li><a href="{{ route('ur-specials') }}#maping">Maping</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->
            </div>
            <!-- Header / End -->
        </header>
        <div class="clearfix"></div>
        <!-- Header Container / End -->
        @yield('content')
        <!-- Footer
        ================================================== -->
        <div id="footer" class="dark">
            <!-- Main -->
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-6">
                        <img class="footer-logo" src="/images/logo.png" alt="">
                        <br><br>
                        <p>The UDAIPUR REALTORS is one of the leading real estate website which helps to find your dream property wherever you want and connecting them with the best local professionals who can help.</p>
                        Advertise With Us: <span><a href="tel:+91-8209132352">+91-8209132352</a><br>
                    </div>
                    <div class="col-md-4 col-sm-6 ">
                        <h4>Helpful Links</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('login') }}">Sign Up</a></li>
                            <li><a href="{{ route('profile') }}">My Account</a></li>
                            <li><a href="{{ route('create') }}">Add Property</a></li>
                        </ul>
                        <ul class="footer-links">
                            <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms') }}">Terms &amp; Conditions</a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-3  col-sm-12">
                        <h4>Contact Us</h4>
                        <div class="text-widget">
                            <span>83-K Road New Keshav Nagar,</span> <br>
                            <span>Roopsagar Road, Udaipur, Raj.</span> <br>
                            Phone: <span><a href="tel:+91-8209132352">+91-8209132352</a><br>
                            Phone: <a href="tel:+91-9672988488">+91-9672988488</a></span><br>
                            E-Mail:<span> <a href="mailto:info@udaipurrealtors.com">info@udaipurrealtors.com</a></span><br>
                        </div>
                        <ul class="social-icons margin-top-20">
                            <li><a class="facebook" href="https://www.facebook.com/udaipurrealtors"><i class="icon-facebook"></i></a></li>
                            <li><a class="twitter" href="https://www.twitter.com/udaipurrealtors"><i class="icon-twitter"></i></a></li>
                            <li><a class="instagram" href="https://www.instagram.com/udaipurrealtors"><i class="icon-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Copyright -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyrights">&copy; {{ date('Y') }} {{ str_replace('http://', '', $app['config']['app.url']) }}. All Rights Reserved.</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer / End -->
        <!-- Back To Top Button -->
        <div id="backtotop"><a href="#"></a></div>
        <script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyBkqTLd4soOdPaAfAAVfV5sirSR36Z_rv0&language=en"></script>
        <script type="text/javascript" src="{{ mix('js/all.js') }}"></script>
        @yield('afterScripts')
    </body>
</html>