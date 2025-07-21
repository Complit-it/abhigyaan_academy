
@if($section->id == 2)
<!-- START SECTION BANNER -->
<section class="banner_section p-0 full_screen top-section">
    <div id="carouselExampleControls" class="banner_content_wrap carousel slide p-0" data-ride="carousel">
        <div class="carousel-inner p-0">
            @foreach($bannersList as $key => $banner)
                <div class="carousel-item{{ $key === 0 ? ' active' : '' }} p-0">
                    <img src="{{ urldecode($banner->image_url) }}" alt="{{ $banner->image_alt_text }}" class="w-100">
                    {{-- <div class="banner_slide_content">
                        <!-- You can add content here if needed -->
                    </div> --}}
                </div>
            @endforeach
        </div>
        <ol class="carousel-indicators">
            @foreach($bannersList as $key => $banner)
                <li data-target="#carouselExampleControls" data-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>
        <div class="carousel-nav">
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <i class="ion-chevron-left"></i>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <i class="ion-chevron-right"></i>
            </a>
        </div>
    </div>
</section>

@endif
@if($section->id== 3)
      <!-- START SECTION ABOUT -->
        <section class="overflow-hidden small_pt small_pb" style="margin:0; padding: 0;">
            <div class="container-fluid p-0">
                <div class="row no-gutters ">
                    <div class="col-lg-6">
                        <div class="bg_gray h-100 d-flex align-items-center padding_eight_all">
                            <div class="animation" data-animation="fadeInLeft" data-animation-delay="0.02s">
                                <div class="heading_s1" > 
                                <h2>{{$allSections->where('id', 3)->first()->name}}</h2>
                                </div>

                                <p>{!! \Illuminate\Support\Str::limit(strip_tags($section3->content), 860) !!}</p>

                                <ul class="list_none list_item">
                                    <li>
                                        <div class="counter_content">
                                            {{-- <h3 class="h1 text_danger"><span class="counter">260</span></h3> --}}
                                            {{-- <a href="/about-us"><h6>Read More</h6></a> --}}
                                        </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 animation" data-animation="fadeInRight" data-animation-delay="0.03s" style="display: flex;justify-content: center;background: #f7f7f7;">
                        <div class="overlay_bg_30 about_img z_index_minus1 2-100"  style="display: flex;justify-content: center;" >

                            <img src="{{urldecode($section3->image_url)}}" alt="about-us">
                        </div>
                        <a id="videoLink" href="{{$section3->video_link}}" class="video_play">
                            <span class="ripple"><i class="ion-play ml-1"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- END SECTION ABOUT -->
@endif

@if($section->id == 4)
         <!-- START SECTION CATEGORIES -->
    <section class="bg_army2 background_bg " data-img-src="/assets/images/pattern_bg2.png">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="text-center text_white animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                        <div class="heading_s1 heading_light text-center">
                            <h2>{{$allSections->where('id', 4)->first()->name}}</h2>
                        </div>
                        <p>{{$allSections->where('id', 4)->first()->sub_header}}

                        </p>
                        <div class="small_divider"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <div class="course_categories carousel_slider owl-carousel owl-theme dots_white" data-margin="15" data-loop="true" data-autoplay="true" data-responsive='{"0":{"items": "1"}, "380":{"items": "2"}, "576":{"items": "3"}, "1000":{"items": "4"}, "1199":{"items": "5"}}'>
                        @foreach($section4 as $exam)
                        <div class="item">
                            <div class="single_categories cat_style1">
                                <a href="{{$exam->navigation_link}}">
                                    <img src="{{$exam->image_url}}" alt="{{$exam->image_alt_text}}"/>
                                    {{ strtoupper($exam->image_alt_text) }}

                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION CATEGORIES -->
@endif

