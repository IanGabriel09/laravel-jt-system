@extends('_layouts.user')

@section('content')
<div class="container mt-5">
    <!-- Page Header -->
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <h1>Ticket History</h1>
            <p class="text-muted">Review your past support requests here.</p>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="d-flex justify-content-lg-end mb-3">
                <!-- Change the form method to GET -->
                <form action="{{ route('searchByDate') }}" method="GET">
                    <label for="date">Sort by Date</label>
                    <div class="input-group mb-3">
                        <input type="date" id="date" name="date" class="form-control" value="{{ $filter_date ?? '' }}">
                        <button class="btn btn-primary z-0" type="submit">Search</button>
                    </div>
                </form>
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
