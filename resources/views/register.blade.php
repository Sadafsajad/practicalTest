<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Registration</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form id="registrationForm" class="border rounded mx-auto p-5 shadow-lg">
                    @csrf
                    <h2 class="text-center mb-5">Register Now</h2>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="firstname" class="form-label">First Name:</label>
                            <input type="text" name="firstname" id="firstname" pattern="[A-Za-z]+" required
                                class="form-control">
                        </div>
                        <div class="col">
                            <label for="lastname" class="form-label">Last Name:</label>
                            <input type="text" name="lastname" id="lastname" pattern="[A-Za-z]+" required
                                class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" name="email" id="email" required class="form-control mb-3">
                        </div>
                        <div class="col">
                            <label for="phoneNumber" class="form-label">Contact Number:</label>
                            <input type="text" name="phoneNumber" id="phoneNumber" pattern="[0-9]+" minlength="10" maxlength="15" required class="form-control mb-3">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="postcode" class="form-label">Postcode:</label>
                            <input type="text" name="postcode" id="postcode" required class="form-control mb-3">
                        </div>
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-select">
                                    <option value="1">Admin</option>
                                    <option value="2">User</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                           <label for="images" class="form-label">Images:</label>
                            <input type="file" name="images[]" id="images" multiple required class="form-control mb-3">
                        </div>
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="states" class="form-label">State</label>
                                <select name="states" id="states" class="form-select">
                    
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                             <label for="password" class="form-label">Password:</label>
                            <input type="password" name="password" id="password" minlength="6" required class="form-control mb-3">
                        </div>
                        <div class="col">
                            <label for="confirm_password" class="form-label">Confirm Password:</label>
                            <input type="password" name="confirm_password" id="confirm_password" minlength="6" required class="form-control mb-3"> 
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="align-items-center mb-3">
                                <label for="hobbies" class="form-label mr-6">Hobbies:</label>
                                <input type="checkbox" name="hobbies[]" value="reading" class="mr-5"> Reading
                                <input type="checkbox" name="hobbies[]" value="coding" class="mr-2"> Coding
                                <input type="checkbox" name="hobbies[]" value="traveling" class="mr-2"> Traveling
                            </div>
                        </div>
                        <div class="col">
                            <label for="gender" class="form-label mb-3">Gender:</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="gender" value="male"class="form-check-input" id="male">
                                <label for="male" class="form-check-label">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="gender" value="female" class="form-check-input" id="female">
                                <label for="female" class="form-check-label">Female</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
                <div class="container mt-5 mb-5">
    <div class="card-footer text-center">
        <a href="{{ route('login') }}" class="mt-3 d-block text-primary">Already have an account? Login.</a>
    </div>
</div>

            </div>
            
        </div>
    </div>

</body>

</html>
    <script>
        $(document).ready(function () {
            // Initialize Select2 for the role dropdown
            $('#role').select2();
            $('#states').select2();
            // Fetch states and populate the dropdown
            $.ajax({
                type: 'GET',
                url: '/getStates',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var statesDropdown = $('#states');
                    $.each(response, function (index, state) {
                        statesDropdown.append('<option value="' + state + '">' + state + '</option>');
                    });
                },
                error: function (error) {
                    console.log(error);
                }
            });

            $.validator.addMethod("alphanumeric", function (value, element) {
                return /^[a-zA-Z0-9\s]+$/i.test(value);
            }, "Please enter letters and numbers only.");

            $("#registrationForm").validate({
                rules: {
                    firstname: {
                        required: true,
                        alphanumeric: true,
                    },
                    lastname: {
                        required: true,
                        alphanumeric: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    contact: {
                        required: true,
                        number: true,
                    },
                    postcode: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 6,
                    },
                    confirm_password: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password",
                    },
                    gender: {
                        required: true,
                    },
                    images: {
                        required: true,
                    },

                },
                messages: {
                    firstname: {
                        required: "Please enter your first name",
                    },
                    lastname: {
                        required: "Please enter your last name",
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address",
                    },
                    contact: {
                        required: "Please enter your contact number",
                        number: "Please enter a valid contact number",
                    },
                    postcode: {
                        required: "Please enter your postcode",
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Password must be at least 6 characters",
                    },
                    confirm_password: {
                        required: "Please confirm your password",
                        minlength: "Password must be at least 6 characters",
                        equalTo: "Passwords do not match",
                    },
                    gender: {
                        required: "Please enter your gender",
                    },
                    images: {
                        required: "Please enter atleast one image",
                    },
                },
            });
        
            $('#registrationForm').on('submit', function (e) {
                e.preventDefault();

                var selectedHobbies = $('input[name="hobbies[]"]:checked').map(function () {
                    return this.value;
                }).get().join(',');
                var selectedState = $('#states').val();
                var selectedGender = $('input[name="gender"]:checked').val();

                var formData = new FormData();  // Create a new FormData object

                // Add form fields to FormData
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                formData.append('firstname', $('#firstname').val());
                formData.append('lastname', $('#lastname').val());
                formData.append('email', $('#email').val());
                formData.append('phoneNumber', $('#phoneNumber').val());
                formData.append('postcode', $('#postcode').val());
                formData.append('role', $('#role').val());
                formData.append('password', $('#password').val());
                formData.append('confirm_password', $('#confirm_password').val());
                formData.append('hobbies', selectedHobbies);
                formData.append('state', selectedState);
                formData.append('gender', selectedGender);

                // Add files to FormData
                var imagesInput = $('#images')[0];
                for (var i = 0; i < imagesInput.files.length; i++) {
                    formData.append('images[]', imagesInput.files[i]);
                }

                if ($("#registrationForm").valid()) {
                    $.ajax({
                        type: 'POST',
                        url: '/register',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function (response) {
                            console.log(response);
                            if (response.token) {
                                // Show flash message
                                // var flashMessage = $('<div class="alert alert-success">Registration successful. Please log in.</div>');
                                // $('body').append(flashMessage);
                                // Redirect to login page after a delay (you can adjust the delay as needed)
                                setTimeout(function () {
                                    window.location.href = '/login';
                                }, 1000); // 
                            }
                        },
                        error: function (error) {
                            // Handle error, e.g., show validation errors
                            console.log(error.responseJSON.errors);
                        }
                    });
                }
            });

        });
    </script>



</body>

</html>
