@extends('_layouts.app')

@section('content')

<!-- Fixed Spinner with Loading Text -->
<div class="custom-blur-overlay" id="blurOverlay"></div>
<div class="custom-fixed-spinner" id="loadingSpinner">
    <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<div class="container mt-5 pt-4">
    <h2 class="mb-4">User Management</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-0 left-border-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-0 left-border-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Unauthorized Users Table -->
    <div class="card mb-5 shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">Unauthorized Users</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Registered At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($unauthorizedUsers as $index => $user)
                        <tr>
                            <td>{{ $allUsers->firstItem() + $index }}</td>
                            <td>{{ $user->fName }} {{ $user->lName }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->department }}</td>
                            <td>{{ $user->position }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('userAuthorize', $user->id) }}" method="POST" class="d-inline authorize-form">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-success">Authorize</button>
                                </form>

                                <form action="{{ route('userDelete', $user->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No unauthorized users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $unauthorizedUsers->appends(request()->except('unauthPage'))->links() }}
            </div>
        </div>
    </div>

    <hr>

    <!-- All Users Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-info bg-gradient text-white">
            <h5 class="mb-0">Authorized Users</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Registered At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allUsers as $index => $user)
                        <tr>
                            <td>{{ $allUsers->firstItem() + $index }}</td>
                            <td>{{ $user->fName }} {{ $user->lName }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->department }}</td>
                            <td>{{ $user->position }}</td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $user->is_authorized }}
                                </span>
                            </td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('userUnauthorize', $user->id) }}" method="POST" class="d-inline unauthorize-form">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-danger">Remove</button>
                                </form>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $allUsers->appends(request()->except('allPage'))->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('form.authorize-form').on('submit', function (e) {
                if (!confirm('Authorize this user?')) {
                    e.preventDefault();
                    return;
                }
                showLoader();
            });

            $('form.delete-form').on('submit', function (e) {
                if (!confirm('Delete this user?')) {
                    e.preventDefault();
                    return;
                }
                showLoader();
            });

            $('form.unauthorize-form').on('submit', function (e) {
                if (!confirm('Mark this user as unauthorized?')) {
                    e.preventDefault();
                    return;
                }
                showLoader();
            });

            function showLoader() {
                $('body').addClass('loading');
                $('#loadingSpinner').show();
                $('#blurOverlay').show();
            }
        });


    </script>
@endsection
