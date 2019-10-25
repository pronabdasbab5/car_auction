<!DOCTYPE html>
<!-- DEMO -->
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<title>Gaaditrade</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" media="screen">
	<link href="{{ asset('css/owl.theme.css') }}" rel="stylesheet" media="screen">
	<link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet" media="screen">
	<link href="{{ asset('css/style-dark.cs') }}s" rel="stylesheet" media="screen">
	<link href="{{ asset('css/animate.css') }}" rel="stylesheet" media="screen">
	<link href="{{ asset('css/ionicons.css') }}" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="{{ asset('css/nivo-lightbox.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/nivo-themes/default/default.css') }}" type="text/css" />

	<link href="{{ asset('img/logo1.png') }}" rel="shortcut icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
					<h2>Auction </h2>
				</div>
				</div>
				<div class='wow fadeInLeft '>
					
				@foreach($data as $key => $cat)
				<a href="{{url('user/vehicle/' . $cat['auction_id'] . '/' . $cat['vehicle_id'])}}">
					<div class='row live-auction '>
						<div class='col-sm-2 col-md-2 col-lg-2'>
							<div class='icon ion-ios7-loop-strong'></div>
						</div>

						<div class='col-sm-10 col-md-10 col-lg-10'>
						@if($cat['time'])
							<h4><span class='icon fa fa-clock-o' style="font-size: 22px!important;"></span>&nbsp Ends In {{$cat['time']}}</h4>
						@endif
						
						@if($cat['vehicle_name'])
							<h3 style="color: #f33d18;">{{$cat['vehicle_name']}}</h3>
						@endif
						
						<div class="float-details slideshow-container">
						@foreach($cat['images'] as $i => $img)
						<div style="padding: 10%;" class="mySlides fade">
						
						
						@if($img['img'])
							<img src="{{ $img['img'] }}">
						@endif
				
						</div>
						@endforeach
						<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
						<a class="next" onclick="plusSlides(1)">&#10095;</a>
						
						</div>
							
		<div class="float-details vehi-info">				
						
						@if($cat['regisation_no'])
							<h4><span class='icon fa fa-list-alt' style="font-size: 22px!important;"></span>&nbsp Registration Number: {{$cat['regisation_no']}}</h4>
						@endif
						@if($cat['regisation_available'])
							<h4><span class='icon fa fa-list-alt' style="font-size: 22px!important;"></span>&nbsp Registration Available: {{$cat['regisation_available']}}</h4>
						@endif
						@if($cat['regisation_no'])
							<h4><span class='icon fa fa-file-text' style="font-size: 22px!important;"></span>&nbsp Registration No: {{$cat['regisation_no']}}</h4>
						@endif
						@if($cat['mfg_month_year'])
							<h4><span class='icon fa fa-calendar-check-o' style="font-size: 22px!important;"></span>&nbsp Manufature Date: {{$cat['mfg_month_year']}}</h4>
						@endif
						@if($cat['fuel_type'])
							<h4><span class='icon fa fa-list' style="font-size: 22px!important;"></span>&nbsp Fuel Type: {{$cat['fuel_type']}}</h4>
						@endif
						@if($cat['owner_type'])
							<h4><span class='icon fa fa-users' style="font-size: 22px!important;"></span>&nbsp Owner Type: {{$cat['owner_type']}}</h4>
						@endif
						@if($cat['state'])
							<h4><span class='icon fa fa-map-marker' style="font-size: 22px!important;"></span>&nbsp State: {{$cat['state']}}</h4>
						@endif
						@if($cat['transmission_type'])
							<h4><span class='icon fa fa-car' style="font-size: 22px!important;"></span>&nbsp Transmission Type: {{$cat['transmission_type']}}</h4>
						@endif
						</div>
						@if($cat['total_remaining_bids'])
							<h4>Bids Remaining: {{$cat['total_remaining_bids']}}</h4> <br>
						@endif
<div class="bid-details">
						@if($cat['current_bid_amount'])
						<input  type="number" min="{{$cat['current_bid_amount']}}"  value="{{$cat['current_bid_amount']}}">
							<!-- <h4>Current Bid Amount: {{$cat['current_bid_amount']}}</h4> -->

						@endif
						<input  class="bid-details-btn" type="button" type="submit" value="BID">
						</div>
						

					</div>	
					</div>
					</a>
					@endforeach
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
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>

</body>

</html>