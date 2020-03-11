<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\AuthTraits\OwnsRecord;
use App\Box;
use App\Rack;
use App\Division;
use PDF;
use Auth;

use Illuminate\Support\Facades\DB;

class BoxController extends Controller
{
    use OwnsRecord;

    public function index()
    {
        $roles = Auth::user()->roles()->first();

        if($roles->name == 'administrator'){

            $box = Box::paginate(10);

        } else {
         
            $getUser = Auth::user()->division()->first();
            $rack = $getUser->rack()->get();
            $rack_ids = array();

            foreach($rack as $r){
                array_push($rack_ids,$r->id);
            }

            $box = Box::whereIn('rack_id',$rack_ids)->paginate(10);

        }       
        
        return view('box.index' , compact('box'));
    }

    public function view_data(Request $request)
    {
        $box_all = Box::all();
        $box = Box::find($request -> id);

        return view('box.view_data' , compact('box_all','box'));
    }

    public function store(Request $request)
    {
        $this -> validate ($request , [

            'box_number' => 'required' ,
            'from' => 'required' ,
            'to' => 'required' ,
            'rack_id' => 'required' 
        ]);

        Box::create([

            'box_number' => $request -> box_number ,
            'from' => $request -> from ,
            'to' => $request -> to ,
            'rack_id' => $request -> rack_id
        ]);

        return redirect('rack')->with('success','Box successfully added!');

    }

    public function updateStatus(Request $request)
    {
        $data = Box::where('id',$request->id)->first();

    
        $currentStatus = $data->status;


        if($currentStatus == 1){
            
            Box::where('id',$request->id)->update([
                'status' => 0 
            ]);

            return redirect()->back()->with('success',"Don't forget to return the Box!");

        }else {
            Box::where('id',$request->id)->update([
                'status' => 1
            ]);

            return redirect()->back()->with('success','Okay! Thank you very much for your cooperation!');
        }
        
    }

    public function edit_box(Request $request)
    {
        $box = Box::findOrFail($request->id);

        return view('box.edit_box',compact('box'));
    }

    public function update(Request $request)
    {
        $this->validate($request , [

            'box_number' => 'required' ,
            'from' => 'required' ,
            'to' => 'required' ,
            'rack_id' => 'required' 

        ]);

        $update = Box::find($request->id);
        $update->box_number = $request->box_number;
        $update->from = $request->from;
        $update->to = $request->to;
        $update->rack_id = $request->rack_id;
        $update->save();

        return redirect()->back()->with('success','Box successfully updated!');
    }

    public function search(Request $request)
    {
        $search = $request->search;
      

        $box = Box::where('box_number','ilike',"%".$search."%")->paginate();

        return view('box.index',compact('box'));
    }

    public function delete(Request $request)
    {
        $box = Box::find($request->id);

        $roles = Auth::user()->roles()->first();

        if($roles->name == 'administrator' || $roles->name == 'manager')
        {
            $box->delete();

            return redirect('/rack')->with("success","Thanks box successfully deleted!");
        } else {

            return redirect()->back()->with('error',"Whoops! Can't delete, only admins and manager have access.");
        }

    }

    public function print_data_box(Request $request)
    {
        $printDataBox = Box::find($request->id);

        $pdf = PDF::loadView('box.print_data_box', compact('printDataBox'));

        return $pdf->stream();

    }

}

