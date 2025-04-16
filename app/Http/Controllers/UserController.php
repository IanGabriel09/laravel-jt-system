<?php

namespace App\Http\Controllers;

// Models
use App\Models\ticket;
use App\Models\Users_KFCP;


// Libraries
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; 

class UserController extends Controller
{
    // ----------------------- //
    // -----Dashboard page ----//
    // ----------------------- //

    public function dashboardInfo(Request $request) 
    {
        $sessionID = $request->session()->get('loginId');
    
        // User data
        $users = Users_KFCP::where('id_number', $sessionID)->first();
    
        // Ticket counts
        $ticketCount = ticket::where('user_id', $sessionID)->count();
        $ticketCountPending = ticket::where('user_id', $sessionID)
            ->where('status', 'pending')
            ->count();
        $ticketCountResolved = ticket::where('user_id', $sessionID)
            ->where('status', 'resolved')
            ->count();
        $ticketCountInProgress = ticket::where('user_id', $sessionID)
            ->where('status', 'in-progress')
            ->count();
        
        // Partial Ticket data
        $tickets = ticket::where('user_id', $sessionID)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
    
        // 📈 Ticket History by Month (current year)
        $currentYear = now()->year;
        $ticketHistory = ticket::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->where('user_id', $sessionID)
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month'); // e.g. [1 => 3, 3 => 2, 4 => 1]
    
        $months = [];
        $ticketCountsOverTime = [];
    
        foreach (range(1, 12) as $m) {
            $months[] = Carbon::create()->month($m)->format('F'); // "January", "February", etc.
            $ticketCountsOverTime[] = $ticketHistory[$m] ?? 0;
        }
    
        return view('user.dashboard', [
            'ticketCount' => $ticketCount,
            'ticketCountPending' => $ticketCountPending,
            'ticketCountResolved' => $ticketCountResolved,
            'ticketCountInProgress' => $ticketCountInProgress,
            'users' => $users,
            'tickets' => $tickets,
            'monthsOverTime' => $months,
            'ticketCountsOverTime' => $ticketCountsOverTime
        ]);
    }
    
    // ----------------------- //
    // ------Ticket page ------//
    // ----------------------- //
    public function fetchTickets(Request $request)
    {
        $sessionID = $request->session()->get('loginId');
        
        // Fetch user(s) by sessionID
        $users = ticket::where('user_id', $sessionID)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    
        if ($users->isEmpty()) {
            $error = 'No JT data found for this account';
            return view('user.create_ticket', compact('error', 'users'));
        }
        
        // Passing all users to the view
        return view('user.create_ticket', compact('users'));
    }

    public function submitTicket(Request $request) 
    {
        $validated = $request->validate([
            'ticketLocation' => 'required',
            'ticketSubject' => 'required',
            'ticketDescription' => 'required',
            'priority' => 'required',
        ]);
    
        $ticket_id = 'JT-' . substr(Str::uuid()->toString(), 0, 8);

        $user_id = session('loginId');
    
        try {
            $ticket = ticket::create([
                'ticket_id' => $ticket_id,
                'location' => $validated['ticketLocation'],
                'user_id' => $user_id,
                'ticket_subj' => $validated['ticketSubject'],
                'ticket_description' => $validated['ticketDescription'],
                'priority' => $validated['priority'],
                'status' => 'pending'
            ]);
    
            Log::info("Ticket created: " . $ticket_id);
    
            return redirect()->back()->with('success', 'Your Job ticket has been successfully submitted.');
        } catch (\Exception $e) {
            Log::error("Ticket creation failed: " . $e->getMessage());
    
            return redirect()->back()->with('error', 'There was an error submitting your ticket. Please try again later.');
        }
    }

    // ----------------------- //
    // ------History page -----//
    // ----------------------- //
    public function fetchHistory(Request $request)
    {
        // Get the currently logged-in user's ID from the session
        $sessionID = $request->session()->get('loginId');
    
        // Retrieve tickets for the user, most recent first, paginated (10 per page)
        $tickets = ticket::where('user_id', $sessionID)
            ->orderBy('created_at', 'desc')
            ->paginate(10); // 10 tickets per page
            
        // Return to the view with the paginated tickets
        return view('user.history', compact('tickets'));
    }

    public function searchByDate(Request $request)
    {
        $sessionID = $request->session()->get('loginId');
        $filter_date = $request->date;

        $query = ticket::where('user_id', $sessionID);

        if (!empty($filter_date)) {
            $query->whereDate('created_at', $filter_date);
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);
        $tickets->appends(['date' => $filter_date]); // for keeping the filter on pagination

        return view('user.history', compact('tickets', 'filter_date'));
    }

    
}
