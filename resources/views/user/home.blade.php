<!DOCTYPE html>
<!-- DEMO -->
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<title>Gaaditrade</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
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

<!--DETAILED INFO-->
<section id='detailed'>
		<div class="container">
			<div class='row'>
				<div class='col-sm-12 col-md-7 col-lg-7 wow fadeInLeft'>
					<h2>Detailed Information</h2>
					<p class='subtitle'>Know why we are better for you to bid online.</p>
				</div>
				<div class='col-sm-6 col-md-6 col-lg-6 wow fadeInLeft'>
					<div class='row'>
						<div class='col-sm-2 col-md-2 col-lg-2'>
							<div class='icon ion-ios7-loop-strong'></div>
						</div>
						<div class='col-sm-10 col-md-10 col-lg-10'>
							<h4>Huge Variety To Bid</h4>
							<p>Huge number of sellers provide you with huge variety of vehicles to bid and win through the app.</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-2 col-md-2 col-lg-2'>
							<div class='icon ion-ios7-stopwatch-outline'></div>
						</div>
						<div class='col-sm-10 col-md-10 col-lg-10'>
							<h4>Huge Time Saver</h4>
							<p>Our easy UI/UX and easy features saves your high amount of time and helps you bid on the go.</p>
						</div>
					</div>
				</div>
				<div class='col-sm-6 col-md-6 col-lg-6 img wow fadeInRight delay-sm'>
					<img src="img/3Phones.png" class='img-responsive' alt>
				</div>
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

</html>