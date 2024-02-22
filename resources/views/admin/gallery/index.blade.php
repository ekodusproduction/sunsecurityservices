@extends('admin.common.main')

@section('title', 'Gallery | Admin')

@section('customHeader')
    <style>
        .h-200-object-fit {
            height: 200px;
            object-fit: cover;
        }

    </style>
@endsection

@section('pageHeader')
    Gallery
@endsection

@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-9">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#createGalleryModal"><i class='bx bx-image-add'></i> Add Image</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Images --}}
        <div class="col-lg-12 mb-4 order-0">
            <div class="row" id="images">
                @forelse ($images as $item)
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <img class="w-100 rounded h-200-object-fit" src="{{ asset($item->image) }}" alt="Banner">
                                <button type="button" class="btn btn-danger mt-3 deleteImageBtn"
                                    data-id="{{ Crypt::encrypt($item->id) }}">Delete</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12 mb-4 order-0">
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-0">**No Images Found</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            {{ $images->links() }}
        </div>
    </div>


    {{-- Add gallery image modal --}}
    <div class="modal fade" id="createGalleryModal" data-bs-backdrop="static" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="uploadGalleryForm" action="{{ route('admin.gallery.add') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createGalleryModalTitle">Upload New Gallery Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="carouselImage" class="form-label">Image</label>
                        <input class="form-control" type="file" accept="image/*" id="galleryImage" name="galleryImage"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="uploadBtn">Upload</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('customJS')
    {{-- Upload new image --}}
    <script>
        // Get a reference to the file input element
        const inputElement = document.getElementById('galleryImage');

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

        $("#uploadGalleryForm").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            $('#uploadBtn').text('Uploading...');
            $('#uploadBtn').attr('disabled', true);

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
                        $('#uploadBtn').text('Upload');
                        $('#uploadBtn').attr('disabled', false);
                        $('#createGalleryModal').modal('toggle');
                        Swal.fire(
                            'Good job!',
                            data.message,
                            'success'
                        ).then(() => {
                            window.location.reload(true);
                        })
                    } else {
                        pond.removeFiles();
                        $('#uploadBtn').text('Upload');
                        $('#uploadBtn').attr('disabled', false);
                        $('#createGalleryModal').modal('toggle');
                        Swal.fire(
                            'Oops!',
                            data.message,
                            'error'
                        )
                    }
                },
                error: function(data) {
                    pond.removeFiles();
                    $('#uploadBtn').text('Upload');
                    $('#uploadBtn').attr('disabled', false);
                    $('#createGalleryModal').modal('toggle');
                    Swal.fire(
                        'Oops!',
                        'Server error',
                        'error'
                    )
                }
            });
        });
    </script>

    {{-- Delete Image --}}
    <script>
        $('.deleteImageBtn').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id');
                    $(this).text('Deleting...');
                    $(this).attr('disabled', true);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.gallery.delete') }}",
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
