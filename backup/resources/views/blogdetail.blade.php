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

<section>
	<div class="container">
    	<div class="row">
        	<div class="col-lg-9">
            	<div class="single_post">
                    <div class="blog_img">
                        <a href="#">
                            <img src="/upload/blogs/{{$blogDetail->featured_image}}" alt="blog_img1">
                        </a>
                    </div>
                    <div class="single_post_content">
                        <div class="blog_text">
                            <h3>{{$blogDetail->title}}</h3>
                            <ul class="list_none blog_meta">
                                <li><a href="#"><i class="ion-calendar"></i>{{ \Carbon\Carbon::parse($blogDetail->published_on)->format('j F, Y') }}</a></li>
                            </ul>

                            {{-- //display HTML --}}
                            {!! $blogDetail->actual_blog !!}
                            
                            <div class="border-top border-bottom py-2 py-md-4 blog_post_footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="share">
                                            <h5>Share :</h5>
                                            <ul class="list_none social_icons radius_social">
                                                <li><a id="facebook-share" class="sc_facebook" target="_blank"><i class="ion-social-facebook"></i></a></li>
                                                <li><a id="twitter-share" class="sc_twitter" target="_blank"><i class="ion-social-twitter"></i></a></li>
                                                <li><a id="whatsapp-share" class="sc_whatsapp" target="_blank"><img src="/assets/images/all_new/whatsapp.png" alt="WhatsApp"/></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    {{-- <div class="post_navigation">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto">
                                <a href="#">
                                    <div class="d-flex align-items-center">
                                        <i class="ion-ios-arrow-thin-left mr-3"></i>
                                        <div>
                                            <span>previous Post</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-auto">
                                <a href="#">
                                    <div class="d-flex align-items-center flex-row-reverse text-right">
                                        <i class="ion-ios-arrow-thin-right ml-3"></i>
                                        <div>
                                            <span>Next Post</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                  
                    {{-- <div class="related_post">
                        <div class="comment-title">
                            <h5>Related posts</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="blog_post box_shadow1 radius_all_10">
                                    <div class="blog_img radius_ltrt_10">
                                        <a href="#">
                                            <img src="assets/images/blog_small_img1.jpg" alt="blog_small_img1">
                                            <div class="link_blog">
                                                <span class="ripple"><i class="fa fa-link"></i></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="blog_content bg-white">
                                        <h6 class="blog_title"><a href="#">Why are tickets to fly to Lagos expensive?</a></h6>
                                        <p>If you are going to use a passage of Lorem Ipsum you need to be sure there anything embarrassing hidden in the middle of text</p>
                                        <a href="#" class="text-capitalize">Read More</a>
                                    </div>
                                    <div class="blog_footer bg-white radius_lbrb_10">
                                        <ul class="list_none blog_meta">
                                            <li><a href="#"><i class="ion-calendar"></i>15 May, 2019</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="blog_post box_shadow1 radius_all_10">
                                    <div class="blog_img radius_ltrt_10">
                                        <a href="#">
                                            <img src="assets/images/blog_small_img2.jpg" alt="blog_small_img2">
                                            <div class="link_blog">
                                                <span class="ripple"><i class="fa fa-link"></i></span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="blog_content bg-white">
                                        <h6 class="blog_title"><a href="#">Why are tickets to fly to Lagos expensive?</a></h6>
                                        <p>If you are going to use a passage of Lorem Ipsum you need to be sure there anything embarrassing hidden in the middle of text</p>
                                        <a href="#" class="text-capitalize">Read More</a>
                                    </div>
                                    <div class="blog_footer bg-white radius_lbrb_10">
                                        <ul class="list_none blog_meta">
                                            <li><a href="#"><i class="ion-calendar"></i>15 May, 2019</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    
                </div>
            </div>
            <div class="col-lg-3 mt-lg-0 mt-4 pt-3 pt-lg-0">
            	<div class="sidebar">
                    {{-- <div class="widget widget_search">
                        <form class="search_form"> 
                            <input required="" class="form-control" placeholder="Search..." type="text">
                            <button type="submit" title="Subscribe" name="submit" value="Submit">
                                <span class="ti-search"></span>
                            </button>
                        </form>
                    </div>
                    <div class="widget widget_categories">
                    	<h5 class="widget_title">Categories</h5>
                        <ul>
                            <li><a href="#"><span class="categories_name">Development</span></a></li>
                            <li><a href="#"><span class="categories_name">Business</span></a></li>
                            <li><a href="#"><span class="categories_name">Academics</span></a></li>
                            <li><a href="#"><span class="categories_name">Health Fitness</span></a></li>
                            <li><a href="#"><span class="categories_name">Photography</span></a></li>
                    	</ul>
                    </div> --}}
                    <div class="widget widget_recent_post">
                    	<h5 class="widget_title">Recent Post</h5>
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
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION BLOG -->

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
    const currentUrl = window.location.href;
    const encodedUrl = encodeURIComponent(currentUrl);
    document.getElementById('facebook-share').href = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
    document.getElementById('twitter-share').href = `https://twitter.com/intent/tweet?url=${encodedUrl}`;
    document.getElementById('whatsapp-share').href = `https://api.whatsapp.com/send?text=${encodedUrl}`;
</script>


@endsection