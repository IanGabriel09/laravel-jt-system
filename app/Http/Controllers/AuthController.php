<?php

namespace App\Http\Controllers;

// Models
use App\Models\Users_KFCP;

// Libraries
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // For hashing passwords
use Illuminate\Support\Facades\Log; // Import Log facade

class AuthController extends Controller
{   
    // Controller function for logging in user
    public function login(Request $request)
    {
        $validated = $request->validate([
            'id_num' => 'required', 
            'password' => 'required|min:6',
        ]);
    
        $user = Users_KFCP::where('id_number', $validated['id_num'])->first();
        
        // Username and Pass check
        if ($user && Hash::check($validated['password'], $user->password)) {
            // Store user ID in session for custom middleware
            $request->session()->put('loginId', $user->id_number);
    
            Log::info('User logged in successfully.', [
                'id_number' => $validated['id_num'],
                'user_SESSION_ID' => $request->session()->get('loginId'),
            ]);
    
            return redirect()->route('userHome');
        } else {
            Log::warning('Invalid login attempt.', [
                'id_number' => $validated['id_num'],
                'timestamp' => now()
            ]);
    
            return back()->withErrors(['message' => 'Invalid ID number or password!']);
        }
    }

    // Controller function for registering users
    public function register(Request $request)
    {  
        // Manual password length check (if you want custom logic)
        if (strlen($request->input('password')) < 8) {
            return redirect()->back()->with('error', 'Password must be at least 8 characters long.');
        }

        // Validate the registration data
        $validated = $request->validate([
            'id_num' => 'required',
            'email' => 'required',
            'fName' => 'required',
            'lName' => 'required',
            'department' => 'required',
            'title' => 'required',
            'password' => 'required|confirmed',
        ]);

        try {
            // Create the user in the database
            $user = Users_KFCP::create([
                'id_number' => $validated['id_num'],
                'email' => $validated['email'],
                'fName' => $validated['fName'],
                'lName' => $validated['lName'],
                'department' => $validated['department'],
                'position' => $validated['title'],
                'password' => Hash::make($validated['password']), // Using Hash::make() to encrypt the password
            ]);
    
            // Optionally, log the user creation
            Log::info('User registered successfully.', [
                'id_number' => $validated['id_num'],
                'user_id' => $user->id
            ]);
    
            // Optionally, send a welcome email (e.g., using a Mail class)
    
            // Redirect to login with success message
            return redirect()->route('auth_login')->with('message', 'Registration successful. Please wait for a confirmation from MIS in your email before logging in.');
    
        } catch (\Exception $e) {
            // Log any errors that occur during the user creation process
            Log::error('User registration failed.', [
                'error_message' => $e->getMessage(),
                'data' => $validated
            ]);
    
            // Redirect with an error message
            return redirect()->back()->with('error', 'Registration failed. Please try again later.');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('loginId');

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth_login');
    }
}
