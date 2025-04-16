<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_KFCP extends Model
{
    use HasFactory;

    protected $guard = 'kfcp'; // Ensure it's using the correct guard
    protected $table = 'users_kfcp';

    // Fillable attributes for mass assignment
    protected $fillable = ['id_number', 'email', 'fName', 'lName', 'department', 'position', 'password', 'is_authorized'];
}
