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
                            <li class="breadcrumb-item active">Add Vehicle Model</li>
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
                                        Update Vehicle Model
                                    @else
                                        Add Vehicle Model
                                    @endif
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @if ($selectSubCatId == null)
                            <form role="form" action="/brand-category-mapping" method="post" enctype="multipart/form-data">
                                @else
                                    <form role="form" action="/edit-brand-category-mapping" method="post"
                                        enctype="multipart/form-data">

                                        <input type="hidden" name="id" value="{{ $selectSubCatId->id }}"></input>
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="brandId">Select Brand <span style="color:red">*</span></label>
                                            <select class="form-control select2" id="brandId" name="brandId" style="width: 100%;">
                                                <option value="-1">----Select Brand---</option>
                                                @foreach ($allBrands as $brand)
                                                    <option value="{{ $brand->id }}" {{ $brand->id == $brandId? 'selected' : '' }}>
                                                      {{ $brand->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categoryId">Select Category <span style="color:red">*</span></label>
                                            <select class="form-control select2" id="categoryId" name="categoryId[]" multiple style="width: 100%;">
                                                <option value="-1">----Select Category---</option>
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
                            <button type="submit" class="btn btn-primary" name="addSubCategory">Submit</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Vehicle Model List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="table21" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <th>Id</th>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allMappings as $subCategory)
                                            <tr>
                                                <td>{{ $subCategory->id }}</td>
                                                <td>{{ $subCategory->brandName }}</td>
                                                <td>{{ $subCategory->categoryName }}</td>
                                                <td>
                                                    {{-- <a href="/brand-category-mapping/{{ $subCategory->id }}/edit" class="btn btn-primary">Edit</a> --}}
                                                    <a href="/brand-category-mapping/{{ $subCategory->id }}/delete" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach


                                     

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Brand</th>
                                            <th>Category</th>
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
    </script>

    @if ($selectSubCatId != null)
        <script>
            $('#categoryId').val({{ $selectSubCatId->categoryId }});
            $('#brandId').val({{ $selectSubCatId->brandId }});
        </script>
    @endif
@endsection
