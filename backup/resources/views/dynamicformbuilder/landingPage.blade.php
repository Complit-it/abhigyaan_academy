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


<!-- Include Toastify CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<!-- Include Toastify JS -->
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('message'))
            Toastify({
                text: "{{ session('message') }}",
                duration: 3000,  // Adjust the duration as needed (in milliseconds)
                position: 'right',
                gravity: 'auto',
                backgroundColor: 'green', // Example background color
                close: true,
            }).showToast();
        @endif
    });
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

        <section class="content">
            @if ($errors->count())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Landing Page Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if ($singleOffer == null)
                            <form role="form" id="addOffers" onsubmit="return submitForm()"
                                action={{ route('landing-page') }} method="post" enctype="multipart/form-data">
                        @endif
                        @if ($singleOffer != null)
                            <form role="form" id="edit-app-banner" onsubmit="return submitForm()"
                                action={{ route('edit-landing-page-post') }} method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id" class="form-control col-md-12"
                                    value="{{ $singleOffer->id }}" readonly />
                        @endif

                        <input name="_token" type="hidden" value="{{ csrf_token() }}" />

                        <div class="card-body">
                            <div class="row">

                               

                                <div class="col-md-12">

                                    <div class="form-group">
                                        <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#allSectionsModal">
                                            Manage Sections
                                        </button>
                                    </div>


                                    <div class="form-group">
                                        <label for="productName">Select Section</label>
                                        <select class="form-control select2" id="category" name="category" 
                                            style="width: 100%;" onchange="getFields(this);">
                                            <option value="-1" selected>----Select Section---</option>
                                            @foreach ($enableSections as $mysection)
                                                <option value="{{ $mysection->id }}"
                                                    @if ($singleOffer != null) @if ($mysection->id == $singleOffer->section_id) selected @endif @endIf>
                                                    {{ $mysection->name }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>

                                </div>



                                <div class="col-md-4" id="titleDiv">
                                    <div class="form-group">
                                        <label for="titleDivLabel" id="titleDivLabel">Title <span style="color:red">*</span></label>
                                        <input type="text" placeholder="Your Input" name="title" id="title" class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->title }}" @endIf />
                                    </div>
                                </div>

                                <div class="col-md-4" id="descriptionDiv">
                                    <div class="form-group">
                                        <label for="productName" id="descriptionLabel">Description <span style="color:red">*</span></label>
                                        <input type="text"  placeholder="Your Input" name="description" id="description" class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->description }}" @endIf />
                                    </div>
                                </div>

                                




                                <div class="col-md-4" id="scheduledfromDiv">
                                    <div class="form-group">
                                        <label for="productName">From <span style="color:red">*</span></label>
                                        <input type="datetime-local" name="scheduledfrom" id="scheduledfrom"
                                            class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->scheduledfrom }}" @endIf />
                                    </div>
                                </div>


                                <div class="col-md-4" id="scheduledToDiv">
                                    <div class="form-group">
                                        <label for="productCategory">Till<span style="color:red">*</span></label>
                                        <input type="datetime-local" name="scheduledto" id="scheduledto"
                                            class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->scheduledto }}" @endIf />
                                    </div>
                                </div>

                               



                                <div class="col-md-4" id="imageTo">
                                    <div class="form-group">
                                        <label for="customFile" id="customfileLabel">Image (720 x 240)</label>

                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="customFile"
                                                >
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4" id="videoLinkDiv">
                                    <div class="form-group">
                                        <label for="videoLink" id="videoLinkLabel">Video Link <span style="color:red">*</span></label>
                                        <input type="text" placeholder="Your Input" name="video_link" id="videoLink" class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->video_link }}" @endIf />
                                    </div>
                                </div>


                                <div class="col-md-4" id="navigationLinkDiv">
                                    <div class="form-group">
                                        <label for="navigationLink" id="navigationLinkLabel">Navigation Link <span style="color:red">*</span></label>
                                        <input type="text" placeholder="Your Input" name="navigationLink" id="navigationLink" class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->navigation_link }}" @endIf />
                                    </div>
                                </div>


                                <div class="col-md-4" id="imageTitleDiv">
                                    <div class="form-group">
                                        <label for="imageTitle" id="imageTitleLabel"> Image Title <span style="color:red">*</span></label>
                                        <input type="text" placeholder="Image Title" name="imageTitle" id="imageTitle" class="form-control col-md-12"
                                            @if ($singleOffer != null) value="{{ $singleOffer->image_alt_text }}" @endIf />
                                    </div>
                                </div>


                                <div class="col-md-12" id="descriptionDivforAboutUS">
                                    <div class="form-group">
                                        <label for="productName" id="descriptionLabeltextArea">Description <span style="color:red">*</span></label>
                                            <textarea id="compose-textarea" name="descriptionforAboutUS" class="form-control" style="height: 300px">
                                                @if ($singleOffer != null) {{ $singleOffer->content }}@endIf
                                            </textarea>

                                    </div>
                                </div>


                                <div class="col-md-4" id="statusDiv">
                                    <div class="form-group">
                                        <label for="subCategory">Status <span style="color:red">*</span></label>
                                        <select class="form-control select2" id="status" name="status"
                                            style="width: 100%;" >
                                            <option value="-1" >----Select Status---</option>
                                            <option value="1" selected>Active</option>
                                            <option value="2">Deactive</option>
                                        </select>
                                    </div>
                                </div>


                                
                                <div class="col-md-12" id="p-info-container">
                                    <div class="form-group">
                                        <p id="p-info"></p>
                                    </div>
                                </div>





                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="row">
                        <div class="col-12">


                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Master Data</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" id="tab-container">
                                    Select a section to view the data.
                                   
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Modal for All Sections -->
<div class="modal fade" id="allSectionsModal" tabindex="-1" role="dialog" aria-labelledby="allSectionsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="allSectionsModalLabel">Manage Sections</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sectionsForm">
                    <ul class="list-group">
                        @foreach($sections as $section)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="section-details">
                                    <input type="text" name="name[{{ $section->id }}]" value="{{ $section->name }}" class="form-control form-control-sm section-name" @if($section->id == 1 || $section->id == 11) readonly @endif>
                                    <input type="text" name="subheader[{{ $section->id }}]" value="{{ $section->sub_header }}" class="form-control form-control-sm section-subheader" placeholder="Sub Heading">

                                    <!-- Readonly and Up/Down control for order input -->
                                    <input type="number" name="order[{{ $section->id }}]" value="{{ $section->order }}" 
                                           class="form-control form-control-sm section-order" 
                                           min="2" max="10" 
                                           @if($section->id == 1 || $section->id == 11) readonly @endif>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" id="section{{ $section->id }}" name="sections[]" value="{{ $section->id }}"
                                        @if($section->is_active == '1') checked @endif>
                                    <span class="slider round"></span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitSections()">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS for modal functionality -->
