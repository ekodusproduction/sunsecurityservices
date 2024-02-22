@extends('admin.common.main')

@section('title', 'Blog | Admin')

@section('customHeader')
    <style>
        .blog-featured-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .card-body {
            padding: 1.5rem 2rem;
        }

    </style>
@endsection

@section('pageHeader')
    Blog
@endsection

@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-9">
                        <div class="card-body">
                            <a href="{{ route('admin.blog.add') }}" type="button" class="btn btn-primary">Create
                                blog</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse ($blogs as $item)
                <div class="col-md-4 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="card-body">
                                {{-- Featured image --}}
                                <img class="blog-featured-image" src="{{ asset($item->image) }}" alt="Featured image">
                                {{-- Blog title --}}
                                <a href="{{ route('site.blog', ['id' => Crypt::encrypt($item->id)]) }}" target="_blank">
                                    <h5 class="blog-title mt-3 text-capitalize">
                                        {{ $item->title }}
                                    </h5>
                                </a>
                                {{-- Action buttons --}}
                                <div class="action-btn">
                                    <a href="{{ route('admin.blog.edit', ['id' => Crypt::encrypt($item->id)]) }}"
                                        type="button" class="btn btn-outline-primary">Edit</a>
                                    <button type="button" class="btn btn-danger deleteBlogBtn"
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
                                    <h5 class="mb-0">**No blogs found</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse

            {{ $blogs->links() }}
        </div>
    </div>
@endsection


@section('customJS')
    {{-- Delete blog --}}
    <script>
        $('.deleteBlogBtn').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this blog?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If delete
                    let id = $(this).data('id');
                    let btn = $(this);
                    btn.text('Please wait...');
                    btn.attr('disabled', true);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.blog.delete') }}",
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
