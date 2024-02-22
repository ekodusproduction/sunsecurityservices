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
                    <h5 class="mb-0">Add new job position</h5>
                    <small class="text-muted float-end">Career</small>
                </div>
                <div class="card-body">
                    <form id="jobPostForm">
                        <div class="mb-3">
                            <label class="form-label" for="jobTitle">Job title<sup>*</sup></label>
                            <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="location">Location<sup>*</sup></label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="totalPost">No of vacancy<sup>*</sup></label>
                            <input type="number" id="totalPost" name="totalPost" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="jobDescription">Description<sup>*</sup></label>
                            <textarea id="jobDescription" name="jobDescription" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
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
    $('#jobPostForm').on('submit', function(e) {
        e.preventDefault();

        let btn = $('#submitBtn');
        btn.text('Please wait...');
        btn.attr('disabled', true);

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('admin.career.add') }}",
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
                        btn.text('Submit');
                        btn.attr('disabled', false);
                        $('#jobPostForm').trigger('reset');
                        window.location.reload(true);                        
                    })
                } else {
                    Swal.fire(
                        'Oops!',
                        data.message,
                        'error'
                    ).then(() => {
                        btn.text('Submit');
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
