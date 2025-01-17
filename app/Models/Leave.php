<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Leave;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'leave_type',
        'leave_message',
        'from_date',
        'to_date',
        'days',
        'leave_status'
    ];
}
