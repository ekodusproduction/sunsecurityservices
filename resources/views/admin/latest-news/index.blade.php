@extends('admin.common.main')

@section('title', 'Latest News | Admin')

@section('customHeader')
@endsection

@section('pageHeader')
    Latest News
@endsection

@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-9">
                        <div class="card-body d-md-flex align-items-center">
                            <button type="button" class="btn btn-primary mb-3 mb-md-0" data-bs-toggle="modal"
                                data-bs-target="#addLatestNewsModal">Add News</button>
                                <p class="mb-0 ms-md-5">Only 5 latest news will be displayed on the website</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @forelse ($news as $index => $item)
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-9">
                            <div class="card-body">
                                <h2>{{ $index + 1 }}</h2>
                                <h5>{{ $item->title }}</h5>
                                <button type="button" class="btn btn-primary openEditLatestNewsModal"
                                    data-id="{{ Crypt::encrypt($item->id) }}">Edit</button>
                                <button on type="button" class="btn btn-danger deleteLatestNewsBtn"
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
                        <div class="col-sm-9">
                            <div class="card-body">
                                <h5 class="mb-0">**No news found</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
        {{ $news->links() }}
    </div>


    {{-- Add latest news --}}
    <div class="modal fade" id="addLatestNewsModal" data-bs-backdrop="static" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="addLatestNewsForm" action="{{ route('admin.latestnews.add') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addLatestNewsModalTitle">Add News</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="carouselImage" class="form-label">Title<sup>*</sup></label>
                        <textarea class="form-control" rows="5" id="news_title" name="news_title" placeholder="Not more than 500 characters"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="addNewsBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit news --}}
    <div class="modal fade" id="editLatestNewsModal" data-bs-backdrop="static" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="editLatestNewsForm" action="{{ route('admin.latestnews.add') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editLatestNewsModalTitle">Update News</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="edit_news_id" name="edit_news_id">
                    <div class="mb-3">
                        <label for="carouselImage" class="form-label">Title<sup>*</sup></label>
                        <textarea class="form-control" rows="5" id="edit_news_title" name="edit_news_title"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="updateNewsBtn">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('customJS')

    {{-- Add news --}}
    <script>
        $("#addLatestNewsForm").submit(function(e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            $('#addNewsBtn').text('Please wait..');
            $('#addNewsBtn').attr('disabled', true);

            var form = $(this);
            var actionUrl = form.attr('action');

            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: actionUrl,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status === 200) {
                        $('#addNewsBtn').text('Upload');
                        $('#addNewsBtn').attr('disabled', false);
                        $('#addLatestNewsModal').modal('toggle');
                        Swal.fire(
                            'Good job!',
                            data.message,
                            'success'
                        ).then(() => {
                            window.location.reload(true);
                        })
                    } else {
                        $('#addNewsBtn').text('Upload');
                        $('#addNewsBtn').attr('disabled', false);
                        $('#addLatestNewsModal').modal('toggle');
                        Swal.fire(
                            'Oops!',
                            data.message,
                            'error'
                        )
                    }
                },
                error: function(data) {
                    $('#addNewsBtn').text('Upload');
                    $('#addNewsBtn').attr('disabled', false);
                    $('#addLatestNewsModal').modal('toggle');
                    Swal.fire(
                        'Oops!',
                        'Server error',
                        'error'
                    )
                }
            });
        });
    </script>

    {{-- Open edit news modal --}}
    <script>
        $('.openEditLatestNewsModal').on('click', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let btn = $(this);
            btn.text('Please wait...');
            btn.attr('disabled', true);
            let url = "{{ route('admin.get.latestnews.details') }}";

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    enc_id: id
                },
                success: function(data) {
                    if (data.status == 200) {
                        btn.text('Edit');
                        btn.attr('disabled', false);
                        $('#edit_news_id').val(data.news_id);
                        $('#edit_news_title').val(data.news_title);
                        $('#editLatestNewsModal').modal('show');
                    } else {
                        Swal.fire(
                            'Oops!',
                            data.message,
                            'error'
                        ).then(() => {
                            btn.text('Edit');
                            btn.attr('disabled', false);
                        })
                    }
                },
                error: function(data) {
                    btn.text('Edit');
                    btn.attr('disabled', false);
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });
    </script>

    {{-- Update news --}}
    <script>
        $('#editLatestNewsForm').on('submit', function(e) {
            e.preventDefault();
            $('#updateNewsBtn').text('Please wait...');
            $('#updateNewsBtn').attr('disabled', true);
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('admin.update.latestnews.details') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 200) {
                        $('#updateNewsBtn').text('Update');
                        $('#updateNewsBtn').attr('disabled', false);
                        $('#editLatestNewsModal').modal('toggle');
                        Swal.fire(
                            'Good job!',
                            data.message,
                            'success'
                        ).then(() => {
                            $('#editLatestNewsForm')[0].reset();
                            $('#editLatestNewsModal').modal('hide');
                            location.reload(true);
                        });
                    } else {
                        $('#updateNewsBtn').text('Update');
                        $('#updateNewsBtn').attr('disabled', false);
                        $('#editLatestNewsModal').modal('toggle');
                        Swal.fire(
                            'Oops!',
                            data.message,
                            'error'
                        )
                    }
                },
                error: function(data) {
                    $('#updateNewsBtn').text('Update');
                    $('#updateNewsBtn').attr('disabled', false);
                    $('#editLatestNewsModal').modal('toggle');
                    Swal.fire(
                        'Oops!',
                        'Server error',
                        'error'
                    )
                }
            });
        })
    </script>

    {{-- Delete test series --}}
    <script>
        $('.deleteLatestNewsBtn').on('click', function() {
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        let news_id = $(this).data('id');
                        let btn = $(this);
                        $(btn).text('Please wait...');
                        $(btn).attr('disabled', true);
                        let formData = {
                            news_id: news_id
                        }

                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.delete.latestnews') }}",
                            data: formData,
                            success: function(data) {
                                if (data.status == 200) {
                                    Swal.fire(
                                        'Good job!',
                                        data.message,
                                        'success'
                                    ).then(() => {
                                        $(btn).text('Delete');
                                        $(btn).attr('disabled', false);
                                        location.reload(true);
                                    })

                                } else {
                                    Swal.fire(
                                        'Oops!',
                                        data.message,
                                        'error'
                                    ).then(() => {
                                        $(btn).text('Delete');
                                        $(btn).attr('disabled', false);
                                    })
                                }
                            },
                            error: function(data) {
                                swal({
                                    title: "Error!",
                                    text: "Server error",
                                    icon: "error",
                                    button: "Close",
                                }).then(() => {
                                    $(btn).text('Delete');
                                    $(btn).attr('disabled', false);
                                })
                            }
                        });
                    }
                });
        })
    </script>
@endsection
