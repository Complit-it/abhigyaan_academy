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



<!-- START SECTION COURSE DETAIL -->
<section>
	<div class="container">
        <div class="row">
        	<div class="col-lg-9">
            	<div class="single_course">
                    <div class="course_img">
                        <a href="#">
                            <img src="/{{ $package[0]['package_image']}}" alt="{{$package[0]['package_name']}}">
                        </a>
                        <div class="price">
                        	<span class="alert alert-success"><strong>Price :</strong> Rs.{{$package[0]['package_price']}}</span>
                        </div>
                        <div class="enroll_btn">
                        	{{-- <a href="#" class="btn btn-default btn-sm">Get Enroll</a> --}}
                        </div>
                    </div>
                    <div class="course_detail alert-warning">
                        <div class="course_title">
                            <h2>{{$package[0]['package_name']}}</h2>
                        </div>
                        <div class="countent_detail_meta">
                            <ul>
                                {{-- <li>
                                    <div class="instructor">
                                        <img src="assets/images/user1.jpg" alt="user1">
                                        <div class="instructor_info">
                                            <label>Teacher:</label>
                                            <a href="#">Alia Noor</a>
                                        </div>
                                    </div>
                                </li> --}}
                                {{-- <li>
                                    <div class="course_cat">
                                        <label>Categories: </label>
                                        <a href="#">Development</a><a href="#">Business</a>
                                    </div>
                                </li> --}}
                                <li>
                                    <div class="course_student">
                                        <label>Students Enrolled: </label>
                                        <span> 352</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="course_categories">
                                        <label>Review: </label>
                                        <div class="rating_stars">
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star-half"></i> 
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="course_tabs">
                    	<ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab1" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="curriculum-tab1" data-toggle="tab" href="#pdf" role="tab" aria-controls="curriculum" aria-selected="false">PDF</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="instructor-tab1" data-toggle="tab" href="#video" role="tab" aria-controls="instructor" aria-selected="false">Videos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="reviews-tab1" data-toggle="tab" href="#mcq" role="tab" aria-controls="reviews" aria-selected="false">MCQs</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab1">
                               <div class="border radius_all_5 tab_box"> <p>{!! $package[0]['package_description'] !!}</p></div>
                            </div>
                            <div class="tab-pane fade" id="pdf" role="tabpanel" aria-labelledby="curriculum-tab1">
                                <div id="accordion" class="accordion">
                                    @foreach($pdf as $pdf)
                                    <div class="card">
                                      <div class="card-header" id="heading-1-One">
                                        <h6 class="mb-0"> <a target="_blank" href="/{{$pdf->file_url}}">{{$pdf->subject_name}} - {{$pdf->title}} <span class="item_meta duration">@if($pdf->file_url == null) Demo @else Click to Open @endif</span></a></h6>
                                      </div>
                                      {{-- <div id="collapse-1-One" class="collapse show" aria-labelledby="heading-1-One" data-parent="#accordion">
                                        <div class="card-body">
                                        	<p>Lorem Ipsu. is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                        </div>
                                      </div> --}}
                                    </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="instructor-tab1">
                                <div id="accordion" class="accordion">
                                    @foreach($video as $video)
                                    <div class="card">
                                      <div class="card-header" id="heading-1-One">
                                        <h6 class="mb-0"> <a href="javascript:void(0);" onclick="openPopup({{$video->file_url}})">{{$video->subject_name}} - {{$video->title}} <span class="item_meta duration">@if($video->file_url == null) Demo @else Click to Open @endif</span></a></h6>
                                      </div>
                                      {{-- <div id="collapse-1-One" class="collapse show" aria-labelledby="heading-1-One" data-parent="#accordion">
                                        <div class="card-body">
                                        	<p>Lorem Ipsu. is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                        </div>
                                      </div> --}}
                                    </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="tab-pane fade" id="mcq" role="tabpanel" aria-labelledby="instructor-tab1">
                                <div id="accordion" class="accordion">
                                    {{-- @foreach($video as $video) --}}
                                    <div class="card">
                                      <div class="card-header" id="heading-1-One">
                                        <h6 class="mb-0"> <a href="https://app.abhigyanacademy.com/" > Login to our webapp to Pratice MCQ (Click to navigate)</a></h6>
                                      </div>
                                      {{-- <div id="collapse-1-One" class="collapse show" aria-labelledby="heading-1-One" data-parent="#accordion">
                                        <div class="card-body">
                                        	<p>Lorem Ipsu. is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                        </div>
                                      </div> --}}
                                    </div>
                                    {{-- @endforeach --}}

                                </div>
                            </div>

                            {{--
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab1">
                            	<div class="border radius_all_5 tab_box">
                                	<div class="course_rating">
                                    	<div class="rating_review">
                                            <p><span class="review_number">4.50</span> average based on 2 ratings</p>
                                            <div class="rating_stars">
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star"></i>
                                                <i class="ion-android-star-half"></i> 
                                            </div>
                                        </div>
                                        <div class="rating_box">
                                            <div class="course_rate">
                                        		<span>5 Star</span>
                                                <div class="review_bar">
                                                    <div class="rating" style="width:90% "></div>
                                                </div>
                                                <span>90%</span>
                                            </div>
                                            <div class="course_rate">
                                                <span>4 Star</span>
                                                <div class="review_bar">
                                                    <div class="rating" style="width:70% "></div>
                                                </div>
                                                <span>70%</span>
                                            </div>
                                            <div class="course_rate">
                                                <span>3 Star</span>
                                                <div class="review_bar">
                                                    <div class="rating" style="width:40% "></div>
                                                </div>
                                                <span>40%</span>
                                            </div>
                                            <div class="course_rate">
                                                <span>2 Star</span>
                                                <div class="review_bar">
                                                    <div class="rating" style="width:20% "></div>
                                                </div>
                                                <span>20%</span>
                                            </div>
                                            <div class="course_rate">
                                                <span>1 Star</span>
                                                <div class="review_bar">
                                                    <div class="rating" style="width:10% "></div>
                                                </div>
                                                <span>10%</span>
                                            </div>
                                    	</div>
                                    </div>
                                    <div class="heading_s1">
                                    	<h5>Reviews</h5>
                                    </div>
                                    <ul class="list_none comment_list">
                                        <li class="comment_info">
                                            <div class="d-flex">
                                                <div class="user_img">
                                                    <img class="radius_all_5" src="assets/images/client_img1.jpg" alt="client_img1">
                                                </div>
                                                <div class="comment_content">
                                                    <div class="d-sm-flex align-items-center">
                                                        <div class="meta_data">
                                                            <h6><a href="#">Alia Noor</a></h6>
                                                            <div class="comment-time">March 5, 2018, 6:05 PM</div>
                                                        </div>
                                                        <div class="ml-auto mb-2">
                                                        	<div class="rating_stars">
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star-half"></i> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p>We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire that the cannot foresee the pain and trouble that.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="comment_info">
                                            <div class="d-flex">
                                                <div class="user_img">
                                                    <img class="radius_all_5" src="assets/images/client_img2.jpg" alt="client_img2">
                                                </div>
                                                <div class="comment_content">
                                                    <div class="d-sm-flex align-items-center">
                                                        <div class="meta_data">
                                                            <h6><a href="#">Dany Core</a></h6>
                                                            <div class="comment-time">april 15, 2018, 10:30 PM</div>
                                                        </div>
                                                        <div class="ml-auto mb-2">
                                                        	<div class="rating_stars">
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star-half"></i> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p>We denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire that the cannot foresee the pain and trouble that.</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <hr>
                                    <div class="review_form field_form">
                                        <h5>Add a review</h5>
                                        <form>
                                        	<div class="row">
                                                <div class="form-group col-12">
                                                    <div class="rating">
                                                        <span data-value="1"><i class="ion-android-star-outline"></i></span>
                                                        <span data-value="2"><i class="ion-android-star-outline"></i></span> 
                                                        <span data-value="3"><i class="ion-android-star-outline"></i></span>
                                                        <span data-value="4"><i class="ion-android-star-outline"></i></span>
                                                        <span data-value="5"><i class="ion-android-star-outline"></i></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-12">
                                                    <textarea required="required" placeholder="Your review *" class="form-control" name="message" rows="4"></textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input required="required" placeholder="Enter Name *" class="form-control" name="name" type="text">
                                                 </div>
                                                <div class="form-group col-md-6">
                                                    <input required="required" placeholder="Enter Email *" class="form-control" name="email" type="email">
                                                </div>
                                               
                                                <div class="form-group col-12">
                                                    <button type="submit" class="btn btn-default" name="submit" value="Submit">Submit Review</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="row">
                        <div class="col-12">
                            <div class="medium_divider"></div>
                            <div class="comment-title">
                                <h5>Related Courses</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="content_box radius_all_10 box_shadow1">
                                <div class="content_img radius_ltrt_10">
                                    <a href="#"><img src="assets/images/course_img1.jpg" alt="course_img1"></a>
                                </div>
                                <div class="content_desc">
                                    <h4 class="content_title"><a href="#">Nullam id varius nunc id varius nunc</a></h4>
                                    <p>If you are going to use a passage of Lorem Ipsum you need to be sure anything embarrassing hidden in the middle of text.</p>
                                    <div class="courses_info">
                                        <div class="rating_stars">
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star-half"></i> 
                                        </div>
                                        <ul class="list_none content_meta">
                                            <li><a href="#"><i class="ti-user"></i>31</a></li>
                                            <li><a href="#"><i class="ti-heart"></i>10</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content_footer">
                                    <div class="teacher">
                                        <a href="#"><img src="assets/images/user1.jpg" alt="user1"><span>Alia Noor</span></a>
                                    </div>
                                    <div class="price">
                                        <span class="alert alert-success">Free</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="content_box radius_all_10 box_shadow1">
                                <div class="content_img radius_ltrt_10">
                                    <a href="#"><img src="assets/images/course_img2.jpg" alt="course_img2"></a>
                                </div>
                                <div class="content_desc">
                                    <h4 class="content_title"><a href="#">Nullam id varius nunc id varius nunc</a></h4>
                                    <p>If you are going to use a passage of Lorem Ipsum you need to be sure anything embarrassing hidden in the middle of text.</p>
                                    <div class="courses_info">
                                        <div class="rating_stars">
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star"></i>
                                            <i class="ion-android-star-half"></i> 
                                        </div>
                                        <ul class="list_none content_meta">
                                            <li><a href="#"><i class="ti-user"></i>31</a></li>
                                            <li><a href="#"><i class="ti-heart"></i>10</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="content_footer">
                                    <div class="teacher">
                                        <a href="#"><img src="assets/images/user2.jpg" alt="user2"><span>Dany Core</span></a>
                                    </div>
                                    <div class="price">
                                        <span class="alert alert-info">$49</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            {{-- <div class="col-lg-3 mt-lg-0 mt-4 pt-3 pt-lg-0">
            	<div class="sidebar">
                    <div class="widget widget_search">
                        <form class="search_form"> 
                            <input required="" class="form-control" placeholder="Search..." type="text">
                            <button type="submit" title="Subscribe" name="submit" value="Submit">
                                <span class="ti-search"></span>
                            </button>
                        </form>
                    </div>
                	<div class="widget widget_recent_course">
                    	<h5 class="widget_title">Letest Course</h5>
                        <ul class="recent_post border_bottom_dash list_none">
                            <li>
                                <div class="post_footer">
                                    <div class="post_img">
                                        <a href="#"><img src="assets/images/letest_course1.jpg" alt="letest_course1"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6><a href="#">Nullam id varius nunc id varius nunc</a></h6>
                                        <span class="text-success small">Free</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="post_footer">
                                    <div class="post_img">
                                        <a href="#"><img src="assets/images/letest_course2.jpg" alt="letest_course2"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6><a href="#">Nullam id varius nunc id varius nunc</a></h6>
                                        <span class="text-info small">$49</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="post_footer">
                                    <div class="post_img">
                                        <a href="#"><img src="assets/images/letest_course3.jpg" alt="letest_course3"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6><a href="#">Nullam id varius nunc id varius nunc</a></h6>
                                        <span class="text-success small">Free</span>
                                    </div>
                                </div>
                            </li>
                    	</ul>
                    </div>
                    <div class="widget widget_categories">
                    	<h5 class="widget_title">Course Categories</h5>
                        <ul>
                            <li><a href="#"><span class="categories_name">Development</span><span class="categories_num">(9)</span></a></li>
                            <li><a href="#"><span class="categories_name">Business</span><span class="categories_num">(6)</span></a></li>
                            <li><a href="#"><span class="categories_name">Academics</span><span class="categories_num">(4)</span></a></li>
                            <li><a href="#"><span class="categories_name">Health Fitness</span><span class="categories_num">(7)</span></a></li>
                            <li><a href="#"><span class="categories_name">Photography</span><span class="categories_num">(12)</span></a></li>
                    	</ul>
                    </div>
                    <div class="widget widget_recent_post">
                    	<h5 class="widget_title">Recent Post</h5>
                        <ul class="recent_post border_bottom_dash list_none">
                            <li>
                                <div class="post_footer">
                                    <div class="post_img">
                                        <a href="#"><img src="assets/images/letest_post1.jpg" alt="letest_post1"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h6>
                                        <span class="post_date">April 14, 2018</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="post_footer">
                                    <div class="post_img">
                                        <a href="#"><img src="assets/images/letest_post2.jpg" alt="letest_post1"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h6>
                                        <span class="post_date">April 14, 2018</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="post_footer">
                                    <div class="post_img">
                                        <a href="#"><img src="assets/images/letest_post3.jpg" alt="letest_post1"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h6>
                                        <span class="post_date">April 14, 2018</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="widget widget_tags">
                    	<h5 class="widget_title">tags</h5>
                        <div class="tags">
                        	<a href="#">General</a>
                            <a href="#">Design</a>
                            <a href="#">jQuery</a>
                            <a href="#">Branding</a>
                            <a href="#">Modern</a>
                            <a href="#">Blog</a>
                            <a href="#">Quotes</a>
                            <a href="#">Advertisement</a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
<!-- END SECTION COURSE DETAIL -->

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

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
    function openPopup(url) {
        // Convert the standard YouTube URL to an embed URL if necessary
        const youtubeEmbedUrl = convertToEmbedUrl(url);
        // Set the size of the popup window
        var width = 800;
        var height = 600;
        // Calculate the position to center the popup
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;

        // Open the popup window and write the iframe HTML to it
        var popup = window.open('', 'VideoPopup', 'width=' + width + ', height=' + height + ', top=' + top + ', left=' + left + ', resizable=yes, scrollbars=yes');
        popup.document.write('<html><head><title>Video</title></head><body style="margin:0; padding:0; overflow:hidden;"><iframe width="100%" height="100%" src="' + youtubeEmbedUrl + '" frameborder="0" allowfullscreen></iframe></body></html>');
        popup.document.close();
    }

    function convertToEmbedUrl(url) {
        // This function converts a standard YouTube URL to an embed URL
        if (url.includes('youtube.com/watch?v=')) {
            return url.replace('watch?v=', 'embed/');
        } else if (url.includes('youtu.be/')) {
            return url.replace('youtu.be/', 'youtube.com/embed/');
        } else {
            return url; // Return the URL as is if it's not a YouTube URL
        }
    }
</script>

@endsection