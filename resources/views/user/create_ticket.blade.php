@extends('_layouts.user')

@section('content')
<div class="container mt-5">
    <!-- Page Header -->
    <div class="row">
        <div class="col-12">
            <h1>Create a New Ticket</h1>
            <p>Please fill out the form below to submit a new support request.</p>
        </div>
    </div>

    <!-- Create Ticket Form -->
    <div class="row mt-4">
        <div class="col-12 col-md-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-0 left-border-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-0 left-border-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('submitTicket') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Subject -->
                <div class="form-group">
                    <label for="subject">Ticket Subject</label>
                    <input type="text" class="form-control" id="ticketSubject" name="ticketSubject" placeholder="e.g. No Network Connection" required>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="ticketDescription" name="ticketDescription" rows="4" placeholder="Describe the issue in detail" required></textarea>
                </div>

                <!-- Subject -->
                <div class="form-group">
                    <label for="subject">Location</label>
                    <input type="text" class="form-control" id="ticketLocation" name="ticketLocation" placeholder="e.g. KFCP 2nd Floor" required>
                </div>

                <!-- Priority -->
                <div class="form-group">
                    <label for="priority">Priority</label>
                    <select class="form-control" id="priority" name="priority" required>
                        <option>Low</option>
                        <option>Medium</option>
                        <option>High</option>
                        <option>Urgent</option>
                    </select>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary btn-lg mt-3">Submit Ticket</button>
                <button class="d-none btn btn-primary btn-lg mt-3" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span role="status">Loading...</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Recent Tickets (Static Mockup) -->
    <div class="row mt-5">
        <div class="col-12">
            <h4>Recent Tickets</h4>
            <p class="text-muted">Showing your 5 most recent tickets. For full history, visit the <a href="{{ route('userHistory') }}">History</a> tab.</p>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Ticket ID</th>
                            <th>Subject</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($error))
                            <tr>
                                <td colspan="100%" class="text-center bg-danger text-white" role="alert">
                                    {{ $error }}
                                </td>
                            </tr>
                        @endif
                    
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->ticket_id }}</td>
                                <td>{{ $user->ticket_subj }}</td>
                                <td>{{ $user->location }}</td>
                                <td>
                                    @if ($user->status === 'resolved')
                                        <span class="badge bg-success text-white">{{ $user->status }}</span>
                                    @elseif ($user->status === 'pending')
                                        <span class="badge bg-warning text-dark">{{ $user->status }}</span>
                                    @elseif ($user->status === 'in-progress')
                                        <span class="badge bg-secondary text-white">{{ $user->status }}</span>   
                                    @endif
                                </td>
                                <td>{{ $user->updated_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach

                    

                    </tbody>
                </table>


            
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('form').on('submit', function () {
                // Add d-none to the submit button
                $(this).find('button[type="submit"]').addClass('d-none');

                // Remove d-none from the loading spinner button
                $(this).find('button[type="button"]').removeClass('d-none');
            });
        });
    </script>
@endsection

