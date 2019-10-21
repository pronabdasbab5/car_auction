<!DOCTYPE html>
<!-- DEMO -->
<html lang="en">

<!-- Mirrored from tanguyalbrici.com/Rego/Rego-andr-dark.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Oct 2019 09:12:37 GMT -->

<!-- Mirrored from gaaditrade.in/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 20 Oct 2019 11:57:11 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<title>Gaaditrade</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<link href="css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="css/owl.theme.css" rel="stylesheet" media="screen">
	<link href="css/owl.carousel.css" rel="stylesheet" media="screen">
	<link href="css/style-dark.css" rel="stylesheet" media="screen">
	<link href="css/animate.css" rel="stylesheet" media="screen">
	<link href="css/ionicons.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="css/nivo-lightbox.css" type="text/css" />
	<link rel="stylesheet" href="css/nivo-themes/default/default.css" type="text/css" />

	<link href="img/logo1.png" rel="shortcut icon">

	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Merriweather:300italic' rel='stylesheet' type='text/css'>
	
</head>
<body class='android'>

	@include('user.header')

	@if(isset($message))
              <div id="sendmessage">{{$message}}</div>
              @endif
	<section id='contact'>
		<div class="container">
			<div class='wow fadeInDown'>
				<h2>Login</h2>
				<p class='subtitle'>Don't have an account. <a href="{{url('user/register')}}">Sign Up Now</a></p>
			</div>
			<div id='newsletter-form'>
            <form method="POST" action="{{url('user/login')}}">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input required class="subscribe-input" type="text" name="user_name" placeholder="Email">
				<input required class="subscribe-input" type="password" name="password" placeholder="Password">
				<button class='btn btn-primary subscribe-submit' type="submit">Login</button>
            </form>
            </div>
		</div>
	</section>

	<!--FOOTER-->
	@include('user.footer')

	
	<script src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/retina.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/wow.js"></script>
	<script src="js/jquery.nav.js"></script>
	<script src="js/jquery.scrollTo.min.js"></script>
	<script src="js/nivo-lightbox.min.js"></script>
	<script type="text/javascript">
		// general variables
		myWindow = $(window)
		windowHeight = myWindow.height()
		header = $('#header')
		svgRect = $('#svg-rect')
		showNav = $('#show-nav')
		hideNav = $('#hide-nav')
		navUl = $('#nav-ul')

		// set header height
		if (windowHeight>=900) {
			header.css('height', windowHeight - 250)
		}
		else{
			header.css('height', windowHeight)
		}

		headerHeight = header.outerHeight()
		headerWidth = header.outerWidth()

		$(document).ready(function() {

			// header animation svg
			var svgHeader = $('#svg-header')

			svgRect.attr('height', 1.5*headerHeight)
			svgRect.attr('width', 2*headerWidth)
			svgHeader.css('transform', 'rotate(-55deg)')
			svgHeader.css('-webkit-transform', 'rotate(-55deg)')
			svgHeader.css('ms-transform', 'rotate(-55deg)')

			// wow.js initialization
			if (myWindow.width()>530) {
				new WOW().init();
			};

			// jquery.nav.js initialization
			$('.nav-inner', '#header').onePageNav();

			// Nivo Lightbox initialization
			$('#screenshots a').nivoLightbox({
				effect: 'fadeScale',
				keyboardNav: true,
			});

			// owl.carousel.js initialization
			$("#screens-carousel").owlCarousel({
				items : 4,
				itemsDesktop : [1199,4],
				itemsDesktopSmall : [980,3],
				itemsTablet: [768,2],
				itemsMobile : [480,1],
			});
			$("#reviews-carousel").owlCarousel({
				items : 1,
				itemsDesktop : [1199,1],
				itemsDesktopSmall : [980,1],
				itemsTablet: [768,1],
				itemsMobile : [480,1],
				autoPlay: 8000,
			});
		});
		// Responsive navigation show/hide
		function showNavig() {
			navUl.css('display','block')
			hideNav.css('display','block')
			showNav.css('display','none')
		}
		function hideNavig() {
			navUl.css('display','none')
			showNav.css('display','block')
			hideNav.css('display','none')
		}
		showNav.click(function() {
			showNavig();
		});
		hideNav.click(function() {
			hideNavig();
		});
		$( "#off-nav" ).click(function() {
			hideNavig();
		});
		$( "#nav-ul > li" ).click(function() {
			if (myWindow.width()<=767) {
				hideNavig();
			};
		});

		// Demo switcher
// 		$( "#demo-switcher .demo-icon" ).click(function() {
// 			if($('#demo-switcher').hasClass("active")){
// 				$('#demo-switcher').animate({"left":"-140px"},function(){
// 					$('#demo-switcher').toggleClass("active");
// 				});						
// 			}
// 			else{
// 				$('#demo-switcher').animate({"left":"0px"},function(){
// 				$('#demo-switcher').toggleClass("active");
// 			});			
// 		} 
// 		});

		// Resize event handler
		myWindow.resize(function() {
			// show/hide responsive navigation
			if (myWindow.width()>767) {
				navUl.css('display','block')
			}
			else{
				navUl.css('display','none')
			}

			// resize SVG rectangle in header
			headerWidth = header.outerWidth()
			svgRect.attr('height', 1.5*headerHeight)
			svgRect.attr('width', 2*headerWidth)
		});

		// scrollTo buttons
		menuBarHeight = $('#menu-bar-fixed').outerHeight();

		$('.scrollTo-download').click(function(){
			$.scrollTo( $('#download').offset().top-menuBarHeight+'px' , 800 );
		});
		$('.scrollTo-about').click(function(){
			$.scrollTo( $('#about').offset().top-menuBarHeight+'px' , 800 );
		});
		$('.scrollTo-header').click(function(){
			$.scrollTo( header , 800 );
		});


		footerHeight = $('footer').outerHeight();
		$('#static-footer').css('margin-top', footerHeight+'px');

		// scroll event
		window.onscroll = scroll;
		
		function scroll () {

			var wScrollTop = $(window).scrollTop();
			var wScrollBot = wScrollTop + $(window).height();
			var pageHeight = $(document).height();
			var footerContent = $("#footer-content")

			// fixed footer opacity change onscroll
			if(wScrollBot>pageHeight-(footerHeight/2)){
				var newOpacity = (0.99/(footerHeight/2)) * (wScrollBot-(pageHeight-(footerHeight/2)))
				footerContent.css('opacity', newOpacity);
			}
			else{
				footerContent.css('opacity','0');
			}
			
			// fixed navigation show/hide
			var menuBarFixed = $('#menu-bar-fixed')

			if (wScrollTop >= headerHeight - menuBarFixed.outerHeight()) {
				menuBarFixed.css('top','0');
				menuBarFixed.css('opacity','1');
			}
			else{
				menuBarFixed.css('top',-menuBarFixed.outerHeight()+'px');
				menuBarFixed.css('opacity','0');
			};
		}

	</script>

</body>

<!-- Mirrored from tanguyalbrici.com/Rego/Rego-andr-dark.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Oct 2019 09:12:41 GMT -->

<!-- Mirrored from gaaditrade.in/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 20 Oct 2019 11:57:42 GMT -->
</html>