@if($section->id == 5)
     <!-- START SECTION FEATURE -->
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="text-center animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                        <div class="heading_s1 text-center">
                            <h2>{{$allSections->where('id', 5)->first()->name}}</h2>
                        </div>
                        <p>{{$allSections->where('id', 5)->first()->name}}                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="icon_box icon_box_style1 animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                        <div class="box_icon mb-3">
                            <i class="fa fa-book text_default"></i>
                        </div>
                        <div class="intro_desc">
                            <h5>Books & Library</h5>
                            <p>Access to a vast collection of books and resources to aid your learning journey.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="icon_box icon_box_style1 animation" data-animation="fadeInUp" data-animation-delay="0.03s">
                        <div class="box_icon mb-3">
                            <i class="fa fa-globe text_default"></i>
                        </div>
                        <div class="intro_desc">
                            <h5>Learn Courses Online</h5>
                            <p>Engage in comprehensive online courses tailored to your exam preparation needs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="icon_box icon_box_style1 animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                        <div class="box_icon mb-3">
                            <i class="fa fa-user-tie text_default"></i>
                        </div>
                        <div class="intro_desc">
                            <h5>Expert Instructors</h5>
                            <p>Learn from the experienced instructors who are dedicated to your success.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="icon_box icon_box_style1 animation" data-animation="fadeInUp" data-animation-delay="0.05s">
                        <div class="box_icon mb-3">
                            <i class="fa fa-headphones-alt text_default"></i>
                        </div>
                        <div class="intro_desc">
                            <h5>Interactive Sessions</h5>
                            <p>Participate in engaging interactive sessions to reinforce your learning.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="icon_box icon_box_style1 animation" data-animation="fadeInUp" data-animation-delay="0.06s">
                        <div class="box_icon mb-3">
                            <i class="fa fa-graduation-cap text_default"></i>
                        </div>
                        <div class="intro_desc">
                            <h5>Scholarship</h5>
                            <p>Scholarships based on merit to support your educational journey.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="icon_box icon_box_style1 animation" data-animation="fadeInUp" data-animation-delay="0.07s">
                        <div class="box_icon mb-3">
                            <i class="fa fa-chalkboard-teacher text_default"></i>
                        </div>
                        <div class="intro_desc">
                            <h5>Personalized Coaching</h5>
                            <p>Personalized coaching tailored to your learning pace.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@if($section->id == 6)
   
    <!-- START SECTION VIDEO -->
    <section class="parallax_bg overlay_bg_70" data-parallax-bg-image="{{$section6->image_url}}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                        <a href="{{$section6->video_link}}" class="video_popup">
                            <span class="ripple"><i class="ion-play ml-1"></i></span>
                        </a>
                        <div class="mt-md-5 mt-4 text_white animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                            <h2>{{$allSections->where('id', 6)->first()->name}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION VIDEO -->
@endif

