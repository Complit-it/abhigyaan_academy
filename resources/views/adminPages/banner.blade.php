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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Web Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if ($singleOffer == null)
                            <form role="form" id="addOffers" onsubmit="return submitForm()"
                                action={{ route('app-banner') }} method="post" enctype="multipart/form-data">
                        @endif
                        @if ($singleOffer != null)
                            <form role="form" id="edit-app-banner" onsubmit="return submitForm()"
                                action={{ route('edit-app-banner-post') }} method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id" class="form-control col-md-12"
                                    value="{{ $singleOffer->id }}" readonly />
                        @endif

                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="productName">Select Category</label>
                                        <select class="form-control select2" id="category" name="category" 
                                            style="width: 100%;" onchange="getFields(this);">
                                            <option value="-1" selected>----Select Category---</option>
                                            <option value="1"  @if($singleOffer != null) @if( $singleOffer->category == '1')  selected @endif @endif>Home Banners</option>
                                            <option value="2"   @if($singleOffer != null) @if( $singleOffer->category == '2')  selected @endif @endif >Popular Exams</option>
                                            <option value="3"   @if($singleOffer != null) @if( $singleOffer->category == '3')  selected @endif @endif>Student Testimonials</option>
                                            <option value="4"   @if($singleOffer != null) @if( $singleOffer->category == '4')  selected @endif @endif >App Banners</option>                                           
                                            <option value="5"   @if($singleOffer != null) @if( $singleOffer->category == '5')  selected @endif @endif >Blog Category</option>                                           
                                            <option value="6"   @if($singleOffer != null) @if( $singleOffer->category == '6')  selected @endif @endif >About US</option>                                           
                                            
                                        </select>
                                    </div>
                                </div>



                                <div class="col-md-4" id="titleDiv">
                                    <div class="form-group">
                                        <label for="titleDivLabel" id="titleDivLabel">Title <span style="color:red">*</span></label>
                                        <input type="text" placeholder="Title" name="title" id="title" class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->title }}" @endIf />
                                    </div>
                                </div>

                                <div class="col-md-4" id="descriptionDiv">
                                    <div class="form-group">
                                        <label for="productName">Description <span style="color:red">*</span></label>
                                        <input type="text"  placeholder="Description" name="description" id="description" class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->description }}" @endIf />
                                    </div>
                                </div>

                                




                                <div class="col-md-4" id="scheduledfromDiv">
                                    <div class="form-group">
                                        <label for="productName">From <span style="color:red">*</span></label>
                                        <input type="datetime-local" name="scheduledfrom" id="scheduledfrom"
                                            class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->scheduledfrom }}" @endIf />
                                    </div>
                                </div>


                                <div class="col-md-4" id="scheduledToDiv">
                                    <div class="form-group">
                                        <label for="productCategory">Till<span style="color:red">*</span></label>
                                        <input type="datetime-local" name="scheduledto" id="scheduledto"
                                            class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->scheduledto }}" @endIf />
                                    </div>
                                </div>

                               



                                <div class="col-md-4" id="imageTo">
                                    <div class="form-group">
                                        <label for="customFile" id="customfileLabel">Promotion Image (720 x 240)</label>

                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="customFile"
                                                >
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12" id="descriptionDivforAboutUS">
                                    <div class="form-group">
                                        <label for="productName">Description <span style="color:red">*</span></label>
                                            <textarea id="compose-textarea" name="descriptionforAboutUS" class="form-control" style="height: 300px">
                                                @if ($singleOffer != null) {{ $singleOffer->description }}@endIf
                                            </textarea>

                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="subCategory">Status <span style="color:red">*</span></label>
                                        <select class="form-control select2" id="status" name="status"
                                            style="width: 100%;" >
                                            <option value="-1" >----Select Status---</option>
                                            <option value="1" selected>Active</option>
                                            <option value="2">Deactive</option>

                                        </select>
                                    </div>
                                </div>



                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="row">
                        <div class="col-12">


                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Master Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="table21" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Scheduled From</th>
                                                <th>Scheduled To</th>
                                                <th>Status</th>
                                                <th>Image</th>
                                                <th>Edit</th>
                                                <th>Delete</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allBanners as $data)
                                                <tr>
                                                    <td>
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
                                                        @if ($data['category'] == 6)
                                                            About Us
                                                        @endif
                                                        
                                                    
                                                    </td>
                                                    <td>
                                                        @if($data['title'] == null)
                                                            No Title

                                                        @else
                                                            {{ $data['title'] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data['description'] == null)
                                                            No Description
                                                        @else
                                                            {{ $data['description'] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data['scheduledfrom'] == null)
                                                            No Scheduled From
                                                        @else
                                                            {{ $data['scheduledfrom'] }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data['scheduledto'] == null)
                                                            No Scheduled To
                                                        @else
                                                            {{ $data['scheduledto'] }}
                                                        @endif
                                                    </td>
                                                    @if ($data['status'] == '1')
                                                        <td>Active</td>
                                                    @endif
                                                    @if ($data['status'] == '2')
                                                        <td>Deactive</td>
                                                    @endif
                                                    <td class="text-center"><a href="{{ asset(urldecode($data['imageUrl'])) }}" target="_blank">Preview</a></td>

                                                    <td>
                                                        <form action="{{ route('edit-app-banner') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $data['id'] }}">
                                                            <button type="submit"
                                                                style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    text-decoration: none;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    border: none;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    background-color: transparent;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "
                                                                name="ViewDetails"><i class="fa fa-edit"
                                                                    aria-hidden="true"></i></button>
                                                        </form>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('delete-app-banner') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $data['id'] }}">

                                                            <button type="submit"
                                                                style="                                                                                                                                                                                                                                                                                                                                                                                                                          text-decoration: none;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            border: none;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            background-color: transparent;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        "
                                                                name="ViewDetails"><i class="fa fa-trash"
                                                                    aria-hidden="true"></i></button>
                                                        </form>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Category</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Scheduled From</th>
                                                <th>Scheduled To</th>
                                                <th>Status</th>
                                                <th>Image</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
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

        // document.addEventListener('DOMContentLoaded', function () {
        //     var selectElement = document.getElementById('category');
        //     if (selectElement) {
        //         var event = new Event('change');
        //         selectElement.dispatchEvent(event);
        //     }
        // });
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

    @if ($singleOffer != null)
        <script>
            $('#status').val({{ $singleOffer->status }});
        </script>
    @endif


    <script>

        $(document).ready(function() {
            $('#scheduledfromDiv').hide();
            $('#scheduledToDiv').hide();
            $('#descriptionDiv').hide();
            // $('#descriptionDivforAboutUS').hide();

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
                $('#customfileLabel').text('Image (1920px X 1280px)');
                $('#descriptionDivforAboutUS').hide();
                $('#titleDiv').show();
                $('#titleDivLabel').text('Title');
                $('#titleDivLabel input').attr('placeholder', 'Title');

            } 
            // Category 2 is for Popular Exams
            else if( category == 2) {
                $('#scheduledfromDiv').hide();
                $('#scheduledToDiv').hide();
                $('#descriptionDiv').hide();
                $('#imageTo').show();
                $('#titleDiv').show();

                $('#customfileLabel').text('Image (60px X 60px)');
                $('#descriptionDivforAboutUS').hide();
                $('#titleDivLabel').text('Title');
                $('#titleDivLabel input').attr('placeholder', 'Title');

            } 
            // Category 3 is for Student Testimonials
            else if( category == 3) {
                $('#scheduledfromDiv').hide();
                $('#scheduledToDiv').hide();
                $('#descriptionDiv').show();
                $('#imageTo').show();
                $('#titleDiv').show();

                $('#customfileLabel').text('Image (100px X 100px)');
                $('#titleDivLabel').text('Title');
                $('#titleDivLabel input').attr('placeholder', 'Title');
            } 
            // Category 4 is for App Banners
            else if( category == 4) {
                $('#scheduledfromDiv').show();
                $('#scheduledToDiv').show();
                $('#imageTo').show();
                $('#customfileLabel').text('Image (1920px X 1280px)');
                $('#descriptionDivforAboutUS').hide();
                $('#titleDiv').show();

            }
            // Category 5 is for Blog Category
            else if( category == 5) {
                $('#scheduledfromDiv').hide();
                $('#scheduledToDiv').hide();
                $('#descriptionDiv').hide();
                $('#imageTo').hide();
                $('#descriptionDivforAboutUS').hide();
                $('#titleDiv').show();

                $('#titleDivLabel').text('Title');
                $('#titleDivLabel input').attr('placeholder', 'Title');


            }

                // Category 6 is for About Us
            else if( category == 6) {
                $('#scheduledfromDiv').hide();
                $('#scheduledToDiv').hide();
                $('#descriptionDiv').hide();
                $('#imageTo').show();
                $('#customfileLabel').text('Image (960px X 640px)');
                $('#descriptionDivforAboutUS').show();
                $('#titleDiv').show();
                $('#titleDivLabel').text('Video URL');
                $('#titleDivLabel input').attr('placeholder', 'Video URL');
                


                
            }

            else {
                $('#scheduledfromDiv').hide();
                $('#scheduledToDiv').hide();
                $('#descriptionDiv').hide();
                $('#imageTo').hide();
                $('#descriptionDivforAboutUS').show();
                $('#titleDiv').show();
                $('#titleDivLabel').text('Title');
                $('#titleDivLabel input').attr('placeholder', 'Title');

            }

            // var event = new Event('change');
            // var selectElement = document.getElementById('category');
            // selectElement.dispatchEvent(event);
        }
        
    </script>
@endsection
