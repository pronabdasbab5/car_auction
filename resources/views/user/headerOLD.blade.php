<!--HEADER-->
<header id='header'>
		<div id='menu-bar' class='animated fadeIn'>
			<div class='container'>
				<div class='logo'>
					<img src="{{ asset('img/logo1.png') }}" alt="" style="height: 110px;">
				</div>
				<nav  id="nav" class='nav'>
					<ul class='nav-inner'>
						<li class='current'><a href="#header">Home</a></li>
						<li><a href="#about">Why Us</a></li>
						<li><a href="#features">Features</a></li>
						<li><a href="#screenshots">Screens</a></li>
						<li><a href="#reviews">About Us</a></li>
						<li><a href="#download">Download</a></li>
						<li><a href="#contact">Contact</a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div class="container">
			<div class='row'>					
				<div class='col-sm-10 col-sm-offset-1 col-md-7 col-md-offset-0 col-md-push-5 col-lg-6 col-lg-push-6 animated fadeInRight'>
					<h1>Bid Online To Grow With GaadiTrade</h1>
					<div id='header-btn'>
						<a class='btn btn-secondary scrollTo-about'><span class='icon ion-android-information' style="font-size: 22px!important;"></span> Learn More</a>
						<a class='btn btn-primary scrollTo-download'><span class='icon ion-social-android' style="font-size: 26px!important;"></span> Download Now</a>
					</div>
				</div>
				<div class='col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-5 col-md-offset-0 col-md-pull-7 col-lg-5 col-lg-pull-6 col-lg-offset-1'>
					<img src="{{ asset('img/OnePlus-One.png') }}" id='header-img' class='img-responsive animated fadeInUp' alt>
				</div>
			</div>
		</div>
		<svg id='svg-header'>
			<defs>
				<linearGradient id="grad" x1="0%" y1="100%" x2="100%" y2="30%">
					<stop offset="8%" style="stop-color:rgb(245,76,84);stop-opacity:0.1" />
					<stop offset="50%" style="stop-color:rgb(245,76,84);stop-opacity:1" />
				</linearGradient>
			</defs>
			<rect id='svg-rect' width="3000" height="1050" fill="url(#grad)"/>
		</svg>
		<div id='menu-bar-fixed'>
			<div class='container'>
				<a class='logo scrollTo-header'><img src="{{ asset('img/logo1.png') }}" alt></a>
				<nav  id="nav-fixed" class='nav'>
					<a id="show-nav" title="Show navigation"><div></div></a>
    				<a id="hide-nav" title="Hide navigation"><div></div></a>
					<ul id='nav-ul' class='nav-inner'>
						<li><a href="#header">Home</a></li>
						<li class='current'><a href="#about">Why Us</a></li>
						<li><a href="#features">Features</a></li>
						<li><a href="#screenshots">Screens</a></li>
						<li><a href="#reviews">About Us</a></li>
						<li><a href="#download">Download</a></li>
						<li><a href="#contact">Contact</a></li>
						<li id='off-nav'></li>
					</ul>
				</nav>
			</div>
		</div>
	</header>