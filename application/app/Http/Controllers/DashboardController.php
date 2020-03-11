<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Box;
use App\Rack;
use App\Division;

class DashboardController extends Controller
{
    public function index()
    {
        $document = Document::all();
        $box = Box::all();
        $rack = Rack::all();
        $division = Division::all();
        return view('dashboard.index',compact('document','box','rack','division'));
    }
}
