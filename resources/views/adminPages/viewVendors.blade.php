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
                                <h3 class="card-title">All Users</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="table21" class="table table-bordered table-striped">
                                <thead>
                  <tr>

                    <th>Vendor Code</th>
                    <th>Personal Details</th>
                    <th>Bank Details</th>
                    <th>Working Brands</th>
                    <th>Working Category</th>
                    <th>Working Service</th>
                    {{-- <th>Prefered Area</th> --}}
                    <th>Action</th>



                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($workers as $worker)
                    <tr>
                        <td> {{$worker['vendor_code']}}</td>
                        <td>
                            <b>Name : </b>{{$worker['name']}} <br/>
                            <b>Phone : </b> {{$worker['phone']}} <br/>
                            <b>Email : </b> {{$worker['email']}} <br/>
                            <b>PAN : </b> {{$worker['pan_no']}} <br/>
                            <b>Adhar : </b> {{$worker['adhar_no']}} <br/>
                            <b>Address : </b> {{ $worker['address_proof']}} <br/>
                        </td>
                        <td>
                            <b>Bank Name : </b> {{$worker['bank_name']}} <br/>
                            <b>Account Number : </b> {{$worker['bank_account_no']}} <br/>
                            <b>IFSC Code : </b> {{$worker['bank_ifsc_code']}} <br/>
                            <b>Branch : </b> {{$worker['bank_branch']}} <br/>
                            <b>GST : </b> {{$worker['gst_no']}} <br/>


                        </td>
                        <td>
                            @foreach($worker['working_brand'] as $key => $brand)
                                @if ($key == 0)
                                    {{$brand['name']}}
                                @else
                                    , {{$brand['name']}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($worker['working_category'] as $key => $category)
                                @if ($key == 0)
                                    {{$category['name']}}
                                @else
                                    , {{$category['name']}}
                                @endif
                            @endforeach
                        </td>
                        <td> 
                            @foreach($worker['services'] as $key => $services)
                                @if ($key == 0)
                                    {{$services['name']}}
                                @else
                                , {{$key}}
                                @endif
                            @endforeach
                        </td>
                        {{-- <td>
                            @foreach($worker['prefered_area'] as $key => $area)
                                @if ($key == 0)
                                    {{$area['area']}}
                                @else
                                    , {{$area['area']}}
                                @endif
                            @endforeach
                        </td> --}}
                        <td>
                            @if($worker['vendor_status'] == 1)<a href="suspend-vendor/{{$worker['id']}}" class="btn btn-primary">Suspend</a>
                            @else <a href="revive-vendor/{{$worker['id']}}" class="btn btn-danger">Revive</a>
                            @endif

                        </td>
                    </tr>
                  @endforeach
                  </tbody>
                                    <tfoot>

                                    </tfoot>
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


    <link rel="stylesheet" href=" https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css"/>

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
                order: [4, 'DESC'],
                responsive: true // Add responsive option
            });
        });
    </script>
@endsection
