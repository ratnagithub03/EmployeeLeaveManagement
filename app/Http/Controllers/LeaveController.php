<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LeaveController;
use App\Models\Leave;

class LeaveController extends Controller
{
    public function applyLeave(Request $request)
    {
        $leave=Leave::create([
            'user_id'=>$request->user_id,
            'leave_type'=>$request->leave_type,
            'leave_message'=>$request->leave_message,
            'from_date'=>$request->from_date,
            'to_date'=>$request->to_date,
            'days'=>$request->days,
            'leave_status'=>'NotApproved'
        ]);
        if($leave){
            return response()->json(['message'=>'Leave Apllied Successfully']);
        }
    }
    public function appliedLeave(){
        $leave=Leave::join('users','leaves.user_id','=','users.id')
        ->where('leaves.leave_status','=','NotApproved')
        ->where('users.role','!=','Admin')
        ->get(['leaves.id','leaves.user_id','users.name','users.email','users.phone','users.gender','users.role','leaves.leave_status']);
        return response()->json($leave);
    }
    public function approvedLeave(){
        $leave=Leave::join('users','leaves.user_id','=','users.id')->
        where('leaves.leave_status','=','Approved')->get();
        return response()->json($leave);
    }
    public function rejectedLeave(){
        $leave=Leave::join('users','leaves.user_id','=','users.id')->
        where('leaves.leave_status','=','Rejected')->get();
        return response()->json($leave);
    }
    Public function approveLeave($id){
        $leave = Leave::find($id)->update(['leave_status'=>'Approved']);
        if($leave){
            return response()->json(['message' => 'Leave Approved Successfully']);
        }else{
            return response()->json(['error' => 'Leave not found'], 404);
        }
    }
    public function rejectLeave($id){
        $leave = Leave::find($id)->update(['leave_status'=>'Rejected']);
        if($leave){
            return response()->json(['message' => 'Leave Rejected Successfully']);
        }else{
            return response()->json(['error' => 'Leave not found'], 404);
        }
    }

    // public function getLeaveStatus(Request $request) {
    //     $status = $request->status;
        
    //     // Fetch leave data based on status
    //     $leaves = Leave::query();
        
    //     if ($status !== 'all') {
    //         $leaves->where('leave_status', ucfirst($status));
    //     }
        
    //     return response()->json($leaves->get());
    // }
    
    
    public function getLeaveStatus(Request $request)
    {
        $status = $request->input('status');

        // Filter leaves based on the provided status
        $query = Leave::query();
        if ($status && $status !== 'all') {
            $query->where('leave_status', $status);
        }

        // Get leaves for the logged-in user
        $leaves = $query->where('user_id', auth()->id())->get();

        // Return data as JSON
        return response()->json($leaves);
    }
}

