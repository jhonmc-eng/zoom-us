<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAC - GOBIERNO REGIONAL DE TACNA</title>
    <link rel="icon" href="{{asset('favicon.png')}}">
    <link rel="stylesheet" href="{{asset('css/client/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/main-color.css')}}" id="colors">

</head>

<body class="transparent-header">

	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Header Container
		================================================== -->
        @include('client.layouts.header')
		<!-- Header Container / End -->
        @yield('content')
		
		@include('client.layouts.footer')

	</div>
	<!-- Wrapper / End -->


	<!-- Scripts
================================================== -->
	<script type="text/javascript" src="{{asset('js/client/jquery-3.4.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/jquery-migrate-3.1.0.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/mmenu.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/chosen.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/slick.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/rangeslider.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/magnific-popup.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/waypoints.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/counterup.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/jquery-ui.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/tooltips.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/custom.js')}}"></script>


	<!-- Leaflet // Docs: https://leafletjs.com/ -->
	<script src="{{asset('js/client/leaflet.min.js')}}"></script>

	<!-- Leaflet Maps Scripts -->
	
	<script type="text/javascript" src="{{asset('js/client/leaflet-markercluster.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/leaflet-gesture-handling.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/client/leaflet-listeo.js')}}"></script>

	<!-- Leaflet Geocoder + Search Autocomplete // Docs: https://github.com/perliedman/leaflet-control-geocoder -->
	<script src="{{asset('js/client/leaflet-autocomplete.js')}}"></script>
	<script src="{{asset('js/client/leaflet-control-geocoder.js')}}"></script>


	<!-- Typed Script -->
	<script type="text/javascript" src="{{asset('js/client/typed.js')}}"></script>
	<script>
		var typed = new Typed('.typed-words', {
			strings: ["Únete a nuestro equipo, ¡¿Que esperas?!"],
			typeSpeed: 80,
			backSpeed: 80,
			backDelay: 4000,
			startDelay: 1000,
			loop: true,
			showCursor: true
		});
		
	</script>
	<style>
		#header {
			position: relative;
			z-index: 999;
			padding: 8px 0 8px;
			box-shadow: 0 0 12px 0 rgb(0 0 0 / 12%);
			font-size: 16px;
			background-color: #D40E1E;
		}

		#navigation.style-1 {
			margin-top: 11px;
		}

		.header-widget {
			position: relative;
			top: 8px;
			height: 54px;
		}
		#header.cloned {
			padding: 8px 0 8px;
		}
		#header.cloned #logo img {
			transform: translate3d(0, 0, 0);
			max-width: 150px;
			margin-top: 1px;
		}
		#logo img {
			max-height: 56px;
			width: auto;
			transform: translate3d(0, 0, 0);
		}
		.transparent-header .main-search-container .main-search-inner {
			top: 0;
			transform: none;
			padding-top: 210px;
			padding-bottom: 50px; 
		}
		img.footer-logo {
			max-height: 80px;
			width: auto;
		}
	</style>

	<!-- Style Switcher
================================================== -->
	<script src="{{asset('js/client/switcher.js')}}"></script>

	<div id="style-switcher">
		<h2>Color Switcher <a href="#"><i class="sl sl-icon-settings"></i></a></h2>

		<div>
			<ul class="colors" id="color1">
				<li><a href="#" class="main" title="Main"></a></li>
				<li><a href="#" class="blue" title="Blue"></a></li>
				<li><a href="#" class="green" title="Green"></a></li>
				<li><a href="#" class="orange" title="Orange"></a></li>
				<li><a href="#" class="navy" title="Navy"></a></li>
				<li><a href="#" class="yellow" title="Yellow"></a></li>
				<li><a href="#" class="peach" title="Peach"></a></li>
				<li><a href="#" class="beige" title="Beige"></a></li>
				<li><a href="#" class="purple" title="Purple"></a></li>
				<li><a href="#" class="celadon" title="Celadon"></a></li>
				<li><a href="#" class="red" title="Red"></a></li>
				<li><a href="#" class="brown" title="Brown"></a></li>
				<li><a href="#" class="cherry" title="Cherry"></a></li>
				<li><a href="#" class="cyan" title="Cyan"></a></li>
				<li><a href="#" class="gray" title="Gray"></a></li>
				<li><a href="#" class="olive" title="Olive"></a></li>
			</ul>
		</div>

	</div>
	<!-- Style Switcher / End -->


</body>

<!-- Mirrored from www.vasterad.com/themes/listeo_082019/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 May 2020 16:33:39 GMT -->

</html>