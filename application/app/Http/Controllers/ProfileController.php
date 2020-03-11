<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
 

    public function detail(Request $request)
    {
        $detail_user = User::find($request -> id);

        return view('profile.detail',compact('detail_user'));
    }
}
