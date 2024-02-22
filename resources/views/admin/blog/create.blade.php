@extends('admin.common.main')

@section('title', 'Blog | Admin')

@section('customHeader')
    <style>
        .blog-featured-image {
            width: 100%;
            border-radius: 10px
        }

        .card-body {
            padding: 1.5rem 2rem;
        }

    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
@endsection

@section('pageHeader')
    Blog
@endsection

@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-md-12 mb-4 order-0">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create blog</h5>
                    <small class="text-muted float-end">Blog</small>
                </div>
                <div class="card-body">
                    <form id="createBlogForm">
                        <div class="mb-3">
                            <label class="form-label" for="blogTitle">Title<sup>*</sup></label>
                            <input type="text" class="form-control" id="blogTitle" name="blogTitle"
                                placeholder="BLog title" required>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Featured image<sup>*</sup></label>
                            <input class="form-control" type="file" id="featuredImage" name="featuredImage" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="blogDescription">Decription<sup>*</sup></label>
                            <textarea id="blogDescription" name="blogDescription" class="form-control" placeholder="Blog description"></textarea>
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
            .create(document.querySelector('#blogDescription'), {
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle',
                    'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                ],
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        // File pond initialize
        // Get a reference to the file input element
        const inputElement = document.getElementById('featuredImage');

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
        $('#createBlogForm').on('submit', function(e) {
            e.preventDefault();

            $('#submitBtn').text('Please wait...');
            $('#submitBtn').attr('disabled', true);

            let formData = new FormData(this);

            pondFiles = pond.getFiles();
            for (var i = 0; i < pondFiles.length; i++) {
                formData.append('blogImage', pondFiles[i].file);
            }

            $.ajax({
                url: "{{ route('admin.blog.add') }}",
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
                            $('#submitBtn').text('Submit');
                            $('#submitBtn').attr('disabled', false);
                            $('#createBlogForm').trigger('reset');
                            pond.removeFiles();
                            window.location.href = "{{route('admin.blog.index')}}";
                            
                        })
                    } else {
                        Swal.fire(
                            'Oops!',
                            data.message,
                            'error'
                        ).then(() => {
                            $('#submitBtn').text('Submit');
                            $('#submitBtn').attr('disabled', false);
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
                            $('#submitBtn').text('Submit');
                            $('#submitBtn').attr('disabled', false);
                        })
                    }
                }

            });
        });
    </script>
@endsection
