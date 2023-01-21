<?php

namespace App\Models;

use App\Models\Hosting;
use App\Models\TicketStatus;
use App\Models\TicketMessage;
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

    public function ticket_status() 
    {
        return $this->belongsTo(TicketStatus::class);
    }

    public function ticket_messages() 
    {
        return $this->hasMany(TicketMessage::class);
    }

    public function hosting() 
    {
        return $this->belongsTo(Hosting::class);
    }
}
