<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        // 'employee_id',
        'user_id',
        // 'check_in_time',
        'check_in',
        'check_out',
        'date',
        'status', // e.g., 'Present', 'Absent', 'Half-day'
    ];

    /**
     * Accessor for check-in time (formatted).
     */
    public function getCheckInTimeAttribute($value)
    {
        return Carbon::parse($value)->format('h:i A');
    }

    /**
     * Accessor for check-out time (formatted).
     */
    public function getCheckOutTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('h:i A') : null;
    }

    /**
     * Relation to the Employee model (assuming it exists).
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Mark attendance check-in.
     */
    public function checkIn($employeeId)
    {
        return $this->create([
            'employee_id' => $employeeId,
            'check_in_time' => Carbon::now(),
            'date' => Carbon::today(),
            'status' => 'Present', // Default status
        ]);
    }

    /**
     * Update attendance with check-out time.
     */
    public function checkOut($employeeId)
    {
        $attendance = $this->where('employee_id', $employeeId)
                           ->whereDate('date', Carbon::today())
                           ->first();

        if ($attendance) {
            $attendance->update([
                'check_out_time' => Carbon::now(),
            ]);
        }

        return $attendance;
    }
}
