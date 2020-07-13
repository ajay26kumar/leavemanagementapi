<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User_Leave;
use App\User;
use App\UserLeaveApplied;

class LeaveController extends Controller
{
    public function granteLeaves(Request $request)
    {
    	$user_id = $request->input('user_id');
    	User_Leave::where('user_id',$user_id)->update(['leave_available'=>'12']);
        return response()->json(['Message','User Granted Leaves' ]);
    }

    public function userLeaves(Request $request)
    {
    	$user_id = $request->input('user_id');
    	$user_leaves = User::find($user_id)->user_leaves;
    	return response()->json(['Message',$user_leaves ]);
    }

    public function leaveApplied(Request $request)
    {
    	$user_id = $request->input('user_id');
    	$leavedatestart = $request->input('date_start');
    	$leavedateend = $request->input('date_end');

    	$leaveapplied = new UserLeaveApplied;
    	$leaveapplied->user_id = $user_id;
    	$leaveapplied->leave_date_start = $leavedatestart;
    	$leaveapplied->leave_date_end = $leavedateend;
    	$leaveapplied->status ='1'; 
    	$leaveapplied->save();
    	return response()->json(['Message','Leave Applied' ]);
    }

    public function leaveStatus(Request $request)
    {
    	$leavestatus = $request->input('leave_status');
    	//we can calculate days from date_start and date_end
    	$totalleavedays = $request->input('leave_days'); 
    	$user_id =  $request->input('user_id');

    	UserLeaveApplied::where('user_id',$user_id)->update(['status'=>$leavestatus]);
    	if($leavestatus == 2)
    	{
    		$user_leaves = User::find($user_id)->user_leaves;
    		$leaveupdate = $user_leaves->leave_available -  $totalleavedays;
    		User_Leave::where('user_id',$user_id)->update(['leave_available'=>$totalleavedays,'leave_user'=>$totalleavedays]);
    		return response()->json(['Message','Leave Approved' ]);
    	}

    	return response()->json(['Message','Leave Disapproved' ]);
    }
}
