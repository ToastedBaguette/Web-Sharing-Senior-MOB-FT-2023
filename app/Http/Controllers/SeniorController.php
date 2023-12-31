<?php

namespace App\Http\Controllers;

use App\Events\SendResponse;
use App\Group;
use App\Senior;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SeniorController extends Controller
{
    function index()
    {
        $user = Auth::user();
        $senior = Senior::where('user_id', $user->id)->first();

        $request = DB::table('requests')->where('senior_id', $senior->id)->where('status', 'WAITING')->orderBy('updated_at')->get();

        $rejected = DB::table('requests')->distinct('group_id')->where('senior_id', $senior->id)->where('status', 'REJECTED')->orderBy('updated_at')->get();
        $accepted = DB::table('requests')->distinct('group_id')->where('senior_id', $senior->id)->where('status', 'ACCEPTED')->orderBy('updated_at')->get();
        $rejected_user = array();
        $accepted_user = array();
        
        foreach($rejected as $temp){
            $rejected_group = Group::where('id', $temp->group_id)->first();
            $temp2 = User::where('id', $rejected_group->user_id)->first();
            array_push($rejected_user,$temp2);
        }
        
        
        foreach($accepted as $temp){
            $accepted_group = Group::where('id', $temp->group_id)->first();
            $temp2 = User::where('id', $accepted_group->user_id)->first();
            array_push($accepted_user,$temp2);
        }
        
        if (count($request) == 0) {
            $group = "";
        } else {
            $group = Group::where('id', $request[0]->group_id)->first();
        }
        
        return view('senior', compact('senior', 'group', 'rejected', 'accepted', 'accepted_user', 'rejected_user'));
    }

    function detail($id)
    {
        $senior = Senior::find($id);
        $user = Auth::user();
        $group = Group::where('user_id', $user->id)->first();
        $accepted = DB::table('requests')->where('senior_id', $senior->id)->where('group_id', $group->id)->where('status', 'ACCEPTED')->orderBy('updated_at')->get();
        if(count($accepted) == 0){
            return redirect()->route('home');
        }
        return view('detailpetuah', compact('senior'));
    }

    function sendResponse(Request $request)
    {
        $group_id = $request->group_id;
        $senior_id = $request->senior_id;
        $status = $request->status;

        DB::table('requests')->where('senior_id', $senior_id)->where('group_id', $group_id)->update(['status' => $status]);

        $group = Group::where('id', $group_id)->first();
        $group->is_waiting = 0;

        if ($status == 'ACCEPTED') {    
            $group->is_success = 1;

            $senior = Senior::where('id', $senior_id)->first();
            $senior->is_available=0;
        }else if($status == 'REJECTED'){
            $group->is_waiting = 0;
            $senior = Senior::where('id', $senior_id)->first();
            $senior->is_available=1;
        }

        $group->save();
        $senior->save();

        event(new SendResponse('response'));

        return response()->json(array(
            'msg' => "success"
        ), 200);
    }

    function cancelRequest(Request $request)
    {
        $group_id = $request->group_id;
        $senior_id = $request->senior_id;
        $status = 'REJECTED';

        DB::table('requests')->where('senior_id', $senior_id)->where('group_id', $group_id)->update(['status' => $status]);

        $group = Group::where('id', $group_id)->first();
        $group->decrement('is_success');

        $senior = Senior::where('id', $senior_id)->first();
        $senior->increment('is_available');


        event(new SendResponse('response'));

        return response()->json(array(
            'msg' => "success"
        ), 200);
    }
}
