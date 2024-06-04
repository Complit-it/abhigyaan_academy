@extends('layouts.publicLayouts.app')

@section('content')
   
{{-- //if session contains message than a flash message  --}}
@if(session('message'))
    <div id="flash-message" style="position: fixed; top:10%; right:0; z-index: 9999" class="p-3" >
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    <script>
        // Automatically close the flash message after 5 seconds
        setTimeout(function() {
            $('#flash-message').fadeOut('slow');
        }, 5000);
    </script>
@endif


<!-- START SECTION ABOUT -->
<section class="overflow-hidden res_md_p_0">
	<div class="container-fluid p-0">
    	<div class="row no-gutters align-items-center">
        	<div class="col-md-6">
            	<div class="box_shadow1 bg-white overlap_section padding_eight_all">
                	<div class="animation" data-animation="fadeInLeft" data-animation-delay="0.02s">
                        <div class="heading_s1"> 
                          <h2>About Us</h2>
                        </div>
                        <p>
                            Founded in 1993, Abhigyan Academy boasts a 29-year track record of assisting over 5500+ aspirants and students in successfully cracking various exams, including UPSC NDA, CDS, CAPF(AC), AFCAT exams, and providing guidance for SSB Interviews. We aid aspirants in choosing the right career path by offering counseling based on their aptitude, abilities, and capabilities. Our dedicated faculty members are always available to help students clear their doubts and achieve outstanding results.
                        </p>
                        {{-- <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p> --}}
                        {{-- <ul class="list_none list_item">
                        	<li>
                            	<div class="counter_content">
                                    <h3 class="h1 text_danger"><span class="counter">260</span></h3>
                                    <h6>Free Courses</h6>
                                </div>
                            </li>
                            <li>
                            	<div class="counter_content">
                                    <h3 class="h1 text_light_green"><span class="counter">152</span></h3>
                                    <h6>Paid Courses</h6>
                                </div>
                            </li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        	<div class="col-md-6">
            	<div class="animation" data-animation="fadeInRight" data-animation-delay="0.03s">
                	<div class="overlay_bg_30 about_img z_index_minus1">	
                    	<img class="w-100" src="/assets/images/all_new/video_bg.jpg" alt="about_img"/>
                    </div>
                	<a href="https://www.youtube.com/watch?v=mhvyeWwJpsE" class="video_popup video_play">
                    	<span class="ripple"><i class="ion-play ml-1"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION ABOUT -->

<!-- START SECTION TEACHER -->
<section class="parallax_bg overlay_bg_blue_90" data-parallax-bg-image="https://cdn.elearningindustry.com/wp-content/uploads/2019/10/professional-development-tools-for-teachers.jpg">
	<div class="container">	
    	<div class="row justify-content-center">
        	<div class="col-xl-6 col-lg-8">
            	<div class="text-center text_white animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                    <div class="heading_s1 heading_light text-center">
                        <h2>Our Teachers</h2>
                    </div>
                    <p>Our dedicated team of experienced educators is committed to guiding and supporting you through your learning journey. With their expertise and passion for teaching, they strive to ensure that every student reaches their full potential.</p>
                </div>
            </div>
        </div>
        {{-- <div class="row">
        	<div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1 box_shadow1 animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                	<div class="team_img">
                    	<img src="assets/images/team_img1.jpg" alt="team1">
                        <ul class="list_none social_icons social_white">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                    <div class="team_title radius_lbrb_10 text-center">
                        <h5><a href="#">Aden Smith</a></h5>
                        <span>Head Of Department</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1 box_shadow1 animation" data-animation="fadeInUp" data-animation-delay="0.03s">
                	<div class="team_img">
                    	<img src="assets/images/team_img2.jpg" alt="team2">
                        <ul class="list_none social_icons social_white">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                    <div class="team_title radius_lbrb_10 text-center">
                        <h5><a href="#">Kally Brooks</a></h5>
                        <span>Professor</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1 box_shadow1 animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                	<div class="team_img">
                    	<img src="assets/images/team_img3.jpg" alt="team3">
                        <ul class="list_none social_icons social_white">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                    <div class="team_title radius_lbrb_10 text-center">
                        <h5><a href="#">David clark</a></h5>
                        <span>Chemistry Teacher</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
            	<div class="team_box team_style1 box_shadow1 animation" data-animation="fadeInUp" data-animation-delay="0.05s">
                	{{-- <div class="team_img">
                    	<img src="assets/images/team_img4.jpg" alt="team4">
                        <ul class="list_none social_icons social_white">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div> 
                    <div class="team_title radius_lbrb_10 text-center">
                        <h5><a href="#">Rebeka Alig</a></h5>
                        <span>English Teacher</span>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</section>
<!-- END SECTION TEACHER -->
{{-- 
<!-- START SECTION COUNTER -->
<section class="bg_gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-6 ">
                <div class="box_counter counter_style1 text-center animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                	<div class="counter_icon">
                    	<img src="assets/images/counter_icon_dark1.png" alt="counter_icon1" />
                    </div>
                    <div class="counter_content">
                        <h3 class="counter_text"><span class="counter">1800</span>+</h3>
                        <p>Students</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6 ">
                <div class="box_counter counter_style1 text-center animation" data-animation="fadeInUp" data-animation-delay="0.03s">
                    <div class="counter_icon">
                    	<img src="assets/images/counter_icon_dark2.png" alt="counter_icon2" />
                    </div>
                    <div class="counter_content">
                        <h3 class="counter_text"><span class="counter">70</span></h3>
                        <p>Courses</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6 ">
                <div class="box_counter counter_style1 text-center animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                    <div class="counter_icon">
                    	<img src="assets/images/counter_icon_dark3.png" alt="counter_icon3" />
                    </div>
                    <div class="counter_content">
                        <h3 class="counter_text"><span class="counter">700</span>+</h3>
                        <p>Certified teachers</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6 ">
                <div class="box_counter counter_style1 text-center animation" data-animation="fadeInUp" data-animation-delay="0.05s">
                	<div class="counter_icon">
                    	<img src="assets/images/counter_icon_dark4.png" alt="counter_icon4" />
                    </div>
                    <div class="counter_content">
                        <h3 class="counter_text"><span class="counter">1200</span>+</h3>
                        <p>Award Winning</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION COUNTER --> --}}
 
@endsection