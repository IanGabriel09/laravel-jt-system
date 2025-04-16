<?php

namespace App\Http\Controllers;

// Models
use App\Models\Admin;

// Libraries
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // For hashing passwords
use Illuminate\Support\Facades\Log; // Import Log facade


class AdminAuthController extends Controller
{
    public function login(Request $request) 
    {
        $validated = $request->validate([
            'username' => 'required', 
            'password' => 'required|min:6',
        ]);

        $userAdmin = Admin::where('username', $validated['username'])->first();

        if($userAdmin && Hash::check($validated['password'], $userAdmin->password)) {
            // Store Admin ID in session for custom middleware
            $request->session()->put('adminId', $userAdmin->id);

            Log::info('User logged in successfully.', [
                'username' => $validated['username'],
                'user_id' => $userAdmin->id
            ]);

            return redirect()->route('adminHome');
        } else {
            Log::warning('Invalid login attempt.', [
                'username' => $validated['username'],
                'timestamp' => now()
            ]);
    
            return back()->withErrors(['message' => 'Invalid username or password!']);
        }
    }

    public function logout() {
        // Clear the session
        session()->forget('adminId');
        session()->flush();
    
        // Redirect to the login page
        return redirect()->route('auth_admin');
    }
    

}
