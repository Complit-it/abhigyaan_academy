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
<script src="https://www.google.com/recaptcha/api.js"></script>


<!-- START SECTION CONTACT -->
<section class="small_pb">
	<div class="container">	
    	<div class="row justify-content-center">
        	<div class="col-xl-6 col-lg-8">
            	<div class="text-center animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                    <div class="heading_s1 text-center">
                        <h2>Get In Touch</h2>
                    </div>
                    <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text</p>
                    <div class="small_divider"></div>
                </div>
            </div>
        </div>
        <div class="row">
        	<div class="col-12">
            	<div class="box_shadow1 radius_all_10">
                	<div class="row no-gutters">
                    	<div class="col-md-6 animation" data-animation="fadeInLeft" data-animation-delay="0.02s">
                        	<div class="padding_eight_all">
                                <div class="field_form">
                                    <form method="post" id="demo-form" action="/contact-form">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <input required="required" placeholder="Enter Name" id="first-name" class="form-control" name="name" type="text">
                                             </div>
                                            <div class="form-group col-12">
                                                <input required="required" placeholder="Enter Email" id="email" class="form-control" name="email" type="email">
                                            </div>
                                            <div class="form-group col-12">
                                                <input required="required" placeholder="Enter Phone No." id="phone" class="form-control" name="phone" type="tel">
                                            </div>
                                            <div class="form-group col-12">
                                                <input placeholder="Enter Subject" id="subject" class="form-control" name="subject" type="text">
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <textarea required="required" placeholder="Message" id="description" class="form-control" name="message" rows="3"></textarea>
                                            </div>
                                            <div class="col-lg-12">
                                                {{-- <button type="submit" title="Submit Your Message!" class="btn btn-default" id="sfs" name="submit" value="Submit">Submit</button> --}}
                                                <button class="g-recaptcha btn btn-default" 
                                                data-sitekey="6Lem4-0pAAAAAEnrckYmnoKquKas8VklIfEwLSPE" 
                                                data-callback='onSubmit' 
                                                data-action='submit'>Submit</button>  
                                            </div>
                                            {{-- <div class="col-lg-12 text-center">
                                                <div id="alert-msg" class="alert-msg text-center"></div>
                                            </div> --}}
                                        </div>
                                    </form>		
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 animation" data-animation="fadeInRight" data-animation-delay="0.4s">
                            <div class="contact_map map_radius_rtrb overflow-hidden h-100">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1014.6972372753356!2d91.75820133445679!3d26.18501662016454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375a594891aaa181%3A0xd639577f03e9c0d8!2sNDA%20CDS%20CAPF%20(AC)%20%26%20CUET%20(UG)%20%2F%20(PG)%20Coaching%20Institute%20(Abhigyan%20Academy)!5e0!3m2!1sen!2sin!4v1715716303144!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION CONTACT -->

<!-- START SECTION CONTACT -->
<section class="small_pt">
	<div class="container">	
    	<div class="row justify-content-center">
        	<div class="col-xl-6 col-lg-8">
            	<div class="text-center animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                    <div class="heading_s1 text-center">
                        <h2>Contact Information</h2>
                    </div>
                    <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="overlay_bg_danger_90 icon_box text-center text_white radius_all_10 background_bg animation"  data-animation="fadeInUp" data-animation-delay="0.02s">
                	<div class="box_icon mb-3">
                		<img src="assets/images/map_icon.png" alt="map_icon">
                    </div>
                    <div class="intro_desc">
                        <h5>Address</h5>
                        <p>2nd Floor, Kalpana Market, Guwahati Club, Guwahati - 781003</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="overlay_bg_light_green_90 icon_box text-center text_white radius_all_10 background_bg animation"  data-animation="fadeInUp" data-animation-delay="0.03s">
                	<div class="box_icon mb-3">
                		<img src="assets/images/phone_icon.png" alt="phone_icon">
                    </div>
                    <div class="intro_desc">
                        <h5>Call Us</h5>
                        <p>+919540504779 <br/> +918240324106</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="overlay_bg_default_90 icon_box text-center text_white radius_all_10 background_bg animation"  data-animation="fadeInUp" data-animation-delay="0.04s">
                	<div class="box_icon mb-3">
                        <img src="assets/images/email_icon.png" alt="email_icon">
                    </div>
                    <div class="intro_desc">
                        <h5>Email</h5>
                       
                        <p> &nbsp;<br/>abhigyanacademy@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION CONTACT -->

<!-- END SECTION CALL TO ACTION -->
<section class="bg_default small_pt small_pb">
	<div class="container">
    	<div class="row align-items-center">
        	<div class="col-md-8">
            	<div class="text_white cta_section">
                	<div class="medium_divider d-block d-md-none"></div>
                    <div class="heading_s1 heading_light">
                        <h2>Get The Coaching Training Today!</h2>
                    </div>
                    <p>If you are going to use a passage of embarrassing hidden in the middle of text</p>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="text-md-right">
                    <a href="#" class="btn btn-outline-white">Get Started</a>
                </div>
                <div class="medium_divider d-block d-md-none"></div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION CALL TO ACTION -->
<script>
    function onSubmit(token) {
      document.getElementById("demo-form").submit();
    }
  </script>
 
@endsection