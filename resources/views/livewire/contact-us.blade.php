<div>
    {{-- The best athlete wants his opponent at his best. --}}

    @livewire('head')
    <div class="modal fade lr_popup" id="Login" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                    <div class="row no-gutters">
                        <div class="col-lg-5">
                            <div class="h-100 background_bg radius_ltlb_5" data-img-src="assets/images/login_img.jpg"></div>
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
                                        <form method="post" class="login form_style2">
                                            <div class="form-group">
                                                <input type="text" required="" class="form-control" name="email" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" required="" type="password" name="password" placeholder="Password">
                                            </div>
                                            <div class="login_footer form-group">
                                                <a href="#">Lost your password?</a>
                                                <div class="chek-form mb-3">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="">
                                                        <label class="form-check-label" for="exampleCheckbox3">Remember me</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-default btn-block rounded-0" name="login">Log in</button>
                                            </div>
                                        </form>
                                        <div class="different_login">
                                            <span> or</span>
                                        </div>
                                        <ul class="btn-login list_none text-center">
                                            <li><a href="#" class="btn btn-facebook rounded-0"><i class="ion-social-facebook"></i>Facebook</a></li>
                                            <li><a href="#" class="btn btn-google rounded-0"><i class="ion-social-googleplus"></i>Google</a></li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="signup" role="tabpanel">
                                        <div class="heading_s1 mb-3">
                                            <h4>Sign Up</h4>
                                        </div>
                                        <form method="post" class="login form_style2">
                                            <div class="form-group">
                                                <input type="text" required="" class="form-control" name="username" placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" required="" class="form-control" name="email" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" required="" type="password" name="password" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" required="" type="password" name="cpassword" placeholder="Confirm Password">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-default btn-block rounded-0" name="login">Sign Up</button>
                                            </div>
                                        </form>
                                        <div class="different_login">
                                            <span> or</span>
                                        </div>
                                        <ul class="btn-login list_none text-center">
                                            <li><a href="#" class="btn btn-facebook rounded-0"><i class="ion-social-facebook"></i>Facebook</a></li>
                                            <li><a href="#" class="btn btn-google rounded-0"><i class="ion-social-googleplus"></i>Google</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    @livewire('public-menu')
<!-- START SECTION BREADCRUMB -->
<section class="page-title-light breadcrumb_section parallax_bg overlay_bg_50" data-parallax-bg-image="assets/images/about_bg.jpg">
	<div class="container">
    	<div class="row align-items-center">
        	<div class="col-sm-6">
            	<div class="page-title">
            		<h1>Contact</h1>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact</li>
                  </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION BANNER -->

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
                                    <form method="post" name="enq">
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
                                                <button type="submit" title="Submit Your Message!" class="btn btn-default" id="submitButton" name="submit" value="Submit">Submit</button>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <div id="alert-msg" class="alert-msg text-center"></div>
                                            </div>
                                        </div>
                                    </form>		
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 animation" data-animation="fadeInRight" data-animation-delay="0.4s">
                            <div class="contact_map map_radius_rtrb overflow-hidden h-100">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193229.77301255226!2d-74.05531241936525!3d40.823236500441624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2f613438663b5%3A0xce20073c8862af08!2sW+123rd+St%2C+New+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1533565007513" allowfullscreen=""></iframe>
                            </div>
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
                <div class="overlay_bg_danger_90 icon_box text-center text_white radius_all_10 background_bg animation" data-img-src="assets/images/address_img.jpg" data-animation="fadeInUp" data-animation-delay="0.02s">
                	<div class="box_icon mb-3">
                		<img src="assets/images/map_icon.png" alt="map_icon">
                    </div>
                    <div class="intro_desc">
                        <h5>Address</h5>
                        <p>Califonia Street san Francisco, CA</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="overlay_bg_light_green_90 icon_box text-center text_white radius_all_10 background_bg animation" data-img-src="assets/images/call_img.jpg" data-animation="fadeInUp" data-animation-delay="0.03s">
                	<div class="box_icon mb-3">
                		<img src="assets/images/phone_icon.png" alt="phone_icon">
                    </div>
                    <div class="intro_desc">
                        <h5>Call Us</h5>
                        <p>+ 457 789 789 65</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            	<div class="overlay_bg_default_90 icon_box text-center text_white radius_all_10 background_bg animation" data-img-src="assets/images/email_img.jpg" data-animation="fadeInUp" data-animation-delay="0.04s">
                	<div class="box_icon mb-3">
                        <img src="assets/images/email_icon.png" alt="email_icon">
                    </div>
                    <div class="intro_desc">
                        <h5>Email</h5>
                        <p>info@sitename.com</p>
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

@livewire('foot')
</div>
