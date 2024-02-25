<!-- resources/views/user_dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">User Dashboard</h3>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center">
                        <?php
                            $imagePaths = explode(',', $user->images);
                            $firstImagePath = isset($imagePaths[0]) ? $imagePaths[0] : '';
                        ?>
                        <img src="{{ url("/$firstImagePath") }}" alt="User Image" class="img-fluid rounded">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-4">Welcome, {{ $user->firstname }} {{ $user->lastname }}!</h2>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Gender:</strong> {{ $user->gender }}
                            </li>
                            <li class="list-group-item">
                                <strong>Phone Number:</strong> {{ $user->phoneNumber }}
                            </li>
                            <li class="list-group-item">
                                <strong>status:</strong> {{ $user->status }}
                            </li>
                            <!-- Add more user details as needed -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>

</body>

</html>
