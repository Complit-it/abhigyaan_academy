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
                            <form role="form" action="/batch" method="post" enctype="multipart/form-data">
                                @else
                                    <form role="form" action="/edit-batch" method="post"
                                        enctype="multipart/form-data">

                                        <input type="hidden" name="id" value="{{ $selectSubCatId->id }}"></input>
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Batch Id <span
                                                style="color: red;">*</span></label>
                                        <input type="text" min="0" class="form-control" placeholder="Batch Id" 
                                            @if ($selectSubCatId != null) value="{{ $selectSubCatId->batchId }}"  @else value="{{$batchId}}" @endif
                                            name="batchId" readonly required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Batch Name <span
                                                style="color: red;">*</span></label>
                                        <input type="text" min="0" class="form-control" placeholder="Batch Name"
                                            @if ($selectSubCatId != null) value="{{ $selectSubCatId->batchName }}" @endif
                                            name="batchName" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Start Date <span
                                                style="color: red;">*</span></label>
                                        <input type="date" min="0" class="form-control" placeholder="Start Date"
                                            @if ($selectSubCatId != null) value="{{ $selectSubCatId->startDate }}" @endif
                                            name="startDate" required>
                                    </div>

                                    

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">End Date <span
                                                style="color: red;">*</span></label>
                                        <input type="date" min="0" class="form-control" placeholder="End Date"
                                            @if ($selectSubCatId != null) value="{{ $selectSubCatId->endDate }}" @endif
                                            name="endDate" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Packages<span style="color: red;">*</span></label>
                                        <select multiple class="form-control select2" name="packages[]" required>
                                            <option value="-1">---Select Packages---</option>
                                            @foreach($allpackages as $package)
                                                <option value="{{$package->id}}"  
                                                    @if ($selectSubCatId != null && is_array($selectSubCatId->packages))
                                                    @if(in_array((int)$package->id, $selectSubCatId->packages))
                                                        selected
                                                    @endif
                                                @endif
                                                

>{{$package->package_name}}</option>
                                            @endforeach
                                        </select>
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
                                            <th>Start From</th>
                                            <th>Courses</th>
                                            <th>View Students</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($batches as $batch)
                                        <tr>
                                            <td>{{$batch->batchId}}</td>
                                            <td>{{$batch->batchName}}</td>
                                            <td>{{$batch->startDate}}</td>
                                            <td>
                                                @foreach($batch->courses as $course)
                                                    <span class="badge badge-success">{{$course->package_name}}</span>
                                                @endforeach
                                            </td>

                                            <td>
                                                <a href="/view-batch-students/{{ $batch->id }}"
                                                        class="btn btn-info btn-sm">View Students</a>
                                            </td>

                                            <td>
                                                <a href="/edit-batch/{{ $batch->id }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                            </td>
                                        </tr>

                                        @endforeach

                                      

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Start From</th>
                                            <th>Courses</th>
                                            <th>View Students</th>
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
