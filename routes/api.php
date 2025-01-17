<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('applyLeave',[LeaveController::class,'applyLeave']);
Route::get('appliedLeave',[LeaveController::class,'appliedLeave']);

Route::get('/approvedLeave',[LeaveController::class,'approvedLeave']);
Route::get('/rejectedLeave',[LeaveController::class,'rejectedLeave']);
Route::patch('approveLeave/{id}',[LeaveController::class,'approveLeave']);
Route::patch('rejectLeave/{id}',[LeaveController::class,'rejectLeave']);


