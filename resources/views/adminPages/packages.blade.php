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


@if(session('message'))
    <div id="flash-message" style="position: fixed; top:10%; right:0; z-index: 9999" class="p-3" >
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
        </div>
    </div>


@endif
@if(session('error'))
    <div id="flash-message" style="position: fixed; top:10%; right:0; z-index: 9999" class="p-3" >
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    </div>
@endif
<script>
    setTimeout(function() {
        $('#flash-message').fadeOut('slow');
    }, 5000); // 5 seconds
</script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active">Add Packages</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">


                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">

                                <h3 class="card-title">
                                    @if ($selectSubCatId != null)
                                        Update Packages
                                    @else
                                        Add Packages
                                    @endif
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @if ($selectSubCatId == null)
                            <form role="form" action="/packages" method="post" enctype="multipart/form-data">
                                @else
                                    <form role="form" action="/edit-packages" method="post"
                                        enctype="multipart/form-data">

                                        <input type="hidden" name="id" value="{{ $selectSubCatId->id }}"></input>
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Package Code <span
                                                style="color: red;">*</span></label>
                                        <input type="text" min="0" class="form-control" placeholder="Package Code" 
                                            @if ($selectSubCatId != null) value="{{ $selectSubCatId->package_code }}"  @else value="{{$package_code}}" @endif
                                            name="package_code" readonly required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Package Title <span
                                                style="color: red;">*</span></label>
                                        <input type="text" min="0" class="form-control" placeholder="Package Title"
                                            @if ($selectSubCatId != null) value="{{ $selectSubCatId->package_name }}" @endif
                                            name="title" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Package Title <span
                                                style="color: red;">*</span></label>
                                        <input type="text" min="0" class="form-control" placeholder="Package Title"
                                            @if ($selectSubCatId != null) value="{{ $selectSubCatId->package_name }}" @endif
                                            name="title" required>
                                    </div>

                                    

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Packages Price <span
                                                style="color: red;">*</span></label>
                                        <input type="number" min="0" class="form-control" placeholder="Package Price"
                                            @if ($selectSubCatId != null) value="{{ $selectSubCatId->package_price }}" @endif
                                            name="package_price" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Packages Duration <span
                                                style="color: red;">*</span></label>
                                        <input type="number" min="0" class="form-control" placeholder="Number of days"
                                            @if ($selectSubCatId != null) value="{{ $selectSubCatId->package_duration }}" @endif
                                            name="package_duration" required>
                                    </div>


                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Status<span
                                                style="color: red;">*</span></label>
                                        <select class="form-control" name="status" required>
                                            <option value="1" @if ($selectSubCatId != null && $selectSubCatId->status == 1) selected @endif>Active</option>
                                            <option value="0" @if ($selectSubCatId != null && $selectSubCatId->status == 0) selected @endif>Inactive</option>
                                        </select>
                                    </div>


                                    <div class="form-group col-md-4">
                                        <label for="customFile">Select Package Thumbnail</label>

                                        <div class="custom-file">
                                        <input type="file" accept="image/*" name="image" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>


                                    <div class="col-md-12" id="blogDiv">
                                        <div class="form-group">
                                            <label for="package_description">Package Description<span style="color:red">*</span></label>
                                            <textarea id="compose-textarea" name="package_description" class="form-control" style="height: 300px">
                                                @if ($selectSubCatId != null) {{ $selectSubCatId->package_description }}@endIf
                                            </textarea>
                                        </div>
                                    </div>


                                </div>


                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="addImage">Submit</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Package List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="table21" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Duration</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Add Data</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @for ($i = 0; $i < count($allpackages); $i++)
                                            <tr>
                                                <td>{{ $allpackages[$i]['package_code'] }}</td>
                                                <td>{{ $allpackages[$i]['package_name'] }}</td>
                                                <td>{{ $allpackages[$i]['package_price'] }}</td>
                                                <td>{{ $allpackages[$i]['package_duration'] }}</td>
                                                <td>
                                                    @if ($allpackages[$i]['package_status'] == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                <td> <!-- HTML code to open image in modal -->
                                                <a href="{{ url($allpackages[$i]['package_image']) }}" target="_blank" >Preview</a>
                                                </td>

                                                <td>
                                                    <a href = "/add-package-data/{{ $allpackages[$i]['id'] }}" class="btn btn-primary btn-sm">Add Data</a>
                                                </td>
                                                <td>
                                                <a href="/edit-package/{{ $allpackages[$i]['id'] }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                        @if ($allpackages[$i]['package_status'] == 1)

                                                        <a href="/suspend-package/{{ $allpackages[$i]['id'] }}"
                                                        class="btn btn-danger btn-sm">Deactivate</a>
                                                        @else
                                                        <a href="/suspend-package/{{ $allpackages[$i]['id'] }}"
                                                        class="btn btn-success btn-sm">Activate</a>
                                                        @endif
                                                </td>


                                                @endfor

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Duration</th>
                                            <th>Status</th>
                                            <th>Image</th>
                                            <th>Add Data</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>


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



    <script>
        $(document).ready(function() {
            $('#table21').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [0, 'DESC'],
            });
        });
    </script>



    <!-- Summernote -->
    <script src="adminAsset/plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function() {
            //Add text editor
            $('#compose-textarea').summernote()
        })
    </script>



    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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

        function myFunction(id) {
            /* Get the text field */
            var copyText = document.getElementById("myInput" + id);

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            alert("Copied the text: " + copyText.value);
        }
    </script>

    @if ($selectSubCatId != null)
        <script>
            $('#ImageId').val({{ $selectSubCatId->ImageId }});
        </script>
    @endif
@endsection
