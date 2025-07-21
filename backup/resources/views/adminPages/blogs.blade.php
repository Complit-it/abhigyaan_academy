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
                backgroundColor: 'green', // Example background color
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
                            <h3 class="card-title">Add Blogs</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if ($singleOffer == null)
                            <form role="form" id="addOffers"
                                action={{ route('add-blogs') }} method="post" enctype="multipart/form-data">
                        @endif
                        @if ($singleOffer != null)
                            <form role="form" id="edit-blog"
                                action={{ route('edit-blog') }} method="post" enctype="multipart/form-data">
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
                                            style="width: 100%;">
                                            <option value="-1" selected>----Select Category---</option>
                                            @foreach ($allCategories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($singleOffer != null && $singleOffer->category == $category->id) selected @endIf>
                                                    {{ $category->title }}</option>
                                            @endforeach                                    
                                            
                                        </select>
                                    </div>
                                </div>



                                <div class="col-md-4" id="titleDiv">
                                    <div class="form-group">
                                        <label for="productName">Title <span style="color:red">*</span></label>
                                        <input type="text" placeholder="Title" name="title" id="title" class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->title }}" @endIf />
                                    </div>
                                </div>

                                <div class="col-md-4" id="titleDiv">
                                    <div class="form-group">
                                        <label for="productName">Slug <span style="color:red">*</span></label>
                                        <input type="text" placeholder="Slug" name="slug" id="slug" class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->slug }}" @endIf />
                                    </div>
                                </div>

                                <div class="col-md-4" id="scheduledfromDiv">
                                    <div class="form-group">
                                        <label for="productName">Schedule Publish <span style="color:red">*</span></label>
                                        <input type="datetime-local" name="scheduledfrom" id="scheduledfrom"
                                            class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->scheduledfrom }}" @endIf />
                                    </div>
                                </div>



                                <div class="col-md-4" id="imageTo">
                                    <div class="form-group">
                                        <label for="customFile" id="customfileLabel">Featured Image (900 x 600)</label>

                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="customFile"
                                                >
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12" id="blogDiv">
                                    <div class="form-group">
                                        <label for="productName">Draft Your Blog <span style="color:red">*</span></label>
                                        <textarea id="compose-textarea" name="actual_blog" class="form-control" style="height: 300px">
                                            @if ($singleOffer != null) {{ $singleOffer->actual_blog }}@endIf
                                        </textarea>
                                    </div>
                                </div>


                                

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="subCategory">Status <span style="color:red">*</span></label>
                                        <select class="form-control select2" id="status" name="status"
                                            style="width: 100%;" >
                                            <option value="-1" >----Select Status---</option>
                                            <option value="1" selected>Draft</option>
                                            <option value="2">Publish Now</option>

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
                                    <h3 class="card-title">Blog List</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="table21" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Title</th>
                                                <th>Publishing Date</th>
                                                <th>Featured Image</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allBlogs as $blog)
                                                <tr>
                                                    <td>{{$blog->category_name}}</td>
                                                    <td>{{$blog->title}}</td>
                                                    <td>{{$blog->published_on}}</td>
                                                    <td><a href="/{{$blog->featured_image}}" target="_blank">Preview</a></td>
                                                    <td>@if($blog->status == 1)
                                                        Draft
                                                        @endif
                                                        @if($blog->status == 2)
                                                        Published
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{-- <a href="/brand-category-mapping/{{ $subCategory->id }}/edit" class="btn btn-primary">Edit</a> --}}
                                                        <a href="/edit-blog/{{ $blog->id }}" class="btn btn-info">Edit</a>

                                                    </td>


                                                </tr>
                                                @endforeach
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Category</th>
                                                <th>Title</th>
                                                <th>Publishing Date</th>
                                                <th>Featured Image</th>
                                                <th>Status</th>
                                                <th>Edit</th>
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

    @if ($singleOffer != null)
        <script>
            $('#status').val({{ $singleOffer->status }});
        </script>
    @endif


    <script>

        $(document).ready(function() {
            $('#title').change(function() {
                getSlug(this);
            });
        });

        function getSlug(element) {
            var title = $(element).val();
            var slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            checkforunique(slug);
            $('#slug').val(slug);
        }

        function checkforunique(slug) {
            $.ajax({
                url: "{{ route('check-slug') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    slug: slug
                },
                success: function(response) {
                    if (response == 'true') {
                        $('#slug').css('border', '1px solid red');
                    } else {
                        $('#slug').css('border', '1px solid green');
                        //also add a message that slug is not unique below the input 
                    }
                }
            });
        }




       
        
    </script>


<script>
    // Get the current date and time in the format required for datetime-local input
    function getCurrentDateTime() {
        const now = new Date();
        const year = now.getFullYear();
        const month = (now.getMonth() + 1).toString().padStart(2, '0'); // Months are zero-based
        const day = now.getDate().toString().padStart(2, '0');
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const datetime = `${year}-${month}-${day}T${hours}:${minutes}`;
        return datetime;
    }

    // Set the current date and time in the input field with id "scheduledfrom"
    document.getElementById("scheduledfrom").value = getCurrentDateTime();
</script>

@endsection
