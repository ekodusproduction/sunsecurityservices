@extends('admin.common.main')

@section('title', 'Services | Admin')

@section('customHeader')
@endsection

@section('pageHeader')
    Services
@endsection

@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Image list --}}
        <div class="row">
            @foreach ($services as $item)
                <div class="col-lg-6 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-12">
                                <div class="card-body">
                                    <h3>{{ $item->service_title }}</h3>
                                    <button type="button" class="btn btn-primary mb-3 openUpdateModalBtn"
                                        data-id="{{ Crypt::encrypt($item->id) }}">Update image</button>
                                    @if ($item->image)
                                        <img class="w-100 rounded" src="{{ asset($item->image) }}" alt="Image">
                                    @else
                                        <img class="w-100 rounded" src="{{ asset('uploads/services/no-image.jpg') }}"
                                            alt="No image">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>



    {{-- Create New Carousel Modal --}}
    <div class="modal fade" id="uploadServicesImageModal" data-bs-backdrop="static" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="uploadServiceImageForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadServicesImageModalTitle">Upload New Carousel Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="carouselImage" class="form-label">Image</label>
                        <input type="hidden" name="service_id" id="service_id">
                        <input class="form-control" type="file" accept="image/*" id="serviceImage" name="serviceImage"
                            required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" id="imageUploadBtn" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('customJS')
    <script>
        // Get a reference to the file input element
        const inputElement = document.getElementById('serviceImage');

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
    </script>
    <script>
        $('.openUpdateModalBtn').on('click', function() {
            $('#uploadServicesImageModal').modal('toggle');
            $('#service_id').val($(this).data('id'))
        });
    </script>

    <script>
        $("#uploadServiceImageForm").submit(function(e) {
            e.preventDefault();

            var actionUrl = "{{ route('admin.services.upload.image') }}";
            let btn = $('#imageUploadBtn');

            btn.text('Uploading...');
            btn.attr('disabled', true);

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
                        $('#uploadServicesImageModal').modal('toggle');
                        Swal.fire(
                            'Good job!',
                            data.message,
                            'success'
                        ).then(() => {
                            $("#uploadServiceImageForm")[0].reset();
                            pond.removeFiles();
                            btn.text('Upload');
                            btn.attr('disabled', false);                            
                            window.location.reload(true);
                        })
                    } else {
                        $('#uploadServicesImageModal').modal('toggle');
                        Swal.fire(
                            'Oops!',
                            data.message,
                            'error'
                        ).then(() => {
                            $("#uploadServiceImageForm")[0].reset();
                            pond.removeFiles();
                            btn.text('Upload');
                            btn.attr('disabled', false);
                        })
                    }
                },
                error: function(data) {
                    $('#uploadServicesImageModal').modal('toggle');
                    Swal.fire(
                        'Oops!',
                        'Server error',
                        'error'
                    ).then(() => {
                        $("#uploadServiceImageForm")[0].reset();
                        pond.removeFiles();
                        btn.text('Upload');
                        btn.attr('disabled', false);                        
                    })
                }
            });
        });
    </script>
@endsection
