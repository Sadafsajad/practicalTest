<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0tMDQ+i3F1cxU6RA91fh8AQPJu/tmqDjOMzWjVq/X9+kR/kRLtTwicketf(hRLtX)" crossorigin="anonymous">
</head>
<body>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card rounded shadow-lg p-4 mx-auto">
                    <h2 class="text-center mb-4">Login</h2>
                    <form id="loginForm"method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <a href="{{ route('register') }}" class="mt-3 d-block text-center text-primary">Don't have an account? Register here.</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
$('#loginForm').on('submit', function (e) {
    e.preventDefault();

    var formData = {
        email: $('#email').val(),
        password: $('#password').val(),
    };

    $.ajax({
        type: 'POST',
        url: '/login',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function (response) {
        
        },
        error: function (error) {
            // Handle error, e.g., show validation errors or unauthorized message
            console.log(error.responseJSON.error);
        }
    });
});
</script>