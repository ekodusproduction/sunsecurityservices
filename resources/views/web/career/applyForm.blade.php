@extends('web.common.main')

@section('title', 'Career | Application form')

@section('customHeader')
    <style>
        body {
            background: #fff;
        }

        h3 {
            font-weight: 500;
            text-transform: capitalize;
            color: rgb(73, 73, 73)
        }

        #jobApplyForm label {
            font-size: 13px
        }

        #jobApplyForm ::placeholder,
        #jobApplyForm [type=file] {
            font-size: 12px
        }

        #jobApplyForm .form-control {
            min-height: 45px;
            border-radius: 0
        }

        #submitBtn {
            font-size: 12px;
            text-transform: uppercase;
            padding: 15px 30px;
            border-radius: 0
        }

    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endsection

@section('main')
    <div class="container" id="jpbApplyDiv">
        <div class="col-md-8 mx-auto">
            <h3>Job application form</h3>
            <p class="text-muted">Please fill the form carefully</p>
            <form id="jobApplyForm">
                <div class="mb-3">
                    <label for="post_title" class="form-label text-muted">Post name<sup>*</sup></label>
                    <input type="text" class="form-control shadow-none" id="post_title" name="post_title"
                        placeholder="Post title" value="{{ $job->title }}" readonly autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label text-muted">Name (Block letters)<sup>*</sup></label>
                    <input type="text" class="form-control shadow-none" id="name" name="name" placeholder="Enter your name"
                        autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="father_name" class="form-label text-muted">Father's name<sup>*</sup></label>
                    <input type="text" class="form-control shadow-none" id="father_name" name="father_name"
                        placeholder="Enter your father's name" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="mother_name" class="form-label text-muted">Mother's name<sup>*</sup></label>
                    <input type="text" class="form-control shadow-none" id="mother_name" name="mother_name"
                        placeholder="Enter your mother's name" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-muted">Email<sup>*</sup></label>
                    <input type="text" class="form-control shadow-none" id="email" name="email"
                        placeholder="eg. name@gmail.com" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label text-muted">Phone number<sup>*</sup></label>
                    <input type="text" class="form-control shadow-none" id="phone" name="phone"
                        placeholder="Enter 10 digit valid phone number" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="dob" class="form-label text-muted">Date of birth<sup>*</sup></label>
                    <input type="text" class="form-control shadow-none" id="dob" name="dob" placeholder="Date of birth"
                        autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="education" class="form-label text-muted">Educational qualification<sup>*</sup></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="education_type" value="Military">
                        <label class="form-check-label">
                            Military
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="education_type" value="Civilian" checked>
                        <label class="form-check-label">
                            Civilian
                        </label>
                    </div>
                    <input type="text" class="form-control shadow-none" id="education" name="education"
                        placeholder="eg. Graduate" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="experience" class="form-label text-muted">Work experience (in years)<sup>*</sup></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="experience_field" value="Army">
                        <label class="form-check-label">
                            Army
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="experience_field" value="Navy">
                        <label class="form-check-label">
                            Navy
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="experience_field" value="Air Force">
                        <label class="form-check-label">
                            Air Force
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="experience_field" value="Home Guard">
                        <label class="form-check-label">
                            Home Guard
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="experience_field" value="Civilian">
                        <label class="form-check-label">
                            Civilian
                        </label>
                    </div>
                    <input type="text" class="form-control shadow-none" id="experience" name="experience"
                        placeholder="eg. 1 year" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="education" class="form-label text-muted">Marital status<sup>*</sup></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="marital_status" value="Married">
                        <label class="form-check-label">
                            Married
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="marital_status" value="Single">
                        <label class="form-check-label">
                            Single
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Resume</label>
                    <input class="form-control" type="file" id="attachment" name="attachment">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address<sup>*</sup></label>
                    <textarea class="form-control shadow-none" id="address" name="address" rows="5"></textarea>
                </div>

                <div class="mb-3">
                    <label for="pin" class="form-label text-muted">PIN Code<sup>*</sup></label>
                    <input type="text" class="form-control shadow-none" id="pin" name="pin" placeholder="Enter PIN Code"
                        autocomplete="off">
                </div>

                <button type="submit" class="btn btn-primary" id="submitBtn">Submit Application</button>
            </form>
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

        $("#pin").inputFilter(function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 999999);
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

            $("#jobApplyForm").validate({
                rules: {
                    post_title: "required",
                    name: "required",
                    father_name: "required",
                    mother_name: "required",
                    email: "required",
                    phone: "required",
                    dob: "required",
                    education: "required",
                    experience: "required",
                    address: "required",
                    pin: "required",
                    attachment: {
                        extension: "pdf",
                        filesize: 1,
                    }
                },
                messages: {
                    post_title: "Post title can not be null",
                    name: "Name field can not be null",
                    father_name: "Father's name can not be null",
                    mother_name: "Mother's name can not be null",
                    email: "Email field can not be null",
                    phone: "Phone field can not be null",
                    dob: "DOB field can not be null",
                    education: "Education can not be null",
                    experience: "Experience can not be null",
                    address: "Address field can not be null",
                    pin: "PIN Code field can not be null",
                    attachment: {
                        extension: "Only accepts pdf file",
                        maxsize: "File size must be less than 1MB",
                    },
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
                    if (!$('input[name=experience_field]').is(":checked")) {
                        Swal.fire(
                            'Error',
                            'Please select one from work experience',
                            'error'
                        )
                    } else if (!$('input[name=marital_status]').is(":checked")) {
                        Swal.fire(
                            'Error',
                            'Please select your marital status',
                            'error'
                        )
                    } else {
                        e.preventDefault();
                        let btn = $('#submitBtn');
                        btn.text('Please wait...');
                        btn.attr('disabled', true);
                        let formData = new FormData(form);
                        $.ajax({
                            method: 'post',
                            url: "{{ route('site.job.apply.submit') }}",
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
                                        $('#jobApplyForm')[0].reset();
                                        btn.text('Submit Application');
                                        btn.attr('disabled', false);
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
                }
            });
        });
    </script>
@endsection
