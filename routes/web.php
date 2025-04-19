<?php

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;

// Models
use App\Models\Users_KFCP;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 

// Sample mock-up route
Route::get('/sample', function() {
    return view('sample');
})->name('sample');

// ------------------------------------------------//
//--------------Admin Routes-----------------------//
// ------------------------------------------------//

// admin auth Routes
Route::get('/admin', function() {
    return view('auth_admin.admin_login');
})->name('auth_admin');

Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('adminLogin');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('adminLogout');

// Admin Protected Routes
Route::middleware(['admin'])->group(function() {
    // Admin Dashboard
    Route::get('admin/home', [AdminController::class, 'fetchDashboardData'])->name('adminHome');

    // Admin Ticket Management
    Route::get('/admin/create-ticket', [AdminController::class, 'ticketManagement'])->name('adminCreateTicket');
    Route::post('/admin/create-ticket', [AdminController::class, 'submitTicket'])->name('submitTicketAdmin');
    Route::patch('/admin/{id}/resolve-ticket/', [AdminController::class, 'resolveTicket'])->name('resolveTicketAdmin');

    // Admin User Managements
    Route::get('/admin/user-management', [AdminController::class, 'fetchUserData'])->name('userManagement');
    Route::patch('/admin/{id}/authorize', [AdminController::class, 'authorizeUser'])->name('userAuthorize');
    Route::delete('/admin/{id}', [AdminController::class, 'deleteUser'])->name('userDelete');
    Route::patch('/admin/{id}/unauthorize', [AdminController::class, 'unauthorizeUser'])->name('userUnauthorize');

    // Admin History
    Route::get('/admin/ticket-history', [AdminController::class, 'fetchHistory'])->name('adminHistory');
    Route::get('/admin/ticket-history/search', [AdminController::class, 'searchByDateAdmin'])->name('searchByDateAdmin');



});


// ------------------------------------------------//
//-------------Client Routes-----------------------//
// ------------------------------------------------//

// Client Auth Routes
Route::get('/', function () {
    return view('auth.login');
})->name('auth_login');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', function() {
    return view('auth.register');
})->name('auth_register');

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Client protected routes
Route::middleware(['CheckUser'])->group(function() {
    // User Dashboard
    Route::get('user/home', [UserController::class, 'dashboardInfo'])->name('userHome');

    // User Create Ticket
    Route::get('/user/create-ticket', [UserController::class, 'fetchTickets'])->name('userCreateTicket');
    Route::post('/user/create-ticket', [UserController::class, 'submitTicket'])->name('submitTicket');

    // User History
    Route::get('/user/ticket-history', [UserController::class, 'fetchHistory'])->name('userHistory');
    Route::get('/user/ticket-history/search', [UserController::class, 'searchByDate'])->name('searchByDate');

    // User Help
    Route::get('/user/help-center', function(Request $request) {
        $sessionID = $request->session()->get('loginId');

        $user = Users_KFCP::where('id_number', $sessionID)->first();
        return view('user.help_center', compact('user'));
    })->name('userHelpCenter');

});