<script>

    //  // JavaScript to control the order input field
    //  document.querySelectorAll('.section-order').forEach(function(orderInput) {
    //     orderInput.addEventListener('keydown', function(e) {
    //         e.preventDefault(); // Prevent typing
    //     });

    //     orderInput.addEventListener('wheel', function(e) {
    //         e.preventDefault(); // Prevent scrolling to change the value
    //     });
    // });


   function submitSections() {
    const form = document.getElementById('sectionsForm');
    
    // Capture selected sections and their orders
    const selectedSections = Array.from(form.elements['sections[]'])
        .filter(checkbox => checkbox.checked)
        .map(checkbox => checkbox.value);

    const orders = {};
    const names = {};
    const subheaders = {};
    
    Array.from(form.elements)
        .filter(element => element.name.startsWith('order['))
        .forEach(element => {
            const sectionId = element.name.match(/\d+/)[0];
            orders[sectionId] = element.value;
        });

    Array.from(form.elements)
        .filter(element => element.name.startsWith('name['))
        .forEach(element => {
            const sectionId = element.name.match(/\d+/)[0];
            names[sectionId] = element.value;
        });

    Array.from(form.elements)
        .filter(element => element.name.startsWith('subheader['))
        .forEach(element => {
            const sectionId = element.name.match(/\d+/)[0];
            subheaders[sectionId] = element.value;
        });

    $.ajax({
        url: '{{ route("update.sections") }}', // Route to handle the update
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}', // CSRF token for security
            sections: selectedSections,
            order: orders,
            name: names,
            subheader: subheaders
        },
        success: function(response) {
            // Handle success response
            console.log('Sections updated successfully:', response);
            // Optionally, you can show a success message to the user
            Toastify({
                text: "Sections updated successfully!",
                duration: 3000,
                position: 'right',
                gravity: 'auto',
                backgroundColor: 'green',
                close: true,
            }).showToast();
            $('#allSectionsModal').modal('hide'); // Close the modal
        },
        error: function(xhr) {
            // Handle error response
            console.log('Error updating sections:', xhr.responseText);
            // Optionally, you can show an error message to the user
            Toastify({
                text: "An error occurred while updating sections.",
                duration: 3000,
                position: 'right',
                gravity: 'auto',
                backgroundColor: 'red',
                close: true,
            }).showToast();
        }
    });
}

