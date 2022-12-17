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
        'status_id',
        'title',
        'description'
    ];
}
