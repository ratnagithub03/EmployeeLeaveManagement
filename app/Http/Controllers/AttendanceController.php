<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function getAttendanceRecords(Request $request)
    {
        // Ensure the user is authenticated
        $userId = Auth::id();

        // Retrieve all attendance records for the logged-in user
        $attendance = Attendance::where('user_id', $userId)->get();

        // Return the attendance records as JSON
        return response()->json($attendance);
    }

    public function checkIn(Request $request)
    {
        $userId = Auth::id();

        $existingRecord = Attendance::where('user_id', $userId)
            ->whereNull('check_out')
            ->first();

        if ($existingRecord) {
            return response()->json(['message' => 'You are already checked in'], 400);
        }

        Attendance::create([
            'user_id' => $userId,
            'check_in' => now(),
        ]);

        return response()->json(['message' => 'Check-in successful']);
    }

    public function checkOut(Request $request)
    {
        $userId = Auth::id();

        $attendance = Attendance::where('user_id', $userId)
            ->whereNull('check_out')
            ->first();

        if (!$attendance) {
            return response()->json(['message' => 'No active check-in found'], 400);
        }

        $attendance->update(['check_out' => now()]);

        return response()->json(['message' => 'Check-out successful']);
    }
}
