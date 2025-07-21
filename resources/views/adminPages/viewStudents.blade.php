@extends('layouts.app')

@section('content')
    @include('layouts.adminMenu')

    <!-- Modal for Batch Selection -->
    <div class="modal fade" id="batchModal" tabindex="-1" aria-labelledby="batchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="batchModalLabel">Select Batch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="batchForm">
                        <div class="form-group">
                            <label for="batchSelect">Select Batch:</label>
                            <select class="form-control select2" id="batchSelect" name="batch_id">
                                <!-- Options for batches will be populated here -->

                                @foreach ($allBatch as $batch)
                                    <option value={{$batch->batchId}}>{{$batch->batchName}}</option>

                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addToBatchBtn">Add to Batch</button>
                </div>
            </div>
        </div>
    </div>

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
                                <h3 class="card-title">All Students</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form id="studentForm">
                                    @csrf
                                    <table id="table21" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Select</th>
                                                <th>Student Id</th>
                                                <th>Student Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Fathers Name</th>
                                                <th>Fathers Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allStudents as $student)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="selected_students[]" value="{{$student->id}}">
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
                                                <th>Select</th>
                                                <th>Student Id</th>
                                                <th>Student Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Fathers Name</th>
                                                <th>Fathers Phone</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <button type="button" class="btn btn-primary" id="openBatchModalBtn">Add to Batch</button>
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
                order: [1,'ASC'],
            });

            // Open Batch Selection Modal
            $('#openBatchModalBtn').on('click', function() {
                $('#batchModal').modal('show');
                // You may load batch options via AJAX here
            });

            // Add selected students to batch
            $('#addToBatchBtn').on('click', function() {
                var selectedStudents = $('input[name="selected_students[]"]:checked').map(function(){
                    return $(this).val();
                }).get();

                console.log(selectedStudents);

                var batchId = $('#batchSelect').val();

                // Send data to the server via AJAX
                $.ajax({
                    url: '/api/add_students_to_batch',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'batch_id': batchId,
                        'selected_students': selectedStudents
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        var responseObj = JSON.parse(response);

                        if (responseObj.status === 'success') {
                            alert('Student Added successfully');
                            $('#batchModal').modal('hide');

                        }

                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
