<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="/adminAsset/dist/img/roadpartner_logo.png" alt="Dashboard Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/adminAsset/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                <li class="nav-item {{ request()->is('dashboard') ? 'menu-open' : '' }}">
                    <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Home
                        </p>
                    </a>

                </li>


                <li class="nav-item @if (request()->is('batch')|| request()->is('edit-batch/*')|| request()->is('view-batch-students/*') || request()->is('topics') || request()->is('app-banner') || request()->is('edit-app-banner') || request()->is('subjects') || request()->is('edit-sub-topic/*') || request()->is('sub-sub-topics') || request()->is('edit-sub-sub-topic/*') || request()->is('edit-subject/*') || request()->is('edit-topic/*') || request()->is('sub-topics')) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Students
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="/view-students" class="nav-link  @if (request()->is('view-students') || request()->is('edit-student/*') ) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    View Students
                                </p>
                            </a>

                        </li>
                        
                        <li class="nav-item ">
                            <a href="/batch" class="nav-link  @if (request()->is('view-batch-students/*') || request()->is('batch') || request()->is('edit-batch/*')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Batches
                                </p>
                            </a>

                        </li>
                        


                    </ul>
                </li>


                <li class="nav-item @if (request()->is('topics') || request()->is('app-banner') || request()->is('edit-app-banner') || request()->is('subjects') || request()->is('edit-sub-topic/*') || request()->is('sub-sub-topics') || request()->is('edit-sub-sub-topic/*') || request()->is('edit-subject/*') || request()->is('edit-topic/*') || request()->is('sub-topics')) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-shopping-basket"></i>
                        <p>
                            Master Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="/subjects" class="nav-link  @if (request()->is('subjects') || request()->is('edit-subject/*')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Subjects
                                </p>
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a href="/topics" class="nav-link  @if (request()->is('topics') || request()->is('edit-topic/*')|| request()->is('addProductPost')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Topics
                                </p>
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a href="/sub-topics" class="nav-link @if (request()->is('sub-topics') || request()->is('edit-sub-topic/*')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Sub Topics
                                </p>
                            </a>

                        </li>

                        <li class="nav-item ">
                            <a href="/sub-sub-topics" class="nav-link @if (request()->is('sub-sub-topics') || request()->is('edit-sub-sub-topic/*')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Sub Sub Topics
                                </p>
                            </a>

                        </li>

                        <li class="nav-item ">
                            <a href="/app-banner" class="nav-link  @if (request()->is('app-banner') || request()->is('edit-app-banner')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Web Data
                                </p>
                            </a>

                        </li>



                    </ul>
                </li>

                <li class="nav-item @if (request()->is('mcqs') || request()->is('videos') || request()->is('edit-mcq-batch/*') ||request()->is('gallery') || request()->is('edit-gallery/*') || request()->is('pdf')) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                            Resources
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="/mcqs" class="nav-link  @if (request()->is('mcqs') || request()->is('edit-mcq-batch/*')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    MCQs
                                </p>
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a href="/videos" class="nav-link  @if (request()->is('videos') || request()->is('edit-topic/*')|| request()->is('addProductPost')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Videos
                                </p>
                            </a>

                        </li>

                        <li class="nav-item ">
                            <a href="/pdf" class="nav-link  @if (request()->is('pdf') || request()->is('edit-topic/*')|| request()->is('addProductPost')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    PDF's
                                </p>
                            </a>

                        </li>

                        <li class="nav-item ">
                            <a href="/pdf-text" class="nav-link  @if (request()->is('pdf-text') || request()->is('edit-topic/*')|| request()->is('addProductPost')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    PDF's Text
                                </p>
                            </a>

                        </li>

                        <li class="nav-item ">
                            <a href="/gallery" class="nav-link  @if (request()->is('gallery') || request()->is('edit-gallery/*')|| request()->is('addProductPost')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Gallery
                                </p>
                            </a>

                        </li>
                        


                    </ul>
                </li>


                <li class="nav-item">
                    <a href="/packages" class="nav-link {{ request()->is('packages') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Packages
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="/packages" class="nav-link  @if (request()->is('packages') || request()->is('edit-gallery/*')|| request()->is('addProductPost')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Package Details
                                </p>
                            </a>
                        </li>

                     
                    </ul>
                </li>

                {{-- <li class="nav-item">
                    <a href="add-notification" class="nav-link {{ request()->is('add-notification') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Send Notification
                        </p>
                    </a>
                </li> --}}

                


                <!-- <li class="nav-item @if (request()->is('addProduct') || request()->is('editProduct') || request()->is('addProductPost') || request()->is('editProductPost')) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-shopping-basket"></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="addProduct" class="nav-link  @if (request()->is('addProduct') || request()->is('addProductPost')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Add
                                </p>
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a href="editProduct" class="nav-link @if (request()->is('editProduct') || request()->is('editProductPost')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    View/Edit
                                </p>
                            </a>

                        </li>



                    </ul>
                </li> -->

                {{-- <li class="nav-item @if (request()->is('addVendor') || request()->is('viewVendors') || request()->is('addVendorPost') || request()->is('editVendorPost')) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cart-plus"></i>
                        <p>
                            Service Provider
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href="viewVendors" class="nav-link @if (request()->is('viewVendors') || request()->is('editVendor')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    View
                                </p>
                            </a>

                        </li>



                    </ul>
                </li> --}}

                <!-- <li class="nav-item @if (request()->is('viewStockRequest')) menu-open @endif">
                    <a href="viewStockRequest" class="nav-link">
                        <i class="nav-icon fa fa-archive"></i>
                        <p>
                            Stocks
                        </p>
                    </a>
                </li> -->




                {{-- <li class="nav-item">
                    <a href="changePassword" class="nav-link">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>
                            Change Password
                        </p>
                    </a>

                </li> --}}

                {{-- <li class="nav-item @if (request()->is('service') || request()->is('service-sub-category') || request()->is('vehicle-model') || request()->is('vehicle-brand') || request()->is('vehicle-category')) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Vehicle Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <!-- <li class="nav-item ">
                            <a href="addOffers" class="nav-link @if (request()->is('addOffers') || request()->is('addOffersPost')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Add Offers
                                </p>
                            </a>

                        </li> -->


                        <li class="nav-item ">
                            <a href="/vehicle-category" class="nav-link @if (request()->is('vehicle-category')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Vehicle Category
                                </p>
                            </a>

                        </li>

                        <li class="nav-item ">
                            <a href="/vehicle-brand" class="nav-link @if (request()->is('vehicle-brand')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Vehicle Brand
                                </p>
                            </a>

                        </li>

                        <li class="nav-item ">
                            <a href="/brand-category-mapping" class="nav-link @if (request()->is('brand-category-mapping')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Brand to Category
                                </p>
                            </a>

                        </li>

                       


                        <li class="nav-item ">
                            <a href="/vehicle-model" class="nav-link @if (request()->is('vehicle-model')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                   Vehicle Model
                                </p>
                            </a>

                        </li>
                    </ul>
                </li> --}}


                {{-- <li class="nav-item @if (request()->is('service') || request()->is('problem-questionaire')  || request()->is('service-sub-category') || request()->is('vehicle-model') || request()->is('vehicle-brand') || request()->is('vehicle-category')) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Service Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                <li class="nav-item ">
                            <a href="/service" class="nav-link  @if (request()->is('service')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Service Provider Type
                                </p>
                            </a>

                        </li>
                        <li class="nav-item ">
                            <a href="/service-sub-category" class="nav-link @if (request()->is('service-sub-category')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Services
                                </p>
                            </a>
                            </li>


                            <li class="nav-item ">
                                <a href="/problem-category" class="nav-link  @if (request()->is('problem-category')) active @endif">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Problem Category
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="/problem-category-to-problems" class="nav-link  @if (request()->is('problem-category-to-problems')) active @endif">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Problem Category to Problem
                                    </p>
                                </a>
                            </li>


                            <li class="nav-item ">
                                <a href="/problem-questionaire" class="nav-link  @if (request()->is('problem-questionaire')) active @endif">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Problem Questionire
                                    </p>
                                </a>
                            </li>

                    </ul>
                </li> --}}


                <li class="nav-item @if (request()->is('add-blogs') ) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                           Blogs
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="/add-blogs" class="nav-link  @if (request()->is('add-blogs')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Add Blogs
                                </p>
                            </a>

                        </li>



                    </ul>


                </li>





                        {{-- <li class="nav-item ">
                            <a href="/vehicle-services" class="nav-link @if (request()->is('vehicle-services')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                   Services for Vehicles
                                </p>
                            </a>

                        </li> --}}


                <li class="nav-item">
                    <a href="/go-live" class="nav-link {{ request()->is('go-live') ? 'active' : '' }}">
                    <i class="nav-icon fab fa-youtube"></i>
                    <p>
                            Youtube Live
                        </p>
                    </a>

                </li>


               
                <li class="nav-item @if (request()->is('dynamic-form-builder') || request()->is('view-forms') || request()->is('view-form')  ) menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                           Landing Page
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="/dynamic-form-builder" class="nav-link  @if (request()->is('dynamic-form-builder') || request()->is('view-form')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Dynamic Form Builder
                                </p>
                            </a>

                        </li>

                        <li class="nav-item ">
                            <a href="/view-forms" class="nav-link  @if (request()->is('view-forms')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    View Forms
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="/landing-page" class="nav-link  @if (request()->is('landing-page')) active @endif">
                                <i class="nav-icon far fa-circle"></i>

                                <p>
                                    Landing Page
                                </p>
                            </a>
                        </li>






                    </ul>


                </li>




                <li class="nav-item">
                    <a href="contact-form-submission" class="nav-link {{ request()->is('contact-form-submission') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-thin fa-address-book"></i>
                    <p>
                            Contact Form
                        </p>
                    </a>

                </li>

                <li class="nav-item">
                    <a href="enquires" class="nav-link {{ request()->is('enquires') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-thin fa-question"></i>
                    <p>
                            Enquires
                        </p>
                    </a>

                </li>


                <li class="nav-item">
                    <a href="auditTrail" class="nav-link {{ request()->is('auditTrail') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <p>
                            Audit Trail
                        </p>
                    </a>

                </li>

                {{-- <li class="nav-item">
                    <a href="https://documenter.getpostman.com/view/16625716/2s9Ykrbzd6" target="_blank" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            API Documentation
                        </p>
                    </a>
                </li> --}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
