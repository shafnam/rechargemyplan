<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!--- meta tags
    ================================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="RechargeMyPlan&trade; is the ideal way to add plans to any number for the major carriers available in the USA.">  
	<meta name='Keywords' content='recharge, top up, online recharge, airtime, load, reload, send credit, mobile recharge, phone recharge, cellular recharge, cell phone recharge, telephone recharge, online mobile recharge, international recharge, mobile airtime, send airtime, send phone credit, recharge credit, recharge envie mobile, recharge h2o, recharge easygo, recharge lycamobile, recharge rokmobile, recharge patriot mobile, recharge ultra mobile,Buy Wireless Top-ups,recharge plan,recharge my plan,h2o Wireless,Cell Phones,Mobile Phones,Cellular Phone,Cell Phone, pay as you go plan, prepaid plan, unlimited data plan'>
	<meta name="google-site-verification" content="D5YI2k2f1tRjGOAdEWQArgyBgKg3U4XW_o1htIjnLyo" />
    <meta name='robots' content="INDEX, FOLLOW"/>
    <meta name="format-detection" content="telephone=no">
	
	<link rel="canonical" hreflang="en" href="https://www.rechargemyplan.com" />
	<meta property='og:image' content="https://rechargemyplan.com/images/recharge-my-plan-logo-black.png" />
	<meta property='og:locale' content='en_US'/>
	<meta property='og:title' content='RechargeMyPlan&reg | Wireless top-up h2o, envie, easygo, lycamobile, Patriot, Ultra'/>
	<meta property='og:description' content="RechargeMyPlan&reg is the ideal way to add plans to any number for the major carriers available in the USA." />
	<meta property='og:url' content='https://www.rechargemyplan.com/'/>
	<meta property='og:site_name' content='rechargemyplan'/>
	<meta property='og:type' content='website'/>

    <meta name="author" content="">
    
    <!-- mobile specific metas
    ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RechargeMyPlan') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/hover.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800,900" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- favicons
	================================================== -->
    <link rel="shortcut icon" href="{{{ asset('images/favicon.ico') }}}">

</head>
<body>
    <div id="app">
        @include('inc.navbar')

        @yield('content')

        @include('inc.footer')
    </div>

    
    <!-- custom -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/validation.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>	
    <script src="{{ asset('js/jquery.mask.js') }}"></script>	
    <script src="{{ asset('js/script.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script> --}}
</body>
</html>
