<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}


<!-- START HEADER -->
<header class="header_wrap bg_army light_skin">
    {{-- <header class="header_wrap bg_blue_dark light_skin"> --}}
        <div class="top-header light_skin">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <ul class="contact_detail list_none text-center text-md-left">
                        <li><i class="ti-mobile"></i><a href="tel:+919540504779">+919540504779 </a> |<a href="tel:+918240324106"> +918240324106 </a></li>
                        <li><a href="mailto:abhigyanacademy1993@gmail.com"><i class="ti-email"></i>abhigyanacademy1993@gmail.com</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                	<div class="d-flex flex-wrap align-items-center justify-content-md-end justify-content-center mt-2 mt-md-0">
                    	<ul class="list_none social_icons social_white text-center text-md-right">
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            {{-- <li><a href="#"><i class="ion-social-googleplus"></i></a></li> --}}
                            <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                        <ul class="list_none header_list border_list ml-1">
                            <li><a href="#" data-toggle="modal" data-target="#Login">Login</a></li>
                            <li><a href="#" class="btn btn-default btn-sm rounded-0">JOIN NOW</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <nav class="navbar navbar-expand-lg"> 
            <a class="navbar-brand" href="/">
                <img class="logo_light" src="assets/images/abhigyan_academy_logo_small.webp" alt="logo" />
                <img class="logo_dark" src="assets/images/abhigyan_academy_logo_small.webp" alt="logo" />
                <img class="logo_default" src="assets/images/abhigyan_academy_logo_small.webp" alt="logo" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="ion-android-menu"></span> </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li>
                        <a class="nav-link  @if (request()->is('home')) @echo active @endif"
                            {{-- if route is home add class active --}}
                        href="home" wire:navigate>Home</a>
                    </li>
                    {{-- <li class="dropdown">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Pages</a>
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
                        <a class="dropdown-toggle nav-link  @if (request()->is('courses')) @echo active @endif" href="#" data-toggle="dropdown">Course</a>
                        <div class="dropdown-menu">
                            <ul> 
                                <li><a class="dropdown-item nav-link nav_item" href="courses.html">CDS</a></li> 
                                <li><a class="dropdown-item nav-link nav_item" href="courses.html">AFCAT</a></li> 
                                <li><a class="dropdown-item nav-link nav_item" href="courses.html">AGNIVEER</a></li> 
                            </ul>
                        </div>
                    </li>
                    {{-- <li class="dropdown">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Event</a>
                        <div class="dropdown-menu">
                            <ul> 
                                <li><a class="dropdown-item nav-link nav_item" href="event.html">Event</a></li> 
                                <li><a class="dropdown-item nav-link nav_item" href="event-detail.html">Event Detail</a></li>
                            </ul>
                        </div>
                    </li> --}}
                    {{-- <li class="dropdown">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Teacher</a>
                        <div class="dropdown-menu">
                            <ul> 
                                <li><a class="dropdown-item nav-link nav_item" href="teacher.html">Teacher</a></li> 
                                <li><a class="dropdown-item nav-link nav_item" href="teacher-detail.html">Teacher Detail</a></li>
                            </ul>
                        </div>
                    </li> --}}
                    <li class="dropdown">
                        <a class="nav-link" href="#" data-toggle="dropdown">Blogs</a>
                        {{-- <div class="dropdown-menu">
                            <ul> 
                                <li><a class="dropdown-item nav-link nav_item" href="blog.html">Blogs</a></li> 
                                <li><a class="dropdown-item nav-link nav_item" href="blog-detail.html">Blog Detail</a></li>
                            </ul>
                        </div> --}}
                    </li>
                    <li>
                        <a class="nav-link  @if (request()->is('contact')) @echo active @endif" wire:navigate 
                            {{-- if route is contact add class active --}}
                           
                        href="contact">Contact</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav attr-nav align-items-center">
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
            </ul>
        </nav>
    </div>
</header>
<!-- END HEADER --> 
</div>
