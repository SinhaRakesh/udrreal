<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('mobile')->except('mobile', 'updateMobile');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function mobile()
    {
        $user = Auth::user();
        return view('auth.mobile', compact('user'));
    }

    public function updateMobile(Request $request)
    {
        $user = Auth::user();
        $user_id = $request->input('user_id');
        if ($user->id == $user_id) {
            $user->mobile = $request->input('mobile');
            $user->save();
        }
        return redirect('/home');
    }

    public function properties()
    {
        $properties = Auth::user()->properties()->get();

        return view('auth.properties', compact('properties'));
    }
}
