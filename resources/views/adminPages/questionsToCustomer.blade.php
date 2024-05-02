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
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Add Problem Questions</li>
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
                                    @if ($selectCatId != null)
                                        Update Problem Questions
                                    @else
                                        Add Problem Questions
                                    @endif
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @if ($selectCatId == null)
                                <form role="form" action="/problem-questionaire" method="post" enctype="multipart/form-data">
                                @else
                                    <form role="form" action="/edit-problem-questionaire" method="post"
                                        enctype="multipart/form-data">

                                        <input type="hidden" name="id" value="{{ $selectCatId->id }}"></input>
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="row">




                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Problem Questions <span
                                                style="color: red;">*</span></label>
                                        <input type="text" min="0" class="form-control" placeholder="Question"
                                            @if ($selectCatId != null) value="{{ $selectCatId->question }}" @endif
                                            name="question" required>
                                    </div>

                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="customFile">Photo (270 x 220)</label>

                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image" id="customFile"
                                                    required>
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categoryId">Problem Category<span style="color:red">*</span></label>
                                            <select class="form-control select2" id="serviceId" multiple name="problemCategory[]" style="width: 100%;">
                                                @foreach ($allcategories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $editId ? 'selected' : '' }}>
                                                  {{ $category->name }}
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>



                                </div>




                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="addCategory">Submit</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Problem Questions List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="table21" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Problem Questions</th>
                                            <th>Preliminary Problem Questions</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allQuestions as $service)
                                            <tr>
                                                <td>{{ $service->id }}</td>
                                                <td>{{ $service->question }}</td>
                                                <td>
                                                    {{ $service->category }}
                                                </td>
                                                <td>
                                                    <a href="/delete-question/{{ $service->id }}" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        



                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Problem Questions</th>
                                            <th>Preliminary Problem Questions</th>
                                            <th>Edit</th>
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

    <script src="adminAsset/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
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
    </script>
@endsection
