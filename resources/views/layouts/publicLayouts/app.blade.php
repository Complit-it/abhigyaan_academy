<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="{{ $title }} " name="author">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{$title}}">
<meta name="keywords" content="indian army, cds, navy, afcat, academy, course, education, elearning, learning, education html , university , college , school , online education , tution center ">

<!-- SITE TITLE -->
<title>{{$title}}</title>
<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="/assets/images/favicon.png">
<!-- Animation CSS -->
<link rel="stylesheet" href="/assets/css/animate.css">	
<!-- Latest Bootstrap min CSS -->
<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
<!-- Icon Font CSS -->
<link rel="stylesheet" href="/assets/css/ionicons.min.css">
<link rel="stylesheet" href="/assets/css/themify-icons.css">
<!-- FontAwesome CSS -->
<link rel="stylesheet" href="/assets/css/all.min.css">
<!--- owl carousel CSS-->
<link rel="stylesheet" href="/assets/owlcarousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.css">
<link rel="stylesheet" href="/assets/owlcarousel/css/owl.theme.default.min.css">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="/assets/css/magnific-popup.css">
<!-- Style CSS -->
<link rel="stylesheet" href="/assets/css/style.css">
<link rel="stylesheet" href="/assets/css/responsive.css">
<link rel="stylesheet" id="layoutstyle" href="/assets/color/theme.css">

<style>
    
 .bg_army {
    background-color:  #2b411c;
}   
 .bg_army2 {
    background-color:  #4c5d34;
 }
 #shadow-host-companion{
    display: none;
 }

</style>
<!-- Meta Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1066633217711956');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1066633217711956&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
</head>

<body>

<!-- LOADER -->
<div id="preloader">
    <span class="spinner"></span>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- END LOADER --> 
