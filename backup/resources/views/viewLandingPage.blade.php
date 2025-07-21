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


<style>
    .banner_section {
        position: relative;
        overflow: hidden;
        height: 100vh;
    }
    .carousel-item {
        width: 100%;
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center center;
    }
    .carousel-inner {
        height: 100%;
    }
    .carousel-item .banner_slide_content {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .full_screen, .full_screen .carousel-item {
        min-height: 0;
    }
    .banner_section {
        height: 100%;
    }

    .z-index9999{
        z-index: 9999;
    }

    @media only screen and (max-width: 1199px) {
        .top-section{
        padding: 0;
    }
    
    }
</style>

@foreach($allSections as $section)
    @switch($section->order)
        @case(2)   
        @include('landinpagesections')
        @break

        @case(3)
        @include('landinpagesections')
        @break

        @case(4)   
        @include('landinpagesections')
        @break

        @case(5)
        @include('landinpagesections')
        @break

        @case(6)   
        @include('landinpagesections')
        @break

        @case(7)
        @include('landinpagesections')
        @break

        @case(8)   
        @include('landinpagesections')
        @break

        @case(9)
        @include('landinpagesections')
        @break

        @case(10)   
        @include('landinpagesections')
        @break

        @case(11)
        @include('landinpagesections')
        @break
        


        @default
            
    @endswitch
@endforeach


<!-- Modal -->

@if(session('enquiremessage'))

<div id="flash-message" style="position: fixed; top:10%; right:0; z-index: 9999" class="p-3" >
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('enquiremessage') }}
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
@else
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#2b411c">
                <h5 class="modal-title" id="exampleModalLabel"  style="color:white">Looking for something ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white" >&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="subscribeForm" action="/" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="phone" class="form-control" id="phone"  name="phone" placeholder="Phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email"   placeholder="Email" required>
                    </div>
                   

                    <div class="form-group">
                        <label for="email">Course You are looking for:</label>
                        <select class="form-control select2" name="course" id="course" required>
                            <option value="-1">Select Course</option>
                            @foreach($last3packages as $package)
                                <option value="{{$package->id}}/{{$package->package_name}}">{{$package->package_name}}</option>
                            @endforeach
                        </select>
                    </div>
                   
                    <button type="submit" class="btn btn-primary" style="background-color:#f5862b;border:#f5862b">Enquery Now</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif


@section('scripts')

@endsection
{{-- <script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script> --}}

<script>
     function initializeCountdown() {
        // Get the current date and time
        const now = new Date();
        
        // Set the time for midnight
        const midnight = new Date();
        midnight.setHours(24, 0, 0, 0);
        
        // Set the data-time attribute to the next date in ISO format
        const nextDateStr = midnight.toISOString().slice(0, 19).replace('T', ' ');
        document.getElementById('countdown').setAttribute('data-time', nextDateStr);
        
        // Initialize the countdown using the data-time attribute
        $('#countdown').countdown(midnight, function(event) {
            $(this).html(event.strftime('%H:%M:%S'));
        }).on('finish.countdown', initializeCountdown);
    }

    // $(document).ready(function() {
    //     initializeCountdown();
    // });
</script>

<!-- END SECTION TESTIMONIAL -->
<script>
    // Function to display the YouTube video
    function displayYouTubeVideo(link) {
        // Extract the video ID from the YouTube link
        var videoId = link.href.split('/').pop();
    
        // Create a new iframe element
        var iframe = document.createElement('iframe');
    
        // Set the src attribute to the YouTube embed URL with the video ID
        iframe.src = 'https://www.youtube.com/embed/' + videoId;
    
        // Set attributes for the iframe
        iframe.width = '560'; // You can adjust the width and height as needed
        iframe.height = '315';
        iframe.frameborder = '0';
        iframe.allowfullscreen = true;
    
        // Replace the content of the parent element with the iframe
        var parentElement = link.parentNode;
        parentElement.innerHTML = '';
        parentElement.appendChild(iframe);
    }
    
    // Attach click event listener to the link
    document.getElementById('videoLink').addEventListener('click', function(event) {
        // Prevent the default action of the link
        event.preventDefault();
    
        // Call the function to display the YouTube video
        displayYouTubeVideo(this);
    });
    </script>
    
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializeCountdown();

            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                keyboard: false
            });
           // myModal.show();
        });
    </script>
@endsection