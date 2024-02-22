@extends('admin.common.main')

@section('title', 'Dashboard | Admin')

@section('customHeader')
@endsection

@section('pageHeader')
    Dashboard
@endsection

@section('main')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Notification --}}
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Website notification</h5>
                    <small class="text-muted float-end">Dashboard</small>
                </div>
                <div class="card-body">
                    <form id="notificationTitleForm">
                        <div class="mb-3">
                            <label class="form-label" for="title">Notification title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitNotificationBtn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <h5 class="card-header">Current Notification</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($notification as $item)
                                <tr>
                                    <td><strong>{{ $item->title }}</strong></td>
                                    <td>
                                        <button class="btn btn-danger btn-sm deleteNotification"
                                            data-id="{{ Crypt::encrypt($item->id) }}">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">**No notification found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Cahnge password --}}
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Change password</h5>
                    <small class="text-muted float-end">Dashboard</small>
                </div>
                <div class="card-body">
                    <form id="updatePasswordForm">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="&#8270;&#8270;&#8270;&#8270;&#8270;&#8270;">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword"
                                placeholder="&#8270;&#8270;&#8270;&#8270;&#8270;&#8270;">
                        </div>
                        <button type="submit" class="btn btn-primary" id="updatePasswordBtn">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJS')
    <script>
        $(document).ready(function() {
            $("#updatePasswordForm").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 5
                    },
                    cpassword: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    password: {
                        required: 'Please enter your password',
                        minlength: 'Can not be less than 5 characters'
                    },
                    cpassword: {
                        required: 'Please enter confirm password',
                        equalTo: "Password not match"
                    }
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                },
                submitHandler: function(form, e) {
                    e.preventDefault();
                    $('#updatePasswordBtn').text('Please wait...');
                    $('#updatePasswordBtn').attr('disabbled', true);
                    let formData = new FormData(form);
                    $.ajax({
                        method: 'post',
                        url: "{{ route('admin.update.password') }}",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.status === 200) {
                                Swal.fire(
                                    'Good job!',
                                    data.message,
                                    'success'
                                ).then(() => {
                                    $(form)[0].reset();
                                    $('#updatePasswordBtn').text('Update');
                                    $('#updatePasswordBtn').attr('disabbled',
                                        false);
                                });
                            } else {
                                Swal.fire(
                                    'Error',
                                    data.message,
                                    'error'
                                ).then(() => {
                                    $('#updatePasswordBtn').text('Update');
                                    $('#updatePasswordBtn').attr('disabbled',
                                        false);
                                });
                            }
                        },
                        error: function(data) {
                            Swal.fire(
                                'Error',
                                'Server error',
                                'error'
                            ).then(() => {
                                $('#updatePasswordBtn').text('Update');
                                $('#updatePasswordBtn').attr('disabbled',
                                    false);
                            });
                        }
                    });
                }
            });

            // Add notification
            $("#notificationTitleForm").validate({
                rules: {
                    title: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    title: {
                        required: 'Notification title cannot be null',
                        minlength: 'Minimum 5 characters'
                    }
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                },
                submitHandler: function(form, e) {
                    e.preventDefault();
                    $('#submitNotificationBtn').text('Please wait...');
                    $('#submitNotificationBtn').attr('disabbled', true);
                    let formData = new FormData(form);
                    $.ajax({
                        method: 'post',
                        url: "{{ route('admin.notification.add') }}",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.status === 200) {
                                Swal.fire(
                                    'Good job!',
                                    data.message,
                                    'success'
                                ).then(() => {
                                    $(form)[0].reset();
                                    $('#submitNotificationBtn').text('Submit');
                                    $('#submitNotificationBtn').attr('disabbled',
                                        false);
                                    location.reload(true);
                                });
                            } else {
                                Swal.fire(
                                    'Error',
                                    data.message,
                                    'error'
                                ).then(() => {
                                    $('#submitNotificationBtn').text('Submit');
                                    $('#submitNotificationBtn').attr('disabbled',
                                        false);
                                });
                            }
                        },
                        error: function(data) {
                            Swal.fire(
                                'Error',
                                'Server error',
                                'error'
                            ).then(() => {
                                $('#submitNotificationBtn').text('Submit');
                                $('#submitNotificationBtn').attr('disabbled',
                                    false);
                            });
                        }
                    });
                }
            });

            $('.deleteNotification').on('click', function(e) {
                e.preventDefault();
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
                            let btn = $(this);
                            let notification_id = btn.data('id');
                            console.log(notification_id);
                            $(btn).text('Please wait...');
                            $(btn).attr('disabled', true);
                            $.ajax({
                                method: 'post',
                                url: "{{ route('admin.notification.delete') }}",
                                data: {
                                    notification_id: notification_id
                                },
                                success: function(data) {
                                    if (data.status === 200) {
                                        Swal.fire(
                                            'Good job!',
                                            data.message,
                                            'success'
                                        ).then(() => {
                                            btn.text('Delete');
                                            btn.attr('disabled',
                                                false);
                                            location.reload(true);
                                        });
                                    } else {
                                        Swal.fire(
                                            'Error',
                                            data.message,
                                            'error'
                                        ).then(() => {
                                            btn.text('Delete');
                                            btn.attr('disabled',
                                                false);
                                        });
                                    }
                                },
                                error: function(data) {
                                    Swal.fire(
                                        'Error',
                                        'Server error',
                                        'error'
                                    ).then(() => {
                                        btn.text('Delete');
                                        btn.attr('disabled',
                                            false);
                                    });
                                }
                            });
                        }
                    });




            })
        });
    </script>
@endsection
