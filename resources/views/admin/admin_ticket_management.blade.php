@extends('_layouts.app')

@section('content')
<div class="container mt-5">


    {{-- Ticket Form --}}
    <div class="row">
        <div class="col-lg-9 col-md-12">
            {{-- Page Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Create New Ticket</h2>
                <a href="{{ route('adminHome') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-0 left-border-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-0 left-border-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
        
            <div class="card">
    
    
                <div class="card-header">
                    <strong>Ticket Details</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('submitTicketAdmin') }}" method="POST">
                        @csrf
                        <div class="row">
                            {{-- Assigned User (Optional) --}}
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="" class="form-label">Assign to:</label>
                                <select class="form-select" id="assigned_to" name="assigned_to">
                                    <option value="" selected disabled>Select user</option>
                                    @forelse ($users as $user)
                                        <option value="{{ $user->id_number }}">{{ $user->fName }} {{ $user->lName }}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                            </div>
        
                            {{-- Priority --}}
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="" class="form-label">Priority</label>
                                <select class="form-select" id="priority" name="priority">
                                    <option selected disabled>Select priority</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                    <option value="urgent">Urgent</option>
                                </select>
                            </div>
                            
                            {{-- Location --}}
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="" class="form-label">Location</label>
                                <input type="text" id="location" name="location" class="form-control" placeholder="Location of Job request">
                            </div>
        
                            {{-- Subject --}}
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <label for="" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="ticket_subj" name="ticket_subj" placeholder="Enter ticket subject">
                            </div>
        
                            {{-- Description --}}
                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe the issue or request..."></textarea>
                            </div>
        
        
                            {{-- Submit Button --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Create Ticket</button>
                            </div>
                        </div>
        
        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h4>Pending Tickets</h4>
            <p class="text-muted">
                Full list of pending tickets below.
            </p>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Submitted By</th>
                            <th>Subject</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendingTickets as $pendingTicket)
                            <tr>
                                <td>{{ $pendingTicket->ticket_id }}</td>
                                <td>{{ $pendingTicket->user->fName }} {{ $pendingTicket->user->lName }}</td>
                                <td>{{ $pendingTicket->ticket_subj }}</td>
                                <td>{{ $pendingTicket->location }}</td>
                                <td>
                                    @if ($pendingTicket->status === 'resolved')
                                        <span class="badge bg-success text-white">{{ $pendingTicket->status }}</span>
                                    @elseif ($pendingTicket->status === 'pending')
                                        <span class="badge bg-warning text-dark">{{ $pendingTicket->status }}</span>
                                    @else
                                        <span class="badge bg-secondary text-white">{{ $pendingTicket->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $pendingTicket->updated_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No tickets found.</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $pendingTickets->links() }}
                </div>
            </div>
        </div>
    </div>
    


</div>
@endsection

@section('scripts')
<script>
    console.log(@json($departments));
</script>
@endsection
