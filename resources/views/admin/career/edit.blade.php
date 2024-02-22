@extends('admin.common.main')

@section('title', 'Career | Admin')

@section('customHeader')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
@endsection

@section('pageHeader')
    Career
@endsection

@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit job</h5>
                    <small class="text-muted float-end">Career</small>
                </div>
                <div class="card-body">
                    <form id="editJobPostForm">
                        <div class="mb-3">
                            <label class="form-label" for="jobTitle">Job title</label>
                            <input type="text" class="form-control" id="jobTitle" name="jobTitle" value="{{$job->title}}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{$job->location}}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="totalPost">No of vacancy</label>
                            <input type="number" id="totalPost" name="totalPost" class="form-control" value="{{$job->no_of_post}}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="jobDescription">Description</label>
                            <textarea id="jobDescription" name="jobDescription" class="form-control">{{$job->description}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('customJS')
    <script>
        // CK Editor initialize
        ClassicEditor
            .create(document.querySelector('#jobDescription'), {
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle',
                    'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                ],
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        $('#editJobPostForm').on('submit', function(e) {
            e.preventDefault();

            let btn = $('#submitBtn');
            btn.text('Please wait...');
            btn.attr('disabled', true);

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('admin.career.edit', ['id'=>Crypt::encrypt($job->id)]) }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status === 200) {
                        Swal.fire(
                            'Good job!',
                            data.message,
                            'success'
                        ).then(() => {
                            btn.text('Update');
                            btn.attr('disabled', false);
                        })
                    } else {
                        Swal.fire(
                            'Oops!',
                            data.message,
                            'error'
                        ).then(() => {
                            btn.text('Update');
                            btn.attr('disabled', false);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.status = 500 || xhr.status == 422) {
                        Swal.fire(
                            'Oops!',
                            'Server error',
                            'error'
                        ).then(() => {
                            btn.text('Submit');
                            btn.attr('disabled', false);
                        })
                    }
                }

            });
        });
    </script>
@endsection
