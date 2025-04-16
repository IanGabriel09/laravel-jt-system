@extends('_layouts.app')

@section('content')
<div class="container mt-5 pt-4">
    <h2 class="mb-4">User Management</h2>

    <!-- Unauthorized Users Table -->
    <div class="card mb-5 shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Unauthorized Users</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Registered At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>Guest</td>
                            <td>2025-04-10</td>
                            <td>
                                <button class="btn btn-sm btn-success">Authorize</button>
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>jane@example.com</td>
                            <td>Guest</td>
                            <td>2025-04-12</td>
                            <td>
                                <button class="btn btn-sm btn-success">Authorize</button>
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Mike Chan</td>
                            <td>mikec@example.com</td>
                            <td>Guest</td>
                            <td>2025-04-13</td>
                            <td>
                                <button class="btn btn-sm btn-success">Authorize</button>
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Emily Rivera</td>
                            <td>emilyr@example.com</td>
                            <td>Guest</td>
                            <td>2025-04-14</td>
                            <td>
                                <button class="btn btn-sm btn-success">Authorize</button>
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <hr>

    <!-- All Users Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-info bg-gradient text-white">
            <h5 class="mb-0">All Users</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0 table-hover table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Registered At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Admin User</td>
                            <td>admin@example.com</td>
                            <td>Admin</td>
                            <td><span class="badge bg-success">Authorized</span></td>
                            <td>2025-01-15</td>
                            <td>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Regular User</td>
                            <td>user@example.com</td>
                            <td>User</td>
                            <td><span class="badge bg-success">Authorized</span></td>
                            <td>2025-03-01</td>
                            <td>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Mark Anthony</td>
                            <td>marka@example.com</td>
                            <td>User</td>
                            <td><span class="badge bg-success">Authorized</span></td>
                            <td>2025-02-10</td>
                            <td>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Sarah Lim</td>
                            <td>sarah@example.com</td>
                            <td>Moderator</td>
                            <td><span class="badge bg-success">Authorized</span></td>
                            <td>2025-01-20</td>
                            <td>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Kevin Tan</td>
                            <td>kevint@example.com</td>
                            <td>User</td>
                            <td><span class="badge bg-success">Authorized</span></td>
                            <td>2025-03-22</td>
                            <td>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
