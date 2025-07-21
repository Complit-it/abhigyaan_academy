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



<!-- START SECTION COURSES -->
<section class="small_pt">
	<div class="container">
        <div class="row">
            @foreach($allPackages as $package)
        	<div class="col-lg-4 col-sm-6">
            	<div class="content_box radius_all_10 box_shadow1 animation" data-animation="fadeInUp" data-animation-delay="0.01s">
                	<div class="content_img radius_ltrt_10">
                    	<a href="/course-detail/{{$package->package_code}}"><img src="{{ $package->package_image }}" alt="course_img1"/></a>
                    </div>
                    <div class="content_desc">
                    	<h4 class="content_title"><a href="/course-detail/{{$package->package_code}}">{{ $package->package_name }}</a></h4>
                        <p>{!! Illuminate\Support\Str::limit(strip_tags($package->description), 200) !!}</p>
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
                            {{-- <a href="#"><img src="assets/images/user1.jpg" alt="user1"><span>Alia Noor</span></a> --}}
                        </div> 
                        <div class="price">

                        	<span class="alert alert-success"> Rs. {{ $package->package_price }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{-- <div class="row">
        	<div class="col-12">
                <div class="medium_divider"></div>
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="ion-ios-arrow-thin-left"></i></a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#"><i class="ion-ios-arrow-thin-right"></i></a></li>
                </ul>
            </div>
        </div> --}}
    </div>
</section>
<!-- END SECTION COURSES -->

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

@endsection