<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function checkIn()
    {
        try {

            $user = auth()->user(); // Ensure user is authenticated
            // $today = Carbon::today()->format('Y-m-d');

            // Check if the user has already checked in today
            // $existingAttendance = Attendance::where('user_id', $user->id)
            //     ->where('date', $today)
            //     ->toSql();
            // print_r("hry"); exit;
            $existingAttendance = Attendance::getQuery()->toSql();
            dd($existingAttendance); 
            

            if ($existingAttendance) {
                return response()->json(['message' => 'Already Checked In!'], 400);
            }

            // Add a new check-in record
            $attendance = Attendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'check_in' => Carbon::now()->format('H:i:s'),
                'status' => 'Present', // Default status
            ]);

            return response()->json(['message' => 'Check-In Successful!', 'data' => $attendance]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Check-In Failed!', 'error' => $e->getMessage()], 500);
        }
    }

    public function checkOut(Request $request)
    {
        try {
            $user = auth()->user(); // Ensure user is authenticated
            $today = Carbon::today()->format('Y-m-d');

            // Find today's attendance record
            $attendance = Attendance::where('user_id', $user->id)
                ->where('date', $today)
                ->first();

            if (!$attendance) {
                return response()->json(['message' => 'No Check-In record found.'], 404);
            }

            // Update the check-out time
            $attendance->update([
                'check_out' => Carbon::now()->format('H:i:s'),
            ]);

            return response()->json(['message' => 'Check-Out Successful!', 'data' => $attendance]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Check-Out Failed!', 'error' => $e->getMessage()], 500);
        }
    }

    public function list()
    {
        try {
            $user = auth()->user(); // Ensure user is authenticated
            $attendance = Attendance::where('user_id', $user->id)
                ->orderBy('date', 'desc')
                ->get();

            return response()->json($attendance, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching attendance!', 'error' => $e->getMessage()], 500);
        }
    }
}
