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

        $rejected = DB::table('requests')->where('senior_id', $senior->id)->where('status', 'REJECTED')->orderBy('updated_at')->get();

        if (count($request) == 0) {
            $group = "";
        } else {
            $group = Group::where('id', $request[0]->group_id)->first();
        }

        if ($senior->is_available == 1) {
            $accepted = "";
            $accepted_group = '';
        } else {
            $accepted = DB::table('requests')->where('senior_id', $senior->id)->where('status', 'ACCEPTED')->get();
            $accepted_group = Group::where('id', $accepted->group_id)->first();
            $accepted_group = User::where('id', $accepted_group->user_id)->first();
        }
        return view('senior', compact('senior', 'group', 'rejected', 'accepted'));
    }

    function detail($id)
    {
        $senior = Senior::where('id', $id)->first();
        $user = Auth::user();
        $group = Group::where('user_id', $user->id)->first();
        if ($senior->is_available == 0 || $group->is_waiting == 1) {
            $seniors = User::where('role', 'Senior')->get();
            return Redirect::to('home')->with(['seniors' => $seniors, 'group' => $group]);
        } else {
            return view('detailpetuah', compact('senior'));
        }
    }

    function sendResponse(Request $request)
    {
        $group_id = $request->group_id;
        $senior_id = $request->senior_id;
        $status = $request->status;

        DB::table('requests')->where('senior_id', $senior_id)->where('group_id', $group_id)->update(['status' => $status]);

        $group = Group::where('id', $group_id)->first();
        $group->decrement('is_waiting');

        if ($status == 'ACCEPTED') {
            $group->increment('is_success');

            $senior = Senior::where('id', $senior_id)->first();
            $senior->decrement('is_available');
        }

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
