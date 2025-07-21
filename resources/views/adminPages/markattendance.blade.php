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
        <div id="flash-message" style="position: fixed; top:10%; right:0; z-index: 9999" class="p-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div id="flash-message" style="position: fixed; top:10%; right:0; z-index: 9999" class="p-3">
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Users for the Batch <span class="btn btn-success">{{$batch->batchName}}</span></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="/mark-attendance" method="POST">
                                    @csrf
                                    <input type="hidden" name="batchId" value="{{$batch->id}}">
                                    <div class="group d-flex" style="align-items:center;">
                                        <div class="form-group col-md-4">
                                            <label for="courses">Courses</label>

                                            <select class="form-control select2" id="courseId" name="courseId" style="width: 100%;" >
                                                <option value="-1">----Select Course---</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}" @if($selectSubCatId != null) @if($selectSubCatId->id == $course->id) @echo selected @endif @endif>
                                                        {{ $course->package_name }}
                                                    </option>
                                                @endforeach
                                            </select>


                                            {{-- <select name="courseId" id="courses" class="form-control select2">
                                                @foreach($courses as $course)
                                                    <option value="{{$course->id}}">{{$course->package_name}}</option>
                                                @endforeach
                                            </select> --}}
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="batch_id">Attendance for Date</label>
                                            <input type="date" id="attendance-date" name="date" class="form-control">
                                        </div>

                                        <div class="from-group col-md-4">
                                            <button type="submit" class="btn btn-primary mt-3">Mark Attendance</button>
                                        </div>
                                    </div>

                                    <table id="table21" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th> Select All <input type="checkbox" id="select-all"></th>

                                                <th>Student Id</th>
                                                <th>Student Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Fathers Name</th>
                                                <th>Fathers Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allBatchStudents as $student)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="selected_students[]" value="{{$student->id}}" class="student-checkbox">
                                                    </td>
                                                    <td>{{$student->id}}</td>
                                                    <td>{{$student->name}}</td>
                                                    <td>{{$student->phone}}</td>
                                                    <td>{{$student->email}}</td>
                                                    <td>{{$student->fathersname}}</td>
                                                    <td>{{$student->fathersphone}}</td>
                                                   
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Select All<input type="checkbox" id="select-all-footer"></th>

                                                <th>Student Id</th>
                                                <th>Student Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Fathers Name</th>
                                                <th>Fathers Phone</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <button type="submit" class="btn btn-primary mt-3">Mark Attendance</button>
                                </form>
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
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
                order: [4,'DESC'],
                responsive: true,
                pageLength: 100
            });

            // Select/Deselect all checkboxes
            $('#select-all, #select-all-footer').on('click', function() {
                var isChecked = $(this).is(':checked');
                $('.student-checkbox').prop('checked', isChecked);
                $('#select-all').prop('checked', isChecked);
                $('#select-all-footer').prop('checked', isChecked);
            });

            // Sync header and footer select all checkboxes
            $('.student-checkbox').on('click', function() {
                var totalCheckboxes = $('.student-checkbox').length;
                var checkedCheckboxes = $('.student-checkbox:checked').length;
                var isChecked = totalCheckboxes === checkedCheckboxes;
                $('#select-all').prop('checked', isChecked);
                $('#select-all-footer').prop('checked', isChecked);
            });


            var today = new Date().toISOString().split('T')[0];
            document.getElementById('attendance-date').value = today;
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