<div class="modal fade lr_popup" id="Login" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    	<div class="modal-content border-0">
    		<div class="modal-body">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <div class="row no-gutters">
                	<div class="col-lg-5">
                    	<div class="h-100 background_bg radius_ltlb_5" data-img-src="/assets/images/all_new/login-image.jpg"></div>
                    </div>
                	<div class="col-lg-7">	
                    	<div class="padding_eight_all">
                    		<ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="login-tab1" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="signup-tab1" data-toggle="tab" href="#signup" role="tab" aria-controls="signup" aria-selected="false">Sign Up</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="login" role="tabpanel">
                                    <div class="heading_s1 mb-3">
                                        <h4>Login</h4>
                                    </div>
                                    <form method="post" action="/student-login" class="login form_style2">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="password" name="password" placeholder="Password">
                                        </div>
                                        {{-- <div class="login_footer form-group">
                                            <a href="#">Lost your password?</a>
                                            <div class="chek-form mb-3">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                                    <label class="form-check-label" for="exampleCheckbox3">Remember me</label>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-default btn-block rounded-0" name="login">Log in</button>
                                        </div>
                                    </form>
                                    <div class="different_login">
                                        <span> or</span>
                                    </div>
                                    <ul class="btn-login list_none text-center">
                                        <li><a href="https://app.abhigyanacademy.com/" class="btn btn-facebook rounded-0">Login to our WEBAPP</a></li>
                                        {{-- <li><a href="#" class="btn btn-google rounded-0"><i class="ion-social-googleplus"></i>Google</a></li> --}}
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="signup" role="tabpanel">
                                    <div class="heading_s1 mb-3">
                                        <h4>Sign Up</h4>
                                    </div>
                                    <form method="post" action="/sign-up" class="login form_style2">

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @csrf
                                    	<div class="form-group">
                                            <input type="text" required class="form-control" name="name" placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" required class="form-control" name="phone" placeholder="Phone">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" required class="form-control" name="fathersname" placeholder="Father's Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" required class="form-control" name="fathersphone" placeholder="Fathers's Phone">
                                        </div>

                                        <div class="form-group">
                                            <input type="email" required class="form-control" name="email" placeholder="Email">
                                        </div>
                                                                                <div class="form-group">
                                            <input class="form-control" required type="password" name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" required type="password" name="cpassword" placeholder="Confirm Password">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-default btn-block rounded-0" name="login">Sign Up</button>
                                        </div>
                                    </form>
                                    {{-- <div class="different_login">
                                        <span> or</span>
                                    </div>
                                    <ul class="btn-login list_none text-center">
                                        <li><a href="#" class="btn btn-facebook rounded-0"><i class="ion-social-facebook"></i>Facebook</a></li>
                                        <li><a href="#" class="btn btn-google rounded-0"><i class="ion-social-googleplus"></i>Google</a></li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                	</div>
                </div>
        	</div>
        </div>
    </div>
</div>

<!-- START HEADER -->
<header class="header_wrap bg_army light_skin">
    {{-- <header class="header_wrap bg_blue_dark light_skin"> --}}
        <div class="top-header light_skin">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <ul class="contact_detail list_none text-center text-md-left">
                        <li><a href="#"><i class="ti-mobile"></i><a hreff="tel:+919540504779">+919540504779</a> | <a hreff="tel:+918240324106">+918240324106</a></li>
                        <li><a href="#"><i class="ti-email"></i>abhigyanacademy1993@gmail.com</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                	<div class="d-flex flex-wrap align-items-center justify-content-md-end justify-content-center mt-2 mt-md-0">
                    	<ul class="list_none social_icons social_white text-center text-md-right">
                            <li><a href="https://www.facebook.com/Abhigyanacademy1/"><i class="ion-social-facebook"></i></a></li>
                            {{-- <li><a href="#"><i class="ion-social-twitter"></i></a></li> --}}
                            {{-- <li><a href="#"><i class="ion-social-googleplus"></i></a></li> --}}
                            <li><a href="https://www.youtube.com/@Abhigyan_Academy/videos"><i class="ion-social-youtube-outline"></i></a></li>
                            <li><a href="https://www.instagram.com/academyabhigyan/?hl=en"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                        <ul class="list_none header_list border_list ml-1">
                            {{-- <li><a href="https://app.abhigyaanacademy.com" data-toggle="modal" data-target="#Login">Login</a></li> --}}

                            @if(Auth::check())
                            <li><a href="/logout    "  class="btn btn-default btn-sm rounded-0">{{Auth::user()->name }},  Logout ?</a></li>

                            @else
                            <li><a href="https://app.abhigyaanacademy.com"  data-toggle="modal" data-target="#Login" class="btn btn-default btn-sm rounded-0">Login</a></li>

                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <nav class="navbar navbar-expand-lg"> 
            <a class="navbar-brand" href="/">
                <img class="logo_light" src="/assets/images/abhigyan_academy_logo_small.webp" alt="logo" />
                <img class="logo_dark" src="/assets/images/abhigyan_academy_logo_small.webp" alt="logo" />
                <img class="logo_default" src="/assets/images/abhigyan_academy_logo_small.webp" alt="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="ion-android-menu"></span> </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="dropdown">
                        <a class="nav-link @if (request()->is('home') || request()->is('/')) active @endif" href="/" >Home</a>
                       
                    </li>
                    {{-- <li class="dropdown">
                        <a class="dropdown-toggle nav-link" href="#" >Pages</a>
                        <div class="dropdown-menu">
                            <ul> 
                                <li><a class="dropdown-item nav-link nav_item" href="about.html">About Us</a></li> 
                                <li class="dropdown">
                                    <a class="dropdown-item menu-link dropdown-toggler" href="#">Gallery</a>
                                    <div class="dropdown-menu">
                                        <ul> 
                                            <li><a class="dropdown-item nav-link nav_item" href="gallery-three-columns.html">Gallery 3 Column Grid</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="gallery-four-columns.html">Gallery 4 Column Grid</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="gallery-masonry-three-columns.html">Gallery 3 Column Masonry</a></li> 
                                            <li><a class="dropdown-item nav-link nav_item" href="gallery-masonry-four-columns.html">Gallery 4 Column Masonry</a></li> 
                                        </ul>
                                    </div>
                                </li>
                                <li><a class="dropdown-item nav-link nav_item" href="faq.html">Faq</a></li>
                                <li><a class="dropdown-item nav-link nav_item" href="404.html">404 Page</a></li>
                            </ul>
                        </div>
                    </li> --}}
                    <li class="dropdown">
                        <a class="nav-link  @if (request()->is('courses')) active @endif" href="/courses" >Course</a>
                        {{-- <div class="dropdown-menu">
                            <ul> 
                                <li><a class="dropdown-item nav-link nav_item" href="courses.html">Courses</a></li> 
                                <li><a class="dropdown-item nav-link nav_item" href="course-detail.html">Course Detail</a></li>
                            </ul>
                        </div> --}}
                    </li>
                    {{-- <li class="dropdown">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Event</a>
                        <div class="dropdown-menu">
                            <ul> 
                                <li><a class="dropdown-item nav-link nav_item" href="event.html">Event</a></li> 
                                <li><a class="dropdown-item nav-link nav_item" href="event-detail.html">Event Detail</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Teacher</a>
                        <div class="dropdown-menu">
                            <ul> 
                                <li><a class="dropdown-item nav-link nav_item" href="teacher.html">Teacher</a></li> 
                                <li><a class="dropdown-item nav-link nav_item" href="teacher-detail.html">Teacher Detail</a></li>
                            </ul>
                        </div>
                    </li> --}}
                    <li class="dropdown">
                        <a class="nav-link @if (request()->is('blogs')) active @endif" href="/blogs">Blogs</a>
                    </li>
                    <li>
                        <a class="nav-link @if (request()->is('contact')) active @endif" href="/contact">Contact</a>
                    </li>
                </ul>
            </div>
            {{-- <ul class="navbar-nav attr-nav align-items-center">
                <li><a href="javascript:void(0);" class="nav-link search_trigger"><i class="ion-ios-search-strong"></i></a>
                    <div class="search-overlay">
                        <div class="search_wrap">
                            <form>
                                <input type="text" placeholder="Search" class="form-control" id="search_input">
                                <button type="submit" class="search_icon"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul> --}}
        </nav>
    </div>
</header>
<!-- END HEADER --> 
@yield('content')

<!-- START FOOTER -->
<footer class="bg_army footer_dark">
	<div class="top_footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-8 mb-4 mb-lg-0">
                	<div class="footer_logo">
                    	<a href="/"><img alt="logo" src="/assets/images/abhigyan_academy_logo_small.webp"></a>
                    </div>
                    <p>Our mission is to empower and guide aspiring individuals who dream of serving their country in the esteemed Indian Army, Navy, and Defense forces.</p>
                    <ul class="contact_info contact_info_light list_none">
                        <li>
                            <i class="fa fa-map-marker-alt "></i>
                            <address>2nd Floor, Kalpana Market, Guwahati Club, Guwahati - 781003</address>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:abhigyanacademy@gmail.com">abhigyanacademy@gmail.com</a>
                        </li>
                        <li>
                            <i class="fa fa-mobile-alt"></i>
                            <p>+919540504779 | +918240324106</p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-sm-4 mb-4 mb-lg-0">
                	<h6 class="widget_title">Useful Links</h6>
                    <ul class="list_none widget_links links_style2">
                    	<li><a href="">Join Us</a></li>
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                	<h6 class="widget_title">Recent Posts</h6>
                    <ul class="recent_post border_bottom_dash list_none">
                        @foreach($top3blogs as $blog)
                    	<li>
                        	<div class="post_footer">
                            	<div class="post_img">
                                	<a href="#"><img src="/upload/blogs/{{$blog->featured_image}}" alt="letest_post1"></a>
                                </div>
                                <div class="post_content">
                                	<h6><a href="#">{{$blog->title}}</a></h6>
                                    <span class="post_date">{{ \Carbon\Carbon::parse($blog->published_on)->format('j F, Y') }}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h6 class="widget_title">Subscribe Newsletter</h6>
                    <p>Stay Updated with our newsletters.</p>
                    <div class="newsletter_form form_style2 mb-4">
                        <form action="/newsletters" method="post"> 
                            @csrf
                            <input type="text" class="form-control" required=""  name="email" placeholder="Email Address">
                            <button type="submit" title="Subscribe" class="btn btn-default btn-sm rounded-0" name="submit" value="Submit">Subscribe</button>
                        </form>
                    </div>
                    <h6 class="widget_title">Follow Us</h6>
                    <ul class="list_none social_icons social_white social_style1">
                    	<li><a href="https://www.facebook.com/Abhigyanacademy1/"><i class="ion-social-facebook"></i></a></li>
                        {{-- <li><a href="#"><i class="ion-social-twitter"></i></a></li> --}}
                        <li><a href="https://www.youtube.com/@Abhigyan_Academy/videos"><i class="ion-social-youtube-outline"></i></a></li>
                        <li><a href="https://www.instagram.com/academyabhigyan/?hl=en"><i class="ion-social-instagram-outline"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer bg_army2">
    	<div class="container">
        	<div class="row align-items-center">
            	<div class="col-md-6">
                	<p class="copyright m-md-0 text-center text-md-left">© 2018 All Rights Reserved by Abhigyan Academy. Powered by <a style="color:orange" href="https://complit.in">COMPLIT</a></p>
                </div>
                <div class="col-md-6">
                	<ul class="list_none footer_link text-center text-md-right">
                    	<li><a href="/privacy">Privacy Policy</a></li>
                        <li><a href="/terms-and-conditions">Terms &amp; Conditions</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 

<!-- Latest jQuery --> 
<script src="/assets/js/jquery-1.12.4.min.js"></script> 
<!-- jquery-ui --> 
<script src="/assets/js/jquery-ui.js"></script>
<!-- popper min js --> 
<script src="/assets/js/popper.min.js"></script>
<!-- Latest compiled and minified Bootstrap --> 
<script src="/assets/bootstrap/js/bootstrap.min.js"></script> 
<!-- owl-carousel min js  --> 
<script src="/assets/owlcarousel/js/owl.carousel.min.js"></script> 
<!-- magnific-popup min js  --> 
<script src="/assets/js/magnific-popup.min.js"></script> 
<!-- waypoints min js  --> 
<script src="/assets/js/waypoints.min.js"></script> 
<!-- parallax js  --> 
<script src="/assets/js/parallax.js"></script> 
<!-- countdown js  --> 
<script src="/assets/js/jquery.countdown.min.js"></script> 
<!-- jquery.counterup.min js --> 
<script src="/assets/js/jquery.counterup.min.js"></script>
<!-- imagesloaded js --> 
<script src="/assets/js/imagesloaded.pkgd.min.js"></script>
<!-- isotope min js --> 
<script src="/assets/js/isotope.min.js"></script>
<!-- jquery.parallax-scroll js -->
<script src="/assets/js/jquery.parallax-scroll.js"></script>
<!-- scripts js --> 
<script src="/assets/js/scripts.js"></script>

</body>
</html>