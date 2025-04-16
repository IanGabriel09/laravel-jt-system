@extends('_layouts.app')

@section('content')
<div class="container mt-5">

    {{-- Dashboard Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        <a href="{{ route('adminCreateTicket') }}" class="btn btn-outline-primary">Create New Ticket</a>
    </div>

    {{-- Summary Cards --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title">Total Tickets</h6>
                    <p class="h4">{{ $tickets }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title">Pending Tickets</h6>
                    <p class="h4">{{ $pendingTickets }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title">Resolved Tickets</h6>
                    <p class="h4">{{ $resolvedTickets }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border">
                <div class="card-body">
                    <h6 class="card-title">Urgent Tickets</h6>
                    <p class="h4">{{ $urgentTickets }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="mb-4 d-flex gap-2">
        <a href="{{ route('adminCreateTicket') }}" class="btn btn-secondary">Manage Tickets</a>
        <a href="{{ route('userManagement') }}" class="btn btn-outline-dark">Manage Users</a>
    </div>

    <div class="row">
        {{-- Main Content --}}
        <div class="col-lg-8 mb-3">
            {{-- Recent Tickets Table --}}
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Recently Uploaded Tickets</strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Ticket ID</th>
                                <th>User Name</th>
                                <th>Subject</th>
                                <th>Priority</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Sample ticket rows (can be replaced with dynamic data) --}}
                            @foreach ($recentTickets as $recentTicket)
                                <tr>
                                    <td>{{ $recentTicket->ticket_id }}</td>
                                    <td>
                                        @if ($recentTicket->user)
                                            {{ $recentTicket->user->fName }} {{ $recentTicket->user->lName }}
                                        @else
                                            <span class="text-muted">Unknown User</span>
                                        @endif
                                    </td>
                                    <td>{{ $recentTicket->ticket_subj }}</td>
                                    <td>{{ $recentTicket->priority }}</td>
                                    <td>
                                        @if ($recentTicket->status === 'resolved')
                                            <span class="badge bg-success text-white">{{ $recentTicket->status }}</span>
                                        @elseif ($recentTicket->status === 'pending')
                                            <span class="badge bg-warning text-dark">{{ $recentTicket->status }}</span>
                                        @else
                                            <span class="badge bg-secondary text-white">{{ $recentTicket->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Placeholder for Chart --}}
            <div class="card">
                <div class="card-header">
                    <strong>Ticket Status Overview</strong>
                </div>
                <div class="card-body text-center" style="height: 200px;">
                    <em>(Chart Coming Soon...)</em>
                </div>
            </div>
        </div>

        {{-- Sidebar / Activity Feed --}}
        <div class="col-lg-4">
            {{-- Open Tickets by Location --}}
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Open Tickets by Department</strong>
                </div>
                <div class="card-body">
                    <div class="overflow-auto" style="max-height: 188px;">
                        <ul class="list-group list-group-flush">
                            @forelse ($departments as $dept => $count)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $dept }}
                                <span class="badge bg-primary rounded-pill">{{ $count }}</span>
                                </li>
                            @empty
                            <li class="list-group-item"><i>No Pending tickets by department</i></li> 
                            @endforelse

                        </ul>
                    </div>

                </div>
            </div>


            {{-- Quick Stats --}}
            <div class="card">
                <div class="card-header">
                    <strong>System Stats</strong>
                </div>
                <div class="card-body">
                    <p><strong>Users:</strong> {{ $userCount }}</p>
                    <p><strong>Tickets Uploaded Today:</strong> {{ $currentDateTickets }}</p>
                    <p><strong>Avg Resolution Time:</strong> {{ $formattedTimeAve }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
</script>
@endsection
