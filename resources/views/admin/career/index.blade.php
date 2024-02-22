@extends('admin.common.main')

@section('title', 'Career | Admin')

@section('customHeader')
@endsection

@section('pageHeader')
    Career
@endsection

@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-9">
                        <div class="card-body">
                            <a href="{{ route('admin.career.add') }}" type="button" class="btn btn-primary">Create
                                new</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header">All posts</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Post date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($jobs as $item)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $item->title }}</strong>
                                </td>
                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="testingUpdate" id="testingUpdate" data-id="{{ Crypt::encrypt($item->id) }}"
                                            {{ $item->status == 1 ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <a href="{{ route('admin.career.edit', ['id' => Crypt::encrypt($item->id)]) }}"
                                        class="btn btn-primary">Edit</a>
                                    <button class="btn btn-danger deleteJob"
                                        data-id="{{ Crypt::encrypt($item->id) }}">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">**No jobs found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('customJS')
    <script>
        $('.deleteJob').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this job?",
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
                        url: "{{ route('admin.career.delete') }}",
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

    <script>
        // Change status
        $(document.body).on('change', '#testingUpdate', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var job_id = $(this).data('id');
            var formData = {
                job_id: job_id,
                active: status
            }
            $.ajax({
                type: "POST",
                url: "{{ route('admin.career.change.status') }}",
                data: formData,

                success: function(data) {
                    console.log(data)
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    console.log(errors);
                }
            });
        });
    </script>
@endsection
