<!-- resources/views/admin/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0tMDQ+i3F1cxU6RA91fh8AQPJu/tmqDjOMzWjVq/X9+kR/kRLtTwicketf(hRLtX)" crossorigin="anonymous">
</head>
<body>

<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Admin Dashboard</h1>
        <a href="{{ route('exportUsers') }}" class="btn btn-success btn-sm"><i class="bi bi-download"></i> Export Users</a>
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->firstname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phoneNumber }}</td>
                    <td>
                        <!-- Edit Icon (Assuming you have an edit route) -->
                        <a href="{{ route('edit.user', ['id' => $user->id]) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                        <!-- Delete Icon (Assuming you have a delete route and a delete method in your controller) -->
                        <form action="{{ route('delete.user', ['id' => $user->id]) }}" method="post" style="display: inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                        {{-- <a href="{{ route('export.user', ['id' => $user->id]) }}" class="btn btn-success btn-sm"><i class="bi bi-download"></i> Export</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-eQsziUeGJ8odl3Z+ldwNYn6v6Jv+X8fxnF7aa9GpEdpJv0mPLdGHYECab3LMAQFj" crossorigin="anonymous"></script>
</body>
</html>
