<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $seniors = User::where('role','Senior')->get();
        return view('home', compact('seniors'));
    }
}
