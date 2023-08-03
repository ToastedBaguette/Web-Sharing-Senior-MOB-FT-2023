<?php

namespace App\Http\Controllers;

use App\Events\SendRequest;
use App\Group;
use App\Senior;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class GroupController extends Controller
{
    public function index()
    {
        $seniors = User::where('role','Senior')->get();

        $user = Auth::user();
        $group = Group::where('user_id',$user->id)->first();
        $requests = DB::table('requests')->where('group_id',$group->id)->where('status','ACCEPTED')->get();
        if(count($requests) != 0){
            $senior_id = $requests[0]->senior_id;
            $senior = Senior::find($senior_id);
            $senior_name = $senior->user->name;
            $info = $senior_name . " (" . $senior->location . ")";
            $accepted_id = $senior_id;
        }else{
            $accepted_id = "";
            $info = "-";
        }
        return view('home', compact('seniors', 'group', 'info', 'accepted_id'));
    }

    function request(Request $request) {
        $senior_id = (int)$request->senior_id;
        $user = Auth::user();
        $group = Group::where('user_id',$user->id)->first();
        $group_id = $group->id;
        $group->increment('is_waiting');
        DB::table('requests')->insert([
            "group_id" => $group_id,
            "senior_id" => $senior_id,
            "status" => "WAITING",
        ]);

        event(new SendRequest($senior_id));

        return response()->json(array(
            'msg' => "success"
        ), 200);
    }
}
