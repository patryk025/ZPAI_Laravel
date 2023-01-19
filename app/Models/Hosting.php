<?php

namespace App\Models;

use App\Models\User;
use App\Models\Ticket;
use App\Models\HostingType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hosting extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'active_from',
        'active_to',
        'user_id',
        'hosting_type_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hosting_type()
    {
        return $this->belongsTo(HostingType::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
