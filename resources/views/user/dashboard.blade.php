@extends('_layouts.user')

@section('content')
<div class="container mt-5">
    <!-- Dashboard Header -->
    <div class="row">
        <div class="col-12">
            <h1>Welcome, {{ $users->fName }}</h1>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mt-4">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Number of Tickets</h5>
                    <p class="card-text">{{ $ticketCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pending Tickets</h5>
                    <p class="card-text">{{ $ticketCountPending }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resolved Tickets</h5>
                    <p class="card-text">{{ $ticketCountResolved }}</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div style="max-width: 350px;" class="col-lg-6 col-md-12 mt-5">
            <p class="lead">Ticket Overview</p> 
            <canvas id="ticketStatusChart"></canvas>
        </div>
    
        <div style="max-width: 600px;" class="mt-5">
            <p class="lead">Your Ticket History</p> 
            <canvas id="ticketsOverTimeChart"></canvas>
        </div>
    </div>



    <hr>

    <!-- Submit Ticket Button -->
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('userCreateTicket') }}" class="btn btn-primary btn-lg">+ Submit a Ticket</a>
        </div>
    </div>


    

    <!-- Tickets List -->
    <div class="row mt-4">
        <div class="col-12">
            <h4>Your Tickets</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Category</th>
                        <th scope="col">Status</th>
                        <th scope="col">Last Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->ticket_id }}</td>
                            <td>{{ $ticket->ticket_subj }}</td>
                            <td>{{ $ticket->location }}</td>
                            <td>
                                @if ($ticket->status === 'resolved')
                                    <span class="badge bg-success text-white">{{ $ticket->status }}</span>
                                @elseif ($ticket->status === 'pending')
                                    <span class="badge bg-warning text-dark">{{ $ticket->status }}</span>
                                @else
                                    <span class="badge bg-secondary text-white">{{ $ticket->status }}</span>
                                @endif
                            </td>
                            <td>{{ $ticket->updated_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Knowledge Base / Help Center -->
    <div class="row mt-4">
        <div class="col-12">
            <h4>Need Help?</h4>
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('userHelpCenter') }}">Network Issues</a></li>
                <li class="list-group-item"><a href="{{ route('userHelpCenter') }}">Login Problems</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

    function pieChart() {
        const ctx = document.getElementById('ticketStatusChart').getContext('2d');

        const ticketStatusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Resolved', 'Pending', 'in-progress'],
                datasets: [{
                    data: [{{ $ticketCountResolved }}, {{ $ticketCountPending }}, {{ $ticketCountInProgress }}],
                    backgroundColor: ['#28a745', '#ffc107', '#6c757d'],
                    borderColor: ['#ffffff', '#ffffff'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    function barChart() {
        const ctxOverTime = document.getElementById('ticketsOverTimeChart').getContext('2d');

        const ticketsOverTimeChart = new Chart(ctxOverTime, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthsOverTime) !!},
                datasets: [{
                    label: 'Tickets Submitted',
                    data: {!! json_encode($ticketCountsOverTime) !!},
                    fill: false,
                    borderColor: '#007bff',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }

    $(document).ready(function() {
        pieChart();
        barChart();
    });

</script>
@endsection

