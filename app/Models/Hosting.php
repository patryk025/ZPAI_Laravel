<?php

namespace App\Models;

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
        'hosting_type'
    ];
}
