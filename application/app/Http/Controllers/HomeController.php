<?php

namespace App\Http\Controllers;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request -> user() -> authorizeRoles(['administrator','manager','staff']);

        // return view('home');
        return redirect('/dashboard');
    }

     
  /*public function someAdminStuff(Request $request)
  {
    $request->user()->authorizeRoles('staff');    

        return view('view_staff');
  }
  */
}
