<!-- resources/views/admin/edit-user.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0tMDQ+i3F1cxU6RA91fh8AQPJu/tmqDjOMzWjVq/X9+kR/kRLtTwicketf(hRLtX)" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
    <h1>Edit User</h1>

    <form action="{{ route('update.user', ['id' => $user->id]) }}" method="post">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $user->firstname }}">
        </div>

        <div class="mb-3">
            <label for="phoneNumber" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ $user->phoneNumber }}">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select name="status" id="status" class="form-select">
                <option value="pending" @if($user->status == 'pending') selected @endif>pending</option>
                <option value="inprogress" @if($user->status == 'inprogress') selected @endif>inprogress</option>
                <option value="completed" @if($user->status == 'completed') selected @endif>completed</option>
            </select>
        </div>
        <!-- Add other fields as needed -->

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-eQsziUeGJ8odl3Z+ldwNYn6v6Jv+X8fxnF7aa9GpEdpJv0mPLdGHYECab3LMAQFj" crossorigin="anonymous"></script>
</body>
</html>
