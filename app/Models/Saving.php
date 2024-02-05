<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    use HasFactory;
    protected $fillable = [
        'saved_amount',
        'member_id',
        'group_id'
    ];
}
