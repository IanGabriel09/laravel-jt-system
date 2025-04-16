<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $guard = 'kfcp'; // Ensure it's using the correct guard
    protected $table = 'admin';

    // Fillable attributes for mass assignment
    protected $fillable = ['username', 'password'];
}
