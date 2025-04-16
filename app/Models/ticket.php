<?php

namespace App\Models;

use App\Models\Users_KFCP;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;

    protected $guard = 'kfcp'; // Ensure it's using the correct guard
    protected $table = 'ticket';

    protected $fillable = ['ticket_id', 'user_id', 'location', 'ticket_subj', 'ticket_description', 'priority', 'status'];

    public function user()
    {
        return $this->belongsTo(Users_KFCP::class, 'user_id', 'id_number'); // 1st param is foreign ID name and the 2nd is primary
    }
}
