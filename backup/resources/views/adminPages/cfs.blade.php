@extends('layouts.app')

@section('content')
    @include('layouts.adminMenu')


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script type="text/javascript">
        @if (isset($alertTitle))
            Swal.fire(
                '{{ $alertTitle }}',
                '{{ $alertDescription }}',
                '{{ $alertIcon }}'
            )
        @endif
    </script>


<!-- Include Toastify CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<!-- Include Toastify JS -->
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('message'))
            Toastify({
                text: "{{ session('message') }}",
                duration: 3000,  // Adjust the duration as needed (in milliseconds)
                position: 'right',
                gravity: 'auto',
                backgroundColor: 'red', // Example background color
                close: true,
            }).showToast();
        @endif
    });
</script>





    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            @if ($errors->count())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-12">


                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">@if(isset($pagetitle)) Enquires @else Contact From Submitted By User @endif</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="table21" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>@if(isset($pagetitle)) Name @else Title @endif</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                @if(isset($pagetitle)) <th>Course Queried For</th> @endif
                                                @if(!isset($pagetitle))
                                                    <th>On</th>
                                                    <th>Description</th>
                                                @endif


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allBanners as $data)
                                                <tr>
                                                    {{-- <td>
                                                        @if ($data['category'] == 1)
                                                            Home Banners
                                                        @endif
                                                        @if ($data['category'] == 2)
                                                            Popular Exams
                                                        @endif
                                                        @if ($data['category'] == 3)
                                                            Student Testimonials
                                                        @endif
                                                        @if ($data['category'] == 4)
                                                            App Banners
                                                        @endif
                                                        @if ($data['category'] == 5)
                                                            Blog Category
                                                        @endif
                                                        @if ($data['category'] == 'contact')
                                                        Contact Form
                                                    @endif
                                                        
                                                    
                                                    </td> --}}

                                                    @if(isset($pagetitle)) 
                                                        <td>
                                                            {{ $data['from'] }}
                                                        </td>
                                                        <td>
                                                            {{ $data['email'] }}
                                                        </td>
                                                        <td>
                                                            {{ $data['phone'] }}
                                                        </td>
                                                        <td>
                                                            {{ $data['description'] }}
                                                        </td>
                                                       
                                                    
                                                    @endif

                                                    @if(!isset($pagetitle)) 

                                                    <td>
                                                        @if($data['title'] == null)
                                                            No Title

                                                        @else
                                                            {{ $data['title'] }}
                                                        @endif
                                                    </td>
                                                   
                                                    <td>
                                                        @if($data['from'] == null)
                                                            No Scheduled From
                                                        @else
                                                            {{ $data['from'] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data['email'] == null)
                                                            No Scheduled From
                                                        @else
                                                            {{ $data['email'] }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if($data['phone'] == null)
                                                            No Scheduled From
                                                        @else
                                                            {{ $data['phone'] }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        {{ $data['created_at'] }}
                                                    </td>


                                                    <td>
                                                        @if($data['description'] == null)
                                                            No Description
                                                        @else
                                                            {{ $data['description'] }}
                                                        @endif
                                                    </td>
                                                    @endif
                                                   
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                {{-- <th>Category</th> --}}
                                                <th>@if(isset($pagetitle)) Name @else Title @endif</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                @if(isset($pagetitle)) <th>Course Queried For</th> @endif
                                                @if(!isset($pagetitle))
                                                    <th>On</th>
                                                    <th>Description</th>
                                                @endif

                                                {{-- <th>Title</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>On</th>
                                                <th>Description</th> --}}

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



    <link rel="stylesheet" href=" https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.js"></script>

    <!-- Summernote -->
    <script src="adminAsset/plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function() {
            //Add text editor
            $('#compose-textarea').summernote()
        })
    </script>



    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminAsset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <script src="{{ asset('adminAsset/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#table21').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [4, 'DESC'],
            });
        });
    </script>


    <script src="adminAsset/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>


    <script>

        $(document).ready(function() {
            $('#scheduledfromDiv').hide();
            $('#scheduledToDiv').hide();
            $('#descriptionDiv').hide();
        });

        function getFields(category) {
            var category = category.value;
            console.log(category);
            // Category 1 is for Home Banners
            if (category == 1) {
                $('#scheduledfromDiv').hide();
                $('#scheduledToDiv').hide();
                $('#descriptionDiv').hide();
                $('#imageTo').show();
                $('#customfileLabel').text('Image');
            } 
            // Category 2 is for Popular Exams
            else if( category == 2) {
                $('#scheduledfromDiv').hide();
                $('#scheduledToDiv').hide();
                $('#descriptionDiv').hide();
                $('#imageTo').show();

                $('#customfileLabel').text('Image');
            } 
            // Category 3 is for Student Testimonials
            else if( category == 3) {
                $('#scheduledfromDiv').hide();
                $('#scheduledToDiv').hide();
                $('#descriptionDiv').show();
                $('#imageTo').show();

                $('#customfileLabel').text('Image');
            } 
            // Category 4 is for App Banners
            else if( category == 4) {
                $('#scheduledfromDiv').show();
                $('#scheduledToDiv').show();
                $('#imageTo').show();
                $('#customfileLabel').text('Image');
            }
            // Category 5 is for Blog Category
            else if( category == 5) {
                $('#scheduledfromDiv').hide();
                $('#scheduledToDiv').hide();
                $('#descriptionDiv').hide();
                $('#imageTo').hide();
            }

            else {
                $('#scheduledfromDiv').hide();
                $('#scheduledToDiv').hide();
                $('#descriptionDiv').hide();
                $('#imageTo').hide();
            }
        }
        
    </script>
@endsection
