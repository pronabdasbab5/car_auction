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

	@include('user.header1')

<!--DETAILED INFO-->
<section id='detailed'>
		<div class="container">
			<div class='row '>
				<div class='col-sm-12 col-md-7 col-lg-7 wow fadeInLeft'>
					<h2>Vehicle Details</h2>
				</div>
				</div>
				<div class='wow fadeInLeft'>

				
				<div class='row live-auction '>
				<div class='col-sm-2 col-md-2 col-lg-2'>
							<div class='icon ion-ios7-loop-strong'></div>
						</div>

						<div class='col-sm-10 col-md-10 col-lg-10'>
							@if($data['time'])
							<h4><span class='icon fa fa-clock-o' style="font-size: 22px!important;"></span>&nbsp Ends In:  {{$data['time']}}</h4>
						@endif
						
						

						@if($data['status'])
							<h4><span class='icon fa fa-star-o' style="font-size: 22px!important;"></span>&nbsp status : {{$data['status']}}</h4>
						@endif
						
						<div style="    width: 100%;"class="float-details slideshow-container">
						@foreach($data['images'] as $i => $img)
						<div style="padding: 10%;" class="mySlides fade">
						
						
						@if($img['img'])
							<img style="    max-height: 550px;" src="{{ $img['img'] }}">
						@endif
				
						</div>
						@endforeach
						<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
						<a class="next" onclick="plusSlides(1)">&#10095;</a>
						
						</div>
</div>
						<div class="v-summry vehi-info">	

						@if($data['vehicle_name'])
							<h4><span class='icon fa fa-car' style="font-size: 22px!important;"></span>&nbsp Vehicle Name: {{$data['vehicle_name']}}</h4>
						@endif
</div>
						@if($data['summary'])
							<h4 class="summ-h4"><span class='icon fa fa-sticky-note' style="font-size: 22px!important;"></span>&nbsp summary: <br> {!!$data['summary']!!}</h4>
						@endif
						
<div class="all-details">
					

						@if($data['regisation_no'])
							<h4> Registration Number: {{$data['regisation_no']}}</h4>
						@endif
						@if($data['regisation_available'])
							<h4> Registration Available: {{$data['regisation_available']}}</h4>
						@endif
                        @if($data['mfg_month_year'])
							<h4> Manufature Date: {{$data['mfg_month_year']}}</h4>
						@endif
						@if($data['fuel_type'])
							<h4>Fuel Type: {{$data['fuel_type']}}</h4>
						@endif
						@if($data['owner_type'])
							<h4></span>&nbsp Owner Type: {{$data['owner_type']}}</h4>
						@endif
						@if($data['state'])
							<h4> State: {{$data['state']}}</h4>
						@endif
						@if($data['transmission_type'])
							<h4>Transmission Type: {{$data['transmission_type']}}</h4>
						@endif
						
						@if($data['bc_mfg_month_year'])
							<h4>Manufature Month and Year: {{$data['bc_mfg_month_year']}}</h4>
						@endif
						@if($data['bc_color'])
							<h4>Color: {{$data['bc_color']}}</h4>
						@endif
						@if($data['bc_engine_no'])
							<h4>engine no: {{$data['bc_engine_no']}}</h4>
						@endif
						@if($data['bc_chasis_no'])
							<h4>chasis_no: {{$data['bc_chasis_no']}}</h4>
						@endif
						@if($data['bc_transmission_type'])
							<h4>Transmission Type: {{$data['bc_transmission_type']}}</h4>
						@endif
						@if($data['bc_fuel_type'])
							<h4>Fuel Type: {{$data['bc_fuel_type']}}</h4>
						@endif
						@if($data['bc_owner_type'])
							<h4> Owner Type: {{$data['bc_owner_type']}}</h4>
						@endif
						@if($data['bc_vehicle_type'])
							<h4>Vehicle Type {{$data['bc_vehicle_type']}}</h4>
						@endif

						@if($data['bc_ownership'])
							<h4></span>&nbsp Ownership: {{$data['bc_ownership']}}</h4>
						@endif
						@if($data['rc_rc_available'])
							<h4></span>&nbsp RC availability: {{$data['rc_rc_available']}}</h4>
						@endif
						@if($data['rc_registration_no'])
							<h4></span>&nbsp Registration no: {{$data['rc_registration_no']}}</h4>
						@endif

						@if($data['rc_registration_date'])
							<h4></span>&nbsp Registration Date: {{$data['rc_registration_date']}}</h4>
						@endif
						@if($data['rc_reg_as'])
							<h4> RC Registration: {{$data['rc_reg_as']}}</h4>
						@endif


						</div>
