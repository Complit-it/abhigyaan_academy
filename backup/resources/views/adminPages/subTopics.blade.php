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
                            <li class="breadcrumb-item active">Add Topics</li>
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
                                        Update Topics
                                    @else
                                        Add Topics
                                    @endif
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @if ($selectSubCatId == null)
                            <form role="form" action="/sub-topics" method="post" enctype="multipart/form-data">
                                @else
                                    <form role="form" action="/edit-sub-topic" method="post"
                                        enctype="multipart/form-data">

                                        <input type="hidden" name="id" value="{{ $selectSubCatId->id }}"></input>
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="subject_id">Select Subject <span style="color:red">*</span></label>
                                            <select class="form-control select2" id="subject_id" name="subject_id" style="width: 100%;" onchange="getTopic(this);">
                                                <option value="-1">----Select Subject---</option>
                                                @foreach ($allSubjects as $subject)
                                                    <option value="{{ $subject->id }}" @if($selectSubCatId != null) @if($selectSubCatId->subject_id == $subject->id) @echo selected @endif @endif>
                                                        {{ $subject->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="topic_id">Select Topic <span style="color:red">*</span></label>
                                            <select class="form-control select2" id="topic_id" name="topic_id" style="width: 100%;">
                                                <option value="-1">----Select Topic---</option>
                                                @if ($selectSubCatId != null)
                                                    @foreach ($allTopics as $topic)
                                                        <option value="{{ $topic->id }}" @if($selectSubCatId->topic_id == $topic->id) @echo selected @endif>
                                                            {{ $topic->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Topic Name <span
                                                style="color: red;">*</span></label>
                                        <input type="text" min="0" class="form-control" placeholder="Name"
                                            @if ($selectSubCatId != null) value="{{ $selectSubCatId->name }}" @endif
                                            name="name" required>
                                    </div>


                                    <div class="form-group col-md-4">
                                        <label for="customFile">Select Topic Image</label>

                                        <div class="custom-file">
                                        <input type="file" accept="image/*" name="image" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>


                                </div>


                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="addTopics">Submit</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Topic List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="table21" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <th>Id</th>
                                        <th>Subject</th>
                                        <th>Topic</th>
                                        <th>Sub Topic</th>
                                        <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @for ($i = 0; $i < count($allSubTopics); $i++)
                                            <tr>
                                                <td>{{ $allSubTopics[$i]['id'] }}</td>
                                                <td>{{ $allSubTopics[$i]['subject_name'] }}</td>
                                                <td>{{ $allSubTopics[$i]['topic_name'] }}</td>
                                                <td>{{ $allSubTopics[$i]['name'] }}</td>
                                                <td> <!-- HTML code to open image in modal -->
<a href="{{ url($allSubTopics[$i]['icon_url']) }}" target="_blank" >Preview</a>
</td>
                                                <td>
                                                <a href="/edit-sub-topic/{{ $allSubTopics[$i]['id'] }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="/delete-sub-topic/{{ $allSubTopics[$i]['id'] }}"
                                                        class="btn btn-danger btn-sm">Delete</a>
                                                </td>

                                                </td>
                                        @endfor

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Subject</th>
                                            <th>Topic</th>
                                            <th>Sub Topic</th>                                           
                                             <th>Image</th>
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




    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


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
    
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.js"></script>
    
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">

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



<script>
    function getTopic(e) {
        var subject_id = e.value;
    
        $.ajax({
            url: '/api/get-topic',
            type: 'POST',
            data: {
                subject_id: subject_id,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                console.log(data);
                // Clear existing options
                $('#topic_id').empty();
    
                // Append new options
                $('#topic_id').append($('<option>', {
                    value: -1,
                    text: '----Select Topic---'
                }));
                $.each(data, function(index, topic) {
                    $('#topic_id').append($('<option>', {
                        value: topic.id,
                        text: topic.name
                    }));
                });
            }
        });
    }
    </script>
    


    @if ($selectSubCatId != null)
        <script>
            $('#TopicsId').val({{ $selectSubCatId->TopicsId }});
        </script>
    @endif
@endsection
