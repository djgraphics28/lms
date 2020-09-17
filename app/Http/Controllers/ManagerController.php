<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_type != null) {
            if (Auth::user()->user_type == 1) {
                return view('admin.dashboard');
            } else if (Auth::user()->user_type == 2) {
                return view('admin.dashboard');

            } else if (Auth::user()->user_type == 3) {
                return view('manager.dashboard');
            } else if (Auth::user()->user_type == 4) {
                return view('supervisor.dashboard');
            } else {
                return view('user.dashboard');
            }
        } else {
            return redirect('/');
        }
    }

    public function userProfile()
    {
        return view('admin.profile');
    }
}