<div class="all-details">

						@if($data['tx_road_text_expiray_date'])
							<h4> Road Text Expire date: {{$data['tx_road_text_expiray_date']}}</h4>
						@endif
						@if($data['tx_permit_type'])
							<h4>Text permit type: {{$data['tx_permit_type']}}</h4>
						@endif
						@if($data['tx_permit_expiray_date'])
							<h4>Text permit expire date: {{$data['tx_permit_expiray_date']}}</h4>
						@endif

						
						@if($data['tx_fitness_expiray_date'])
							<h4>Text Fitness expire date: {{$data['tx_fitness_expiray_date']}}</h4>
						@endif
						@if($data['tx_road_taxt_validity'])
							<h4>Road Text Validity: {{$data['tx_road_taxt_validity']}}</h4>
						@endif
						@if($data['hi_financer_name'])
						<h4>Finencer Name: {{$data['hi_financer_name']}}</h4>
					
							@endif
						@if($data['hi_car_under_hypothecation'])
							<h4>Car Under hypothecation: {{$data['hi_car_under_hypothecation']}}</h4>
						
						@endif
						@if($data['hi_noc_available'])
							<h4>Noc Available: {{$data['hi_noc_available']}}</h4>
						@endif
						@if($data['hi_repo_date'])
							<h4>Repo date: {{$data['hi_repo_date']}}</h4>
						@endif
						@if($data['hi_loan_paid_off'])
							<h4>Loan paid off: {{$data['hi_loan_paid_off']}}</h4>
						@endif
						@if($data['li_zone'])
							<h4>Zone: {{$data['li_zone']}}</h4>
						@endif
						@if($data['li_state'])
							<h4>state: {{$data['li_state']}}</h4>
						@endif
						@if($data['li_city'])
							<h4> city: {{$data['li_city']}}</h4>
						@endif
						@if($data['li_yard_name'])
							<h4> Yard name: {{$data['li_yard_name']}}</h4>
						@endif
						@if($data['li_yard_location'])
							<h4> Yard_location: {{$data['li_yard_location']}}</h4>
						@endif
						@if($data['avi_superdari_status'])
							<h4> Superdari status: {{$data['avi_superdari_status']}}</h4>
						@endif
						@if($data['avi_tax_type'])
							<h4> Text Type: {{$data['avi_tax_type']}}</h4>
						@endif
						@if($data['avi_theft_recover'])
							<h4> Theft recover: {{$data['avi_theft_recover']}}</h4>
						@endif
						@if($data['avi_keys_available'])
							<h4> Key Availability: {{$data['avi_keys_available']}}</h4>
						@endif
</div></div>	
<div class="details-buttom">

						@if($data['total_remaining_bids'])
							<h4>Bids Remaining: {{$data['total_remaining_bids']}}</h4> <br>
						@endif
<div class="bid-details">
@if(session()->has('message'))
              <div id="sendmessage" style="display:none;">{{session()->has('message')}}</div>
              @endif
						@if($data['current_bid_amount'])
						<form method="POST" action="{{url('user/bid')}}">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="vehicle_id" value="{{ $data['vehicle_id'] }}">
							<input name="bid_amount"  type="number"  value="{{$data['current_bid_amount']}}">
							<!-- <h4>Current Bid Amount: {{$data['current_bid_amount']}}</h4> -->
							<input type="submit" class="bid-details-btn" value="BID">
						</form>
						@endif
						

						</div>
</div>

					
					</div>
					</a>
				</div>
				<div class='col-sm-6 col-md-6 col-lg-6 wow fadeInLeft'>
						
				
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