</script>


<!-- Toggle switch CSS -->
<style>

.section-details {
    display: flex;
    flex-direction: column;
    width: 80%;
}

.section-name, .section-subheader {
    margin-bottom: 5px;
    width: 100%;
}

.section-order {
    width: 60px;
}

.switch {
    margin-left: auto;
}


.order-input {
        width: 60px; /* Width of the order input */
        margin-right: 10px; /* Space between input and toggle switch */
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .list-group-item .switch {
        margin-left: auto;
    }

    .d-flex.align-items-center {
        display: flex;
        align-items: center;
    }

    
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 14px;
        width: 14px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:checked + .slider:before {
        transform: translateX(20px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    #p-info {
        color: red;
        text-align: center;
    }
</style>


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

    <!-- Summernote -->
    <script src="adminAsset/plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function() {
            //Add text editor
            $('#compose-textarea').summernote()
        })
    </script>



    <link rel="stylesheet" href="{{ asset('adminAsset/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminAsset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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

        // document.addEventListener('DOMContentLoaded', function () {
        //     var selectElement = document.getElementById('category');
        //     if (selectElement) {
        //         var event = new Event('change');
        //         selectElement.dispatchEvent(event);
        //     }
        // });
    </script>

    <script>
        $(document).ready(function() {
            $('#table21').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [4, 'DESC'],
            });
        });
    </script>


    <script src="adminAsset/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

    @if ($singleOffer != null)
        <script>
            $('#status').val({{ $singleOffer->status }});
        </script>
    @endif

    <script>

        onload = function() {
            document.getElementById('p-info').innerText = 'Please select a section.';
                document.getElementById('titleDiv').style.display = 'none';
                document.getElementById('descriptionDiv').style.display = 'none';
                document.getElementById('scheduledfromDiv').style.display = 'none';
                document.getElementById('scheduledToDiv').style.display = 'none';
                document.getElementById('imageTo').style.display = 'none';
                document.getElementById('descriptionDivforAboutUS').style.display = 'none';
                document.getElementById('statusDiv').style.display = 'none';
                document.getElementById('videoLinkDiv').style.display = 'none';
                document.getElementById('imageTitleDiv').style.display = 'none';
                document.getElementById('navigationLinkDiv').style.display = 'none';
                

        }


    function createTable(selectedValue){
        tabcontainer = document.getElementById('tab-container');
        tabcontainer.innerHTML = '';

            // Check if selectedValue matches any of the specified values
        if (selectedValue == 1 || selectedValue == 5 || selectedValue == 7 || selectedValue == 8 || selectedValue == 9 || selectedValue == 10 || selectedValue == 11) {
            tabcontainer.innerHTML = 'Select a section to view the data.';
            return;
        }
            // Create the table element
        var table = $('<table>').addClass('display').attr('id', 'imageTable').appendTo('#tab-container');
        
        // Create the table head
        var thead = $('<thead>').appendTo(table);
        var headRow = $('<tr>').appendTo(thead);
            if(selectedValue == 2){
                $('<th>').text('ID').appendTo(headRow);
                $('<th>').text('Image').appendTo(headRow);
                $('<th>').text('Image Text').appendTo(headRow);
                $('<th>').text('Delete').appendTo(headRow);
            } else if(selectedValue == 3){
                $('<th>').text('ID').appendTo(headRow);

                // $('<th>').text('Section Header').appendTo(headRow);
                // $('<th>').text('Section Sub Header').appendTo(headRow);
                $('<th>').text('Video Link').appendTo(headRow);
                $('<th>').text('Image').appendTo(headRow);
                $('<th>').text('Edit').appendTo(headRow);
                        
                $('<th>').text('Delete').appendTo(headRow);
            }else if(selectedValue == 4){
                $('<th>').text('ID').appendTo(headRow);
                // $('<th>').text('Section Header').appendTo(headRow);
                // $('<th>').text('Section Sub Header').appendTo(headRow);
                $('<th>').text('Navigation Link').appendTo(headRow);
                $('<th>').text('Image Title').appendTo(headRow);
                $('<th>').text('Image').appendTo(headRow);
                $('<th>').text('Delete').appendTo(headRow);
            }else if(selectedValue == 6){
                $('<th>').text('ID').appendTo(headRow);
                // $('<th>').text('Section Header').appendTo(headRow);
                $('<th>').text('Video Link').appendTo(headRow);
                $('<th>').text('Image').appendTo(headRow);
                $('<th>').text('Delete').appendTo(headRow);
            }
            else{
                $('<th>').text('ID').appendTo(headRow);
                $('<th>').text('Image').appendTo(headRow);
                $('<th>').text('Delete').appendTo(headRow);
            }
        // Create the table body
        var tbody = $('<tbody>').appendTo(table);

        // AJAX request to fetch the header images
        $.ajax({
            url: '/api/get-landing-page-data/'+selectedValue, // Replace with your API endpoint
            method: 'GET',
            success: function(data) {
                // Assuming data is an array of objects with id, image_url, and description
                
                if(selectedValue == 3){
                    data.forEach(function(item) {
                        var row = $('<tr>').appendTo(tbody);
                        $('<td>').text(item.id).appendTo(row);
                        // $('<td>').text(item.section_header_text).appendTo(row);
                        // $('<td>').text(item.section_sub_header_text).appendTo(row);
                        $('<td>').text(item.video_link).appendTo(row);

                        $('<td>').html('<img src="' + item.image_url + '" alt="Image" width="100">').appendTo(row);
                        $('<td>').html('<a href="/edit-landing-page-content/' + item.id + '">Edit</a>').appendTo(row);

                        $('<td>').html('<a href="/delete-landing-page-content/' + item.id + '">Delete</a>').appendTo(row);
                    });
                    // Initialize the DataTable
                    $('#imageTable').DataTable();
                }
                else if(selectedValue == 2){
                    data.forEach(function(item) {
                        var row = $('<tr>').appendTo(tbody);
                        $('<td>').text(item.id).appendTo(row);
                        $('<td>').html('<img src="' + item.image_url + '" alt="Image" width="100">').appendTo(row);
                        // $('<td>').text(item.section_header_text).appendTo(row);
                            // .a href link
                        $('<td>').html('<a href="/delete-landing-page-content/' + item.id + '">Delete</a>').appendTo(row);
                    });
                    // Initialize the DataTable
                    $('#imageTable').DataTable();
                }
                else if(selectedValue == 4){
                    data.forEach(function(item) {
                        var row = $('<tr>').appendTo(tbody);
                        $('<td>').text(item.id).appendTo(row);
                        // $('<td>').text(item.section_header_text).appendTo(row);
                        // $('<td>').text(item.section_sub_header_text).appendTo(row);
                        $('<td>').text(item.navigation_link).appendTo(row);
                        $('<td>').text(item.image_alt_text).appendTo(row);

                        $('<td>').html('<img src="' + item.image_url + '" alt="Image" width="100">').appendTo(row);
                            // .a href link
                        $('<td>').html('<a href="/delete-landing-page-content/' + item.id + '">Delete</a>').appendTo(row);
                    });
                    // Initialize the DataTable
                    $('#imageTable').DataTable();
                }
                else if(selectedValue == 6){
                    data.forEach(function(item) {
                        var row = $('<tr>').appendTo(tbody);
                        $('<td>').text(item.id).appendTo(row);
                        // $('<td>').text(item.section_header_text).appendTo(row);
                        $('<td>').text(item.video_link).appendTo(row);
                        $('<td>').html('<img src="' + item.image_url + '" alt="Image" width="100">').appendTo(row);
                            // .a href link
                        $('<td>').html('<a href="/delete-landing-page-content/' + item.id + '">Delete</a>').appendTo(row);
                    });
                    // Initialize the DataTable
                    $('#imageTable').DataTable();
                }
                else{
                    data.forEach(function(item) {
                        var row = $('<tr>').appendTo(tbody);
                        $('<td>').text(item.id).appendTo(row);
                        $('<td>').html('<img src="' + item.image_url + '" alt="Image" width="100">').appendTo(row);
                            // .a href link
                        $('<td>').html('<a href="/delete-landing-page-content/' + item.id + '">Delete</a>').appendTo(row);
                    });
                    // Initialize the DataTable
                    $('#imageTable').DataTable();
                }

            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch header images:', error);
            }
        });
                    }
     function getFields() {
            var select = document.getElementById('category');
            var selectedValue = select.value;
            if (selectedValue == 1) {

                //Main Menu
                document.getElementById('p-info').style.display = 'block';

                document.getElementById('p-info').innerText = 'You can only enable or disable this section at Manage Sections (At Top)↑';
                document.getElementById('titleDiv').style.display = 'none';
                document.getElementById('descriptionDiv').style.display = 'none';
                document.getElementById('scheduledfromDiv').style.display = 'none';
                document.getElementById('scheduledToDiv').style.display = 'none';
                document.getElementById('imageTo').style.display = 'none';
                document.getElementById('descriptionDivforAboutUS').style.display = 'none';
                document.getElementById('statusDiv').style.display = 'none';
                document.getElementById('videoLinkDiv').style.display = 'none';
                document.getElementById('imageTitleDiv').style.display = 'none';
                document.getElementById('navigationLinkDiv').style.display = 'none';

                // ppulate a table with all the main menu items

              createTable(selectedValue);
            } 

            else if (selectedValue == 2) {
                // Header Image
                document.getElementById('p-info').style.display = 'none';
                document.getElementById('titleDiv').style.display = 'block';
                document.getElementById('descriptionDiv').style.display = 'none';
                document.getElementById('scheduledfromDiv').style.display = 'none';
                document.getElementById('scheduledToDiv').style.display = 'none';
                document.getElementById('imageTo').style.display = 'block';
                document.getElementById('descriptionDivforAboutUS').style.display = 'none';
                document.getElementById('statusDiv').style.display = 'none';
                document.getElementById('videoLinkDiv').style.display = 'none';
                document.getElementById('imageTitleDiv').style.display = 'none';
                document.getElementById('navigationLinkDiv').style.display = 'none';
                createTable(selectedValue);
            }

            else if (selectedValue == 3) {
                // About Us
                document.getElementById('p-info').style.display = 'none';
                document.getElementById('titleDiv').style.display = 'none';
                // document.getElementById('titleDivLabel').innerHTML = 'Section Header Text <span style="color:red">*</span>';
                
                document.getElementById('descriptionDiv').style.display = 'none';
                document.getElementById('descriptionLabel').innerHTML = 'Section Sub Header Text <span style="color:red">*</span>';

                document.getElementById('imageTo').style.display = 'block';
                document.getElementById('customfileLabel').innerHTML = 'Image (720 x 240) <span style="color:red">*</span>';



                document.getElementById('scheduledfromDiv').style.display = 'none';
                document.getElementById('scheduledToDiv').style.display = 'none';
                document.getElementById('descriptionDivforAboutUS').style.display = 'block';
                document.getElementById('descriptionLabeltextArea').innerHTML = 'Section Content <span style="color:red">*</span>';


                document.getElementById('statusDiv').style.display = 'none';
                document.getElementById('videoLinkDiv').style.display = 'block';
                document.getElementById('videoLinkLabel').innerHTML = 'Video Link <span style="color:red">*</span>';
                document.getElementById('imageTitleDiv').style.display = 'none';
                document.getElementById('navigationLinkDiv').style.display = 'none';
                createTable(selectedValue);
            }

            else if(selectedValue == 4){

                //Popular Exams

                document.getElementById('p-info').style.display = 'none';
                document.getElementById('titleDiv').style.display = 'none';
                
                document.getElementById('descriptionDiv').style.display = 'none';
                document.getElementById('descriptionLabel').innerHTML = 'Section Sub Header Text <span style="color:red">*</span>';


                document.getElementById('imageTo').style.display = 'block';
                document.getElementById('customfileLabel').innerHTML = 'Image (720 x 240) <span style="color:red">*</span>';

                document.getElementById('scheduledfromDiv').style.display = 'none';
                document.getElementById('scheduledToDiv').style.display = 'none';
                document.getElementById('descriptionDivforAboutUS').style.display = 'none';
                document.getElementById('statusDiv').style.display = 'none';
                document.getElementById('videoLinkDiv').style.display = 'none';
                document.getElementById('imageTitleDiv').style.display = 'block';
                document.getElementById('navigationLinkDiv').style.display = 'block';
                createTable(selectedValue);

            }

            else if(selectedValue == 5){

                //WHy Choose Us
                document.getElementById('p-info').style.display = 'block';

                document.getElementById('p-info').innerText = 'You can only enable or disable this section at Manage Sections (At Top)↑';
                document.getElementById('titleDiv').style.display = 'none';
                document.getElementById('descriptionDiv').style.display = 'none';
                document.getElementById('scheduledfromDiv').style.display = 'none';
                document.getElementById('scheduledToDiv').style.display = 'none';
                document.getElementById('imageTo').style.display = 'none';
                document.getElementById('descriptionDivforAboutUS').style.display = 'none';
                document.getElementById('statusDiv').style.display = 'none';
                document.getElementById('videoLinkDiv').style.display = 'none';
                document.getElementById('imageTitleDiv').style.display = 'none';
                document.getElementById('navigationLinkDiv').style.display = 'none';
                createTable(selectedValue);


            }
            else if (selectedValue == 6){
                // We at Abhigyan

                document.getElementById('p-info').style.display = 'none';
                document.getElementById('titleDiv').style.display = 'none';
                document.getElementById('titleDivLabel').innerHTML = 'Section Header Text <span style="color:red">*</span>';
                                
                document.getElementById('descriptionDiv').style.display = 'none';

                document.getElementById('imageTo').style.display = 'block';
                document.getElementById('customfileLabel').innerHTML = 'Image (720 x 240) <span style="color:red">*</span>';

                document.getElementById('scheduledfromDiv').style.display = 'none';
                document.getElementById('scheduledToDiv').style.display = 'none';
                document.getElementById('descriptionDivforAboutUS').style.display = 'none';
                document.getElementById('statusDiv').style.display = 'none';
                document.getElementById('videoLinkDiv').style.display = 'block';
                document.getElementById('imageTitleDiv').style.display = 'none';
                document.getElementById('navigationLinkDiv').style.display = 'none';
                createTable(selectedValue);


            }else if (selectedValue == 7){
                // Our Courses
                document.getElementById('p-info').style.display = 'block';

                document.getElementById('p-info').innerText = 'You can only enable or disable this section at Manage Sections (At Top)↑';
                document.getElementById('titleDiv').style.display = 'none';
                document.getElementById('descriptionDiv').style.display = 'none';
                document.getElementById('scheduledfromDiv').style.display = 'none';
                document.getElementById('scheduledToDiv').style.display = 'none';
                document.getElementById('imageTo').style.display = 'none';
                document.getElementById('descriptionDivforAboutUS').style.display = 'none';
                document.getElementById('statusDiv').style.display = 'none';
                document.getElementById('videoLinkDiv').style.display = 'none';
                document.getElementById('imageTitleDiv').style.display = 'none';
                document.getElementById('navigationLinkDiv').style.display = 'none';
                createTable(selectedValue);


            }else {
                //Others //Blogs //Enquiry //Testimonials //Footer
                document.getElementById('p-info').style.display = 'block';

                document.getElementById('p-info').innerText = 'You can only enable or disable this section at Manage Sections (At Top)↑';
                document.getElementById('titleDiv').style.display = 'none';
                document.getElementById('descriptionDiv').style.display = 'none';
                document.getElementById('scheduledfromDiv').style.display = 'none';
                document.getElementById('scheduledToDiv').style.display = 'none';
                document.getElementById('imageTo').style.display = 'none';
                document.getElementById('descriptionDivforAboutUS').style.display = 'none';
                document.getElementById('statusDiv').style.display = 'none';
                document.getElementById('videoLinkDiv').style.display = 'none';
                document.getElementById('imageTitleDiv').style.display = 'none';
                document.getElementById('navigationLinkDiv').style.display = 'none';
                createTable(selectedValue);

            }

        }
    </script>

@if ($singleOffer != null)
    <script>
        window.onload = function() {
            var select = document.getElementById('category');
            // Manually trigger the change event if a section is pre-selected
            if (select.value !== '-1') {
                var event = new Event('change');
                select.dispatchEvent(event);
            }
            if (select.value == 3) {
                document.getElementById('title').value = '{{ $singleOffer->section_header_text }}';
                document.getElementById('description').value = '{{ $singleOffer->section_sub_header_text }}';
                document.getElementById('videoLink').value = '{{ $singleOffer->video_link }}';
           }
           if (select.value == 4) {
                document.getElementById('title').value = '{{ $singleOffer->section_header_text }}';
                document.getElementById('description').value = '{{ $singleOffer->section_sub_header_text }}';
                document.getElementById('imageTitle').value = '{{ $singleOffer->imageTitle }}';
                document.getElementById('navigationLink').value = '{{ $singleOffer->navigation_link }}';
           }
        };
    </script>
@endif


@endsection
