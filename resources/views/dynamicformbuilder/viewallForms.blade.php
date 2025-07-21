@extends('layouts.app')

@section('content')
    @include('layouts.adminMenu')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Forms</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">All Forms</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Saved Forms</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="formsTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Form Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($forms as $form)
                                        <tr>
                                            <td>{{ $form->id }}</td>
                                            <td>{{ $form->form_name }}</td>
                                            <td>
                                                <a href="{{ route('view-form', $form->id) }}" class="btn btn-info">Update</a>
                                                {{-- <a href="{{ route('edit-forms', $form->id) }}" class="btn btn-primary">Edit</a> --}}
                                                <a href="{{ route('delete-form', $form->id) }}" class="btn btn-danger">Delete</a>
                                                <!-- Add other actions if needed -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Include CSS for DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

<!-- Include JavaScript for DataTables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#formsTable').DataTable();
    });
</script>
@endsection