@if($section->id == 7)
       <!-- START SECTION COURSES -->
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="text-center animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                        <div class="heading_s1 text-center">
                            <h2>{{$allSections->where('id', 7)->first()->name}}</h2>
                        </div>
                        <p>{{$allSections->where('id', 7)->first()->sub_header}}
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="course_list">
                        <div class="row">
                            @foreach($last3packages as $package)
                <div class="col-lg-4 col-sm-6">
                    <div class="content_box radius_all_10 box_shadow1 animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                        <div class="content_img radius_ltrt_10">
                            <a href="/course-detail/{{$package->package_code}}"><img src="{{ $package->package_image }}" alt="course_img1"/></a>
                        </div>
                        <div class="content_desc">
                            <h4 class="content_title"><a href="/course-detail/{{$package->package_code}}">{{ $package->package_name }}</a></h4>
                            <p>{!! \Illuminate\Support\Str::limit(strip_tags($package->package_description), 200) !!}</p>
                            {{-- <div class="courses_info">
                                    <div class="rating_stars">
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star"></i>
                                        <i class="ion-android-star-half"></i> 
                                    </div>
                                    <ul class="list_none content_meta">
                                        <li><a href="#" ><i class="ti-user"></i>31</a></li>
                                        <li><a href="#"><i class="ti-heart"></i>10</a></li>
                                    </ul>
                                </div> --}}
                        </div>
                        <div class="content_footer">
                            <div class="teacher">
                                {{-- <a href="#"><img src="/assets/images/user1.jpg" alt="user1"><span>Alia Noor</span></a> --}}
                            </div> 
                            <div class="price">

                                <span class="alert alert-success"> Rs. {{ $package->package_price }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                            @endforeach
                            
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="text-center animation" data-animation="fadeInUp" data-animation-delay="0.07s">
                        <div class="medium_divider"></div>
                        <a href="/courses" class="btn btn-default rounded-0">View All Courses <i class="ion-ios-arrow-thin-right ml-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION COURSES -->
@endif

@if($section->id == 8)
    <!-- START SECTION BLOG -->
    <section class="bg_gray">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading_s1 text-center animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                        <h2>{{$allSections->where('id', 8)->first()->name}}</h2>
                    </div>
                    <p>{{$allSections->where('id', 8)->first()->sub_header}}

                </div>
            </div>
            <div class="row justify-content-center">

                @foreach($top3blogs as $blog)

                <div class="col-lg-4 col-md-6">
                    <div class="blog_post box_shadow1 animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                        <div class="blog_img">
                            <a href="/blog/{{ $blog->slug }}">
                                {{-- <img src="upload/blogs/1715692484.webp" alt="{{ $blog->title}}"> --}}
                                <img src="/upload/blogs/{{ $blog->featured_image }}" alt="{{ $blog->featured_image }}">
                                <div class="link_blog">
                                    <span class="ripple"><i class="fa fa-link"></i></span>
                                </div>
                            </a>
                        </div>
                        <div class="blog_content bg-white">
                            <h6 class="blog_title"><a href="/blog/{{ $blog->slug }}">{{ $blog->title}}</a></h6>
                            <p>{{ Illuminate\Support\Str::limit(html_entity_decode(strip_tags($blog->actual_blog)), 200) }}</p>
                            <a href="/blog/{{ $blog->slug }}" class="text-capitalize">Read More</a>
                        </div>
                        <div class="blog_footer bg-white">
                            <ul class="list_none blog_meta">
                                <li><a href="#"><i class="ion-calendar"></i>{{ \Carbon\Carbon::parse($blog->published_on)->format('j F, Y') }}</a></li>
                                {{-- <li><a href="#"><i class="ion-chatbubbles"></i>2 Comment</a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="text-center animation" data-animation="fadeInUp" data-animation-delay="0.04s">
                        <div class="medium_divider"></div>
                        <a href="blogs" class="btn btn-default rounded-0">View All Blog <i class="ion-ios-arrow-thin-right ml-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endif

@if($section->id == 9)

    <!-- START SECTION REGISTER -->
    <section class="pb-md-0 background_bg bg_fixed z-index9999" style="background-color:#2c411b" data-img-src="/assets/images/pattern_bg4.png">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6">
                    <div class="text-center animation offer_info" data-animation="fadeInRight" data-animation-delay="0.03s">
                        <div class="heading_s1 heading_light">
                            <span class="sub_heading">not sure yet?</span>
                            <h2>Get a <span class="text_default">Special</span> discount</h2>
                        </div>
                        <div class="small_divider clearfix"></div>
                        <div class="countdown_time countdown_style1 countdown_white" id="countdown" data-time="2019/12/06 00:00:00"></div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="bg-white apply_form radius_all_10 box_shadow1 padding_eight_all animation" data-animation="fadeInLeft" data-animation-delay="0.02s">
                        <div class="heading_s1">
                            <h3>Enquire For Online Courses</h3>
                        </div>
                        <p>If you have any quires please fill up this form we will reach out to you to answer all your quires.</p>
                        <form method="post" action="/" class="pt-md-2">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12">
                                    <input required="required" placeholder="Enter Name *" class="form-control" name="name" type="text">
                                </div>
                                <div class="form-group col-12">
                                    <input required="required" placeholder="Enter Email *" class="form-control" name="email" type="email">
                                </div>
                                <div class="form-group col-12">
                                    <input required="required" placeholder="Enter Phone No *" class="form-control" name="phone" type="tel">
                                </div>
                                <div class="form-group col-12">
                                    <div class="custom_select">
                                        <select class="form-control" name="course">
                                            <option>Select Course</option>
                                            @foreach($last3packages as $package)
                                                <option value="{{$package->id}}/{{$package->package_name}}">{{$package->package_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" title="Submit Your Message!" class="btn btn-default" name="submit" value="Submit">Enquire Now</button>
                                </div>
                                <div class="col-12">
                                    <div id="alert-msg" class="alert-msg text-center"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION REGISTER -->

@endif

@if($section->id == 10)
    <!-- START SECTION TESTIMONIAL -->
    <section class="background_bg bg_fixed" data-img-src="/assets/images/pattern_bg3.png">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="text-center animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                        <div class="heading_s1 text-center">
                            <h2>{{$allSections->where('id', 10)->first()->name}}</h2>
                        </div>
                        <p>{{$allSections->where('id', 10)->first()->sub_header}}
                            <div class="small_divider"></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                    <div class="testimonial_slider testimonial_style2 carousel_slider owl-carousel owl-theme" data-margin="30" data-loop="true" data-autoplay="true" data-dots="false" data-responsive='{"0":{"items": "1"}, "380":{"items": "1"}, "576":{"items": "2"}, "1199":{"items": "3"}}'>
                        @foreach($studentsSay  as $testimony)
                        
                        <div class="testimonial_box">
                            <div class="testimonial_img">
                                <img src="{{$testimony['imageUrl']}}" alt="client">
                            </div>
                            <div class="testi_meta">
                                <div class="testi_user">
                                    <h6>{{$testimony['title']}}</h6>
                                    <div class="rating_stars">
                                        
                                        @for($i = 0; $i < $testimony['rating']; $i++)
                                            <i class="ion-android-star"></i>
                                        @endfor
                                    </div>

                                    <span class="text_default">{{$testimony['from']}}</span>
                                </div>
                                <div class="testi_desc">
                                    <p>{{$testimony['description']}}</p>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif