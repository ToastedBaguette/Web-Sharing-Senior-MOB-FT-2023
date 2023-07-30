<?php

namespace App\Http\Controllers;

use App\Group;
use App\Senior;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SeniorController extends Controller
{
    function index($id) {
        $senior = Senior::where('id',$id)->first();
        $user = Auth::user();
        $group = Group::where('user_id',$user->id)->first();
        if($senior->is_available == 0 || $group->is_waiting == 1){
            $seniors = User::where('role','Senior')->get();
            return Redirect::to('home')->with(['seniors' => $seniors, 'group' => $group]);
        }else{
            return view('detailpetuah', compact('senior'));
        }
    }
}
