
@section('content')
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th>{{ $user->id }}</th>
                                <th>{{ $user->name }}</th>
                                <th>{{ $user->email }}</th>
                                <th>
                                    <a href="{{ route('user.readUser', ['id' => $user->id]) }}">View</a> |
                                    <a href="{{ route('user.updateUser', ['id' => $user->id]) }}">Edit</a> |
                                    <a href="{{ route('user.deleteUser', ['id' => $user->id]) }}">Delete</a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Laravel Training - User Management</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <style>
            body {
                background-color: #f8f9fa;
                font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            }
            .navbar-brand {
                font-weight: bold;
                font-size: 1.5rem;
            }
            .user-info {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin-bottom: 30px;
            }
            .table-container {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
            }
            .table {
                margin-bottom: 0;
            }
            .table th {
                background-color: #f1f1f1;
                font-weight: 600;
            }
            .action-btns .btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
                margin-right: 5px;
            }
            .user-email {
                font-weight: 500;
                color: #6c757d;
            }
        </style>
    </head>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Laravel Training</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3 user-email">{{ Auth::user()->email }}</span>
                <a href="{{ route('signout') }}" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="user-info">
            <h4 class="mb-4">User Management</h4>
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-0">Total users: {{ $users->count() }}</p>
                <a href="{{ route('user.createUser') }}" class="btn btn-primary">Add New User</a>
            </div>
        </div>

        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td class="action-btns">
                                <a href="{{ route('user.readUser', ['id' => $user->id]) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('user.updateUser', ['id' => $user->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('user.deleteUser', ['id' => $user->id]) }}" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<
