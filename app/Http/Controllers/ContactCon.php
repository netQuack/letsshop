<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ContactCon extends Controller
{


   public function __construct(){

        $this->middleware('auth');
    }

    public function index(){


       return view('contact');

    }
    //
   public function Logout(){


       Auth::logout();
       return Redirect()->route('login')->with('success','Logged out successfully.');
    }

}
