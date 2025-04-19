@extends('_layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <h1>Ticket History</h1>
            <p class="text-muted">Review your past supports here.</p>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="d-lg-flex d-md-flex d-sm-block justify-content-lg-end mb-3">
                <!-- Change the form method to GET -->
                <form action="{{ route('searchByDateAdmin') }}" method="GET">
                    <div class="row">
                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                            <label for="ticket_id">Search by Ticket ID</label>
                            <input type="text" id="ticket_id" name="ticket_id" class="form-control" value="{{ $ticket_id ?? '' }}" placeholder="Enter Ticket ID">
                        </div>
                    
                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                            <label for="date">Sort by Date</label>
                            <div class="input-group">
                                <input type="date" id="date" name="date" class="form-control" value="{{ $filter_date ?? '' }}">
                                <button class="btn btn-primary z-0" type="submit">Search</button>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="">
                    <a href="{{ route('adminHistory') }}" class="btn btn-outline-secondary ms-2 rounded-0 p-1">Reset</a>
                </div>

            </div>


        </div>
    </div>

    <!-- Ticket History Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="table-responsive-sm" style="overflow-x: auto;">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Ticket ID</th>
                            <th>Name</th>
                            <th>ID Number</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Last Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->ticket_id }}</td>
                                <td>{{ $ticket->user->lName }}</td>
                                <td>{{ $ticket->user->id_number}}</td>
                                <td>{{ $ticket->ticket_subj }}</td>
                                <td>{{ $ticket->ticket_description }}</td>
                                <td>{{ $ticket->location }}</td>
                                <td>{{ $ticket->priority }}</td>
                                <td>
                                    <span class="badge 
                                        @if($ticket->status == 'pending') bg-warning text-dark 
                                        @elseif($ticket->status == 'resolved') bg-success 
                                        @elseif($ticket->status == 'in-progress') bg-secondary 
                                        @endif
                                        text-white">{{ $ticket->status }}
                                    </span>
                                </td>
                                <td>{{ $ticket->created_at->format('M d, Y') }}</td>
                                <td>{{ $ticket->updated_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No tickets found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $tickets->links() }}
            </div>

        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
</script>
@endsection
