<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'hosting_id',
        'ticket_status_id',
        'title',
        'description'
    ];

    public function status() 
    {
        return $this->belongsTo(TicketStatus::class);
    }

    public function hosting() 
    {
        return $this->belongsTo(Hosting::class);
    }
}
