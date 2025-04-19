<?php

namespace App\Http\Controllers;

// Mailers
use App\Mail\UserAuthorizedMail;
use App\Mail\TicketResolvedMail;

// Models
use App\Models\ticket;
use App\Models\Users_KFCP;

// Libraries
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AdminController extends Controller
{
    // ----------------------- //
    // ----Admin Dashboard-----//
    // ----------------------- //
    public function fetchDashboardData() 
    {
        $tickets = ticket::count();
        $pendingTickets = ticket::where('status', 'pending')->count();
        $resolvedTickets = ticket::where('status', 'resolved')->count();
        $urgentTickets = ticket::where('priority', 'Urgent')->count();
        $userCount = Users_KFCP::count();
        $currentDateTickets = ticket::whereDate('created_at', Carbon::today())->count();

        // Get the 3 most recent tickets, only if the related user is authorized
        $recentTickets = ticket::with('user')
            ->whereHas('user', fn($query) => $query->whereNotNull('is_authorized'))
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Get pending tickets by department, only if the related user is authorized
        $pendingTicketsByDepartment = ticket::where('status', 'pending')
            ->whereHas('user', fn($query) => $query->whereNotNull('is_authorized'))
            ->with('user')
            ->get()
            ->groupBy(fn($ticket) => $ticket->user->department ?? 'Unknown')
            ->map(fn($group) => $group->count());


        // Average time calculation
        $ticketTimeDiff = [];
        $ticketsAll = ticket::all();

        $sum = 0;
        $count = 0;

        foreach ($ticketsAll as $ticket) {
            $createdAt = $ticket->created_at;
            $updatedAt = $ticket->updated_at;

            $timeDiff = $createdAt->diffInMinutes($updatedAt);
            $sum += $timeDiff;
            $count++;

            $ticketTimeDiff[] =[
                'timeDiff' => $timeDiff
            ];
        }

        $timeAve = $count > 0 ? round($sum / $count) : 0;

        if ($timeAve >= 60) {
            $hours = floor($timeAve / 60);
            $minutes = $timeAve % 60;
        
            $formattedTimeAve = $hours . 'hr' . ($hours > 1 ? 's' : '');
            if ($minutes > 0) {
                $formattedTimeAve .= ' ' . $minutes . ' min' . ($minutes > 1 ? 's' : '');
            }
        } else {
            $formattedTimeAve = $timeAve . ' min' . ($timeAve != 1 ? 's' : '');
        }

        return view('admin.admin_dashboard', [
            'tickets' => $tickets,
            'pendingTickets' => $pendingTickets, 
            'resolvedTickets' => $resolvedTickets,
            'urgentTickets' => $urgentTickets,
            'userCount' => $userCount,
            'timeAve' => $timeAve,
            'formattedTimeAve' => $formattedTimeAve,
            'recentTickets' => $recentTickets,
            'departments' => $pendingTicketsByDepartment,
            'currentDateTickets' => $currentDateTickets
        ]);
    }

    // ----------------------- //
    // ---Ticket Management ---//
    // ----------------------- //
    public function ticketManagement()
    {
        $users = Users_KFCP::all();
        $departments = Users_KFCP::select('department')
            ->distinct()
            ->orderBy('department', 'asc')
            ->get();
        $pendingTickets = ticket::where('status', 'pending')
            ->whereHas('user', fn($query) => $query->whereNotNull('is_authorized'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.admin_ticket_management', [
            'pendingTickets' => $pendingTickets,
            'users' => $users,
            'departments' => $departments
        ]);
    }

    public function submitTicket(Request $request)
    {
        $validated = $request->validate([
            'assigned_to' => 'required',
            'priority' => 'required',
            'location' => 'required',
            'ticket_subj' => 'required',
            'description' => 'required',
        ]);

        $ticket_id = 'JT-' . substr(Str::uuid()->toString(), 0, 8);

        try {
            $ticket = ticket::create([
                'ticket_id' => $ticket_id,
                'user_id' => $validated['assigned_to'],
                'priority' => $validated['priority'],
                'location' => $validated['location'],
                'ticket_subj'   => $validated['ticket_subj'],
                'ticket_description' => $validated['description'],
                'status' => 'pending',
            ]);
    
            Log::info("Ticket created: " . $ticket_id);
    
            return redirect()->back()->with('success', 'Job ticket has been successfully submitted.');
        } catch (\Exception $e) {
            Log::error("Ticket creation failed: " . $e->getMessage());
    
            return redirect()->back()->with('error', 'There was a problem submitting a ticket. Please try again.');
        }
    }

    public function resolveTicket($id)
    {
        $ticket = ticket::findOrFail($id);
    
        if ($ticket->status !== 'resolved') {
            $ticket->status = 'resolved';
            $ticket->save();
    
            $user = $ticket->user; // Access related user via the relationship
    
            if ($user) {
                Mail::to($user->email)->send(new TicketResolvedMail($user, $ticket));
            }
    
            return redirect()->back()->with('success', 'Ticket marked as resolved.');
        }
    
        return redirect()->back()->with('error', 'Ticket is already resolved.');
    }

    // ----------------------- //
    // ----User Management ----//
    // ----------------------- //
    public function fetchUserData()
    {
        $unauthorizedUsers = Users_KFCP::where('is_authorized', NULL)
            ->paginate(5, ['*'], 'unauthPage');

        $allUsers = Users_KFCP::where('is_authorized', 'authorized')
            ->paginate(10, ['*'], 'allPage');

        // Logging
        Log::info('Unauthorized Users:', $unauthorizedUsers->items());
        Log::info('All Users:', $allUsers->items());

        return view('admin.admin_user_management', compact('unauthorizedUsers', 'allUsers'));
    }

    public function authorizeUser($id)
    {
        $user = Users_KFCP::findOrFail($id);
        $user->is_authorized = 'authorized';
        $user->save();

        Mail::to($user->email)->send(new UserAuthorizedMail($user));

        return redirect()->route('userManagement')->with('success', 'User authorized successfully');
    }

    public function deleteUser($id)
    {
        $user = Users_KFCP::findOrFail($id);
        $user->delete();

        return redirect()->route('userManagement')->with('success', 'User deleted successfully');
    }

    public function unauthorizeUser($id)
    {
        $user = Users_KFCP::findOrFail($id);
        $user->is_authorized = null;
        $user->save();
    
        return redirect()->route('userManagement')->with('success', 'User unauthorized successfully.');
    }

    // ----------------------- //
    // ------History page -----//
    // ----------------------- //

    public function fetchHistory()
    {
        // Retrieve all tickets, most recent first, paginated (10 per page)
        $tickets = ticket::orderBy('created_at', 'desc')
            ->whereHas('user', fn($query) => $query->whereNotNull('is_authorized'))
            ->paginate(10); // 10 tickets per page
    
        // Return to the view with the paginated tickets
        return view('admin.admin_history', compact('tickets'));
    }

    public function searchByDateAdmin(Request $request)
    {
        $filter_date = $request->date;
    
        $query = ticket::query()
            ->whereHas('user', fn($query) => $query->whereNotNull('is_authorized')); // Apply whereHas here
    
        if (!empty($filter_date)) {
            $query->whereDate('created_at', $filter_date);
        }
    
        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);
        $tickets->appends(['date' => $filter_date]); // Keeps the filter during pagination
    
        return view('admin.admin_history', compact('tickets', 'filter_date'));
    }
    

    
    
}
