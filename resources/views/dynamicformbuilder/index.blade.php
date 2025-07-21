@extends('layouts.app')

@section('content')
    @include('layouts.adminMenu')

    <style>
        .frmb-1723674161358-save-action {
            display: none;
        }

        .setDataWrap {
            margin-bottom: 20px;
        }

        .my-box {
            display: -ms-flexbox !important;
            display: flex !important;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
        }
    </style>

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

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Form Builder Section -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Dynamic Form Builder</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group col-md-12  d-flex row flex-direction-center my-box">
                                    <label for="formName">Input form name here:</label>
                                    <input type="text" id="formName" name="formName" placeholder="Form Name" value="@if(isset($form)) {{$form->form_name}} @endif" required>
                                    <button id="getJSON" type="button" class="btn btn-primary">Save Form</button>
                                </div>
                                <div id="build-wrap"></div>
                            </div>
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

    <!-- Include CSS for DataTables and FormBuilder -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.css">
    <link rel="stylesheet" href="https://formbuilder.online/assets/css/form-builder.min.css">

    <!-- Include JavaScript for DataTables, FormBuilder, and React -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.js"></script>

    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        jQuery(function($) {
            var fbEditor = document.getElementById('build-wrap');
            var formBuilder = $(fbEditor).formBuilder();     

            document.getElementById('getJSON').addEventListener('click', function() {
                var formName = document.getElementById('formName').value;
                var formData = formBuilder.actions.getData('json');

                $.ajax({
                    url: "{{ route('dynamic-form-builder') }}",
                    type: "POST",
                    data: {
                        formName: formName,
                        formData: formData,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status == 'error') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Form Saved',
                                text: 'Form has been saved successfully'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
