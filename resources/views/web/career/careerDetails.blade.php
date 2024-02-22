@extends('web.common.main')

@section('title', 'Career | Sun Security Services')

@section('customHeader')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endsection

@section('main')
    <div class="container" id="jobs">
        <p class="mt-3" id="text">
            <a href="{{ route('site.career') }}">
                <i class="fa-solid fa-arrow-left">
                    <span class="mr-1"></span>
                </i>Go Back
            </a>
        </p>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <h2 style="font-weight: 600;">{{ $job->title }}</h2>
                        <h5>Location: {{ $job->location }}</h5>
                        <h5>No of post: {{ $job->no_of_post }}</h5>
                    </div>
                    <div class="col-md-3">
                        <!-- Button trigger modal -->
                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#jobApplyModal">Apply
                            for this Job</button> --}}

                        <a href="{{route('site.job.apply', ['id' => Crypt::encrypt($job->id)])}}" type="button" class="btn btn-primary">Apply
                            for this Job</a>
                    </div>
                </div>
                <hr>

                <div>
                    {!! $job->description !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="container">
        <div class="modal fade" id="jobApplyModal" tabindex="-1" aria-labelledby="jobApplyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="jobApplyModalLabel" style="font-weight: 600;">Apply for this Position
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="careerApplyForm">
                        <input type="hidden" name="jobTitle" id="jobTitle" value="{{ $job->title }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Name<sup>*</sup></label>
                                        <input type="text" name="name" id="name" class="form-control shadow-none"
                                            placeholder="e.g. Jhon">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="email">Email<sup>*</sup></label>
                                        <input type="text" name="email" id="email" class="form-control shadow-none"
                                            placeholder="Email address">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="phone">Phone Number<sup>*</sup></label>
                                        <input type="text" name="phone" id="phone" class="form-control shadow-none"
                                            placeholder="10 digit phone number">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="dob">DOB<sup>*</sup></label>
                                        <input type="text" name="dob" id="dob" class="form-control shadow-none"
                                            placeholder="Date of birth">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Upload Resume* (Only pdf)</label>
                                        <input type="file" name="attachment" id="attachment" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="address">Address<sup>*</sup></label>
                                        <textarea name="address" id="address" class="form-control shadow-none" rows="3" type="text"
                                            placeholder="Enter Your Address"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="submitCareerFormBtn">Submit
                                Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJS')
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    <script>
        (function($) {
            $.fn.inputFilter = function(inputFilter) {
                return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    }
                });
            };
        }(jQuery));

        $("#phone").inputFilter(function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 9999999999);
        });
    </script>
    <script>
        $(function() {
            $("#dob").datepicker({
                changeYear: true,
                yearRange: "1900:+0",
                format: 'dd/mm/yyyy',
                maxDate: 0
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $.validator.addMethod('filesize', function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param * 1000000)
            }, 'File size must be less than {0} MB');

            $("#careerApplyForm").validate({
                rules: {
                    name: "required",
                    email: "required",
                    phone: "required",
                    dob: "required",
                    attachment: {
                        required: true,
                        extension: "pdf",
                        filesize: 1,
                    },
                    address: "required"
                },
                messages: {
                    name: "Name field cannot be null",
                    email: "Email field cannot be null",
                    phone: "Phone field cannot be null",
                    dob: "DOB field cannot be null",
                    attachment: {
                        required: "Please upload resume",
                        extension: "Only accepts pdf file",
                        maxsize: "File size must be less than 1MB",
                    },
                    address: "Address field csnnot be null",

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
                    let btn = $('#submitCareerFormBtn');
                    btn.text('Please wait...');
                    btn.attr('disabled', true);
                    let formData = new FormData(form);
                    $.ajax({
                        method: 'post',
                        url: "{{ route('site.career.apply') }}",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data.status);
                            if (data.status === 200) {
                                Swal.fire(
                                    'Good job!',
                                    data.message,
                                    'success'
                                ).then(() => {
                                    $('#careerApplyForm')[0].reset();
                                    btn.text('Submit Application');
                                    btn.attr('disabled', false);
                                    $('#jobApplyModal').modal('toggle');
                                });
                            } else {
                                Swal.fire(
                                    'Error',
                                    data.message,
                                    'error'
                                ).then(() => {
                                    btn.text('Submit Application');
                                    btn.attr('disabled', false);
                                })
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
