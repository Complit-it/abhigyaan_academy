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
<section class="small_pt">
	<div class="container">
        <div class="row justify-content-center">
        	@foreach($top3blogs as $blog)

        	<div class="col-lg-4 col-md-6">
            	<div class="blog_post box_shadow1 animation" data-animation="fadeInUp" data-animation-delay="0.02s">
                	<div class="blog_img">
                        <a href="/blog/{{ $blog->slug }}">
                            {{-- <img src="upload/blogs/1715692484.webp" alt="{{ $blog->title}}"> --}}
                            <img src="/upload/blogs/{{ $blog->featured_image }}" alt="{{ $blog->title }}">
                            <div class="link_blog">
                            	<span class="ripple"><i class="fa fa-link"></i></span>
                            </div>
                        </a>
                    </div>
                    <div class="blog_content bg-white">
                        <h6 class="blog_title"><a href="/blog/{{ $blog->slug }}">{{ $blog->title}}</a></h6>
                        <p>{{ Illuminate\Support\Str::limit(strip_tags($blog->actual_blog), 200) }}</p>
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


@endsection