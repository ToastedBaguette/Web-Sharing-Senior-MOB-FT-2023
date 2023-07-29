<?php

namespace App\Http\Controllers;

use App\Senior;
use App\User;
use Illuminate\Http\Request;

class SeniorController extends Controller
{
    function index($id) {
        $senior = Senior::where('id',$id)->first();
        if($senior->is_available == 0){
            $seniors = User::where('role','Senior')->get();
            return view('home', compact('seniors'));
        }else{
            return view('detailpetuah', compact('senior'));
        }
    }
}
