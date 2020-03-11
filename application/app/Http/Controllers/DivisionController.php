<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Division;
use App\Rack;
use App\Role;
use App\User;
use Auth;

class DivisionController extends Controller
{
    public function index()
    {

            $roles = Auth::user()->roles()->first();

            if($roles->name != 'administrator')
            {
                $divisions = Auth::user()->division()->get();
            }
            else{
                $divisions = Division::All();
            }

        return view('division.index', compact('divisions', 'roles'));
    }

    public function add_division()
    {
        $rack = Rack::all();

        return view('division.add_division',compact('rack'));
    }

    public function store(Request $request)
    {
        $this -> validate( $request , [

            'name' => 'required',
            'descriptions' => 'required'

        ]);

        $division = Division::create([

            'name' => $request -> name ,
            'descriptions' => $request -> descriptions

        ]);

        return redirect('/division')->with('success','Division successfully added!');
    }

    public function edit($id)
    {
        $editDivision = Division::find($id);

        return view('division.edit' , compact('editDivision') );
    }

    public function update($id , Request $request)
    {
        $this -> validate( $request , [

            'name' => 'required',
            'descriptions' => 'required'

        ]);

        $updateDivision = Division::find($id);
        $updateDivision -> name = $request -> name;
        $updateDivision -> descriptions = $request -> descriptions;
        $updateDivision -> save();

        return redirect('/division')->with('success','Division successfully updated!');
    }

    public function delete($id)
    {
        $deleteDivision = Division::find($id);

        $roles = Auth::user()->roles()->first();

        if($roles->name == 'administrator')
        {
            $deleteDivision->delete();

            return redirect('/division')->with("success","Thanks Division successfully deleted!");
        } else {

            return redirect()->back()->with('error',"Whoops! Can't delete, only admins have access.");
        }

    }

}
