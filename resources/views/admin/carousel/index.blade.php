@extends('admin.common.main')

@section('title', 'Carousel | Admin')

@section('customHeader')
@endsection

@section('pageHeader')
    Carousel
@endsection

@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-9">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#createCarouselModal"><i class='bx bx-image-add'></i> Add Image</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Image list --}}
        @forelse ($images as $item)
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-9">
                            <div class="card-body">
                                <img class="w-100 rounded" src="{{ asset($item->image) }}" alt="Banner">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="card-body px-md-0">
                                <button type="button" class="btn btn-outline-primary openUpdateModalBtn"
                                    data-id="{{ Crypt::encrypt($item->id) }}">Update</button>
                                <button type="button" class="btn btn-danger deleteCarouselImageBtn"
                                    data-id="{{ Crypt::encrypt($item->id) }}">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                <h5 class="mb-0">**No images found</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse

    </div>



    {{-- Create New Carousel Modal --}}
    <div class="modal fade" id="createCarouselModal" data-bs-backdrop="static" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="uploadCarouselForm" action="{{ route('admin.carousel.add') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createCarouselModalTitle">Upload New Carousel Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="carouselImage" class="form-label">Image</label>
                        <input class="form-control" type="file" accept="image/*" id="carouselImage" name="carouselImage"
                            required>
                        <small>Required resolution: 1366x768</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" id="carouselUploadBtn" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>


    {{-- Edit Carousel Modal --}}
    <div class="modal fade" id="editCarouselModal" data-bs-backdrop="static" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('admin.carousel.update') }}" id="updateCarouselForm"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editCarouselModalTitle">Update Carousel Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control" type="file" id="carouselNewImage" required>
                        <small>Required resolution: 1366x768</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="editImageBtn">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('customJS')
    {{-- Upload new image --}}
    <script>
        // Get a reference to the file input element
        const inputElement = document.getElementById('carouselImage');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement, {
            allowMultiple: false,
            maxFileSize: '1MB',
            maxFiles: 1,
            instantUpload: false,
            imagePreviewHeight: 200,
            acceptedFileTypes: ['image/*'],
            labelFileTypeNotAllowed: 'Not a valid image. Please select only image.',
            labelIdle: '<div style="width:100%;height:100%;"><p> Drag &amp; Drop your files or <span class="filepond--label-action" tabindex="0">Browse</span><br> Maximum number of image is 1 :</p> </div>',
        });

        $("#uploadCarouselForm").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            $('#carouselUploadBtn').text('Uploading...');
            $('#carouselUploadBtn').attr('disabled', true);

            var form = $(this);
            var actionUrl = form.attr('action');

            let formData = new FormData(this);

            pondFiles = pond.getFiles();
            for (var i = 0; i < pondFiles.length; i++) {
                formData.append('attachment', pondFiles[i].file);
            }

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status === 200) {
                        pond.removeFiles();
                        $('#carouselUploadBtn').text('Upload');
                        $('#carouselUploadBtn').attr('disabled', false);
                        $('#createCarouselModal').modal('toggle');
                        Swal.fire(
                            'Good job!',
                            data.message,
                            'success'
                        ).then(() => {
                            window.location.reload(true);
                        })
                    } else {
                        pond.removeFiles();
                        $('#carouselUploadBtn').text('Upload');
                        $('#carouselUploadBtn').attr('disabled', false);
                        $('#createCarouselModal').modal('toggle');
                        Swal.fire(
                            'Oops!',
                            data.message,
                            'error'
                        )
                    }
                },
                error: function(data) {
                    pond.removeFiles();
                    $('#carouselUploadBtn').text('Upload');
                    $('#carouselUploadBtn').attr('disabled', false);
                    $('#createCarouselModal').modal('toggle');
                    Swal.fire(
                        'Oops!',
                        'Server error',
                        'error'
                    )
                }
            });

        });
    </script>

    {{-- Update image --}}
    <script>
        // Create a FilePond instance
        const pond2 = FilePond.create(document.getElementById('carouselNewImage'), {
            allowMultiple: false,
            maxFileSize: '1MB',
            maxFiles: 1,
            instantUpload: false,
            imagePreviewHeight: 200,
            acceptedFileTypes: ['image/*'],
            labelFileTypeNotAllowed: 'Not a valid image. Please select only image.',
            labelIdle: '<div style="width:100%;height:100%;"><p> Drag &amp; Drop your files or <span class="filepond--label-action" tabindex="0">Browse</span><br> Maximum number of image is 1 :</p> </div>',
        });

        $('.openUpdateModalBtn').on('click', function() {
            id = $(this).data('id');
            $('#editCarouselModal').modal('toggle');
        });

        $("#updateCarouselForm").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            $('#editImageBtn').text('Uploading...');
            $('#editImageBtn').attr('disabled', true);

            var form = $(this);
            var actionUrl = form.attr('action');

            let formData = new FormData(this);
            formData.append('id', id);
            pondFiles = pond2.getFiles();
            for (var i = 0; i < pondFiles.length; i++) {
                formData.append('attachment', pondFiles[i].file);
            }

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status === 200) {
                        pond.removeFiles();
                        $('#editImageBtn').text('Upload');
                        $('#editImageBtn').attr('disabled', false);
                        $('#editCarouselModal').modal('toggle');
                        Swal.fire(
                            'Good job!',
                            data.message,
                            'success'
                        ).then(() => {
                            window.location.reload(true);
                        })
                    } else {
                        pond.removeFiles();
                        $('#editImageBtn').text('Upload');
                        $('#editImageBtn').attr('disabled', false);
                        $('#editCarouselModal').modal('toggle');
                        Swal.fire(
                            'Oops!',
                            data.message,
                            'error'
                        )
                    }
                },
                error: function(data) {
                    pond.removeFiles();
                    $('#editImageBtn').text('Upload');
                    $('#editImageBtn').attr('disabled', false);
                    $('#editCarouselModal').modal('toggle');
                    Swal.fire(
                        'Oops!',
                        'Server error',
                        'error'
                    )
                }
            });

        });
    </script>

    {{-- Delete image --}}
    <script>
        $('.deleteCarouselImageBtn').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this image?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If delete
                    let id = $(this).data('id');
                    $(this).text('Deleting...');
                    $(this).attr('disabled', true);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.carousel.delete') }}",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data.status === 200) {
                                $(this).text('Delete');
                                $(this).attr('disabled', false);
                                Swal.fire(
                                    'Good job!',
                                    data.message,
                                    'success'
                                ).then(() => {
                                    window.location.reload(true);
                                })
                            } else {
                                $(this).text('Delete');
                                $(this).attr('disabled', false);
                                Swal.fire(
                                    'Oops!',
                                    data.message,
                                    'error'
                                )
                            }
                        },
                        error: function(data) {
                            $(this).text('Delete');
                            $(this).attr('disabled', false);
                            Swal.fire(
                                'Oops!',
                                'Server error',
                                'error'
                            )
                        }
                    });
                }
            });
        });
    </script>
@endsection
