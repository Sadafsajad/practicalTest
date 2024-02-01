<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Page Title</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your existing styles -->
    <style>
        body {
            background-color: #000;
            background-image: url('https://img.freepik.com/free-photo/navy-blue-smoky-art-abstract-background_53876-102669.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .text-container {
            text-align: center;
            color: #fff;
            max-width: 500px;
            margin: 0 auto;
        }

        .text-container img {
            max-width: 100px;
            margin-bottom: 20px;
        }

        .text-container a.btn {
            margin-top: 10px;
        }
    </style>
</head>
<body class="antialiased">
    <div class="text-container">
        <h3>Welcome to Practical Test</h3>
        <p>Explore the key features of our application:</p>
        
        <h5>User Registration:</h5>
        <p>Enjoy a seamless registration process with jQuery and form validation. Express yourself by selecting multiple images and hobbies. Experience dynamic state selection using AJAX.</p>

        <h5>User and Admin Login:</h5>
        <p>Conveniently log in as a user or admin based on the role you chose during registration. Use the provided credentials or register as a new user.</p>

        <h5>Admin Dashboard:</h5>
        <p>Admins can effortlessly view, delete, update, and export user data.</p>

        <h5>User Dashboard:</h5>
        <p>Users have access to their details, providing a personalized experience.</p>

        <h5>Additional Features:</h5>
        <p>Enjoy features like logout functionality, pivot table usage, token authentication, migrations, seeders, and more.</p>

        @if (Route::has('login'))
            <div class="text-center">
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-primary">Home</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <!-- Bootstrap JS and Popper.js (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
