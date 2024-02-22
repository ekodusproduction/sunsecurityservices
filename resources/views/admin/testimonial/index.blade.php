@extends('admin.common.main')

@section('title', 'Testimonial | Admin')

@section('customHeader')
    <style>
        .profile {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

    </style>
@endsection

@section('pageHeader')
    Testimonial
@endsection

@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-9">
                        <div class="card-body d-md-flex align-items-center">
                            <button type="button" class="btn btn-primary mb-3 mb-md-0" data-bs-toggle="modal"
                                data-bs-target="#addTestimonialModal">Add New</button>
                            <p class="mb-0 ms-md-5">Only latest 5 reviews will be displayed on the website</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse ($testimonials as $item)
                <div class="col-lg-4 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <img class="profile mb-3" src="{{ asset($item->image) }}" alt="name">
                                <h4 class="mb-1">{{ $item->name }}</h4>
                                @for ($i = 0; $i < $item->rating; $i++)
                                    <i class='bx bxs-star'></i>
                                @endfor
                            </div>
                            <p>{{ $item->message }}</p>

                            <div class="text-center">
                                <button class="btn btn-danger deleteTestimonialBtn" data-id="{{ Crypt::encrypt($item->id) }}" >Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <p class="mb-0">**No review found</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>


    {{-- Add new testimonial --}}
    <div class="modal fade" id="addTestimonialModal" data-bs-backdrop="static" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="addTestimonialForm" action="{{ route('admin.testimonial.add') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTestimonialModalTitle">Add Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name<sup>*</sup></label>
                        <input class="form-control" type="text" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="star" class="form-label">Rating<sup>*</sup></label>
                        <select id="rating" name="rating" class="form-select" required>
                            <option value="" disabled selected>Select</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="4">Four</option>
                            <option value="5">Five</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message<sup>*</sup></label>
                        <textarea class="form-control" rows="3" id="message" name="message" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="profileImage" class="form-label">Image<sup>*</sup></label>
                        <input class="form-control" type="file" id="profileImage" name="profileImage" required>
                        <div class="form-text">Max file size 1MB</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="addTestimonialBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('customJS')
    {{-- Add testimonial --}}
    <script>
        // Get a reference to the file input element
        const inputElement = document.getElementById('profileImage');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement, {
            allowMultiple: false,
            maxFileSize: '1MB',
            maxFiles: 1,
            instantUpload: false,
            imagePreviewHeight: 200,
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
            labelFileTypeNotAllowed: 'Not a valid image. Please select only image.',
            labelIdle: '<div style="width:100%;height:100%;"><p> Drag &amp; Drop your files or <span class="filepond--label-action" tabindex="0">Browse</span><br> Maximum number of image is 1 :</p> </div>',
        });

        $("#addTestimonialForm").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            $('#addTestimonialBtn').text('Uploading...');
            $('#addTestimonialBtn').attr('disabled', true);

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
                        $('#addTestimonialBtn').text('Upload');
                        $('#addTestimonialBtn').attr('disabled', false);
                        $('#addTestimonialModal').modal('toggle');
                        Swal.fire(
                            'Good job!',
                            data.message,
                            'success'
                        ).then(() => {
                            window.location.reload(true);
                        })
                    } else {
                        pond.removeFiles();
                        $('#addTestimonialBtn').text('Upload');
                        $('#addTestimonialBtn').attr('disabled', false);
                        $('#addTestimonialModal').modal('toggle');
                        Swal.fire(
                            'Oops!',
                            data.message,
                            'error'
                        )
                    }
                },
                error: function(data) {
                    pond.removeFiles();
                    $('#addTestimonialBtn').text('Upload');
                    $('#addTestimonialBtn').attr('disabled', false);
                    $('#addTestimonialModal').modal('toggle');
                    Swal.fire(
                        'Oops!',
                        'Server error',
                        'error'
                    )
                }
            });
        });
    </script>

    {{-- Delete testimonial --}}
    <script>
        $('.deleteTestimonialBtn').on('click', function(e) {
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
                    let btn = $(this);
                    btn.text('Deleting...');
                    btn.attr('disabled', true);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.testimonial.delete') }}",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            if (data.status === 200) {
                                btn.text('Delete');
                                btn.attr('disabled', false);
                                Swal.fire(
                                    'Good job!',
                                    data.message,
                                    'success'
                                ).then(() => {
                                    window.location.reload(true);
                                })
                            } else {
                                btn.text('Delete');
                                btn.attr('disabled', false);
                                Swal.fire(
                                    'Oops!',
                                    data.message,
                                    'error'
                                )
                            }
                        },
                        error: function(data) {
                            btn.text('Delete');
                            btn.attr('disabled', false);
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
