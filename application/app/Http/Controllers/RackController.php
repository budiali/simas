<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Rack;
use App\Box;
use PDF;
use App\Division;

use Illuminate\Support\Facades\DB;

class RackController extends Controller
{

    public function index()
    {

        $userRole = Auth::user()->roles()->first();

        if($userRole->name != 'administrator')
        {

            $getUserByDivision = Auth::user()->division()->first();
            $racks = $getUserByDivision->rack()->get();
            $rack_ids = array();
            foreach ($racks as $rack)
            {
                array_push($rack_ids , $rack->id);
            }
            $div = Rack::whereIn('division_id', $rack_ids)->get();

        } else {

            $div = Rack::All();
        }

        return view('rack.index', compact('div'));
    }

    public function detail(Request $request)
    {
        $rack = Rack::find($request->id);

        return view('rack.detail' , compact('rack'));
    }

    public function add_box(Request $request)
    {

            $rack = Rack::find($request->id);

            $countBox = $rack->box->count();
            $capacity = $rack->capacity;
            $printBoxNumber = $countBox + 1;

            //Check capacity rack

            if($countBox >= $capacity) {

                return back()->with('error','The shelf is full, maximum capacity '.$capacity.' box');

            } else {

                return view('rack.add_box',compact('rack','printBoxNumber'));
            }
    }

    public function add_rack()
    {
        $rack = Rack::all();
        $division = Division::all();
        $countRack = $rack->count();
        $printRack = $countRack + 1;

        return view('rack.add_rack',compact('printRack','division'));
    }

    public function rackSearch(Request $request)
    {
         $output = '';
         $query = $request->get('division');
         if($query != '')
         {
            $dataDivision = Division::where('name', 'ilike', '%'.$query.'%')->get();

            $response = array();

            foreach ($dataDivision as $data2) {

                $response[] = array(

                    "id" => $data2->id,
                    "text" => $data2->name
                );
            }
         }
         else
         {
                $response = array();
         }
         echo json_encode($response);
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'rack_number' => 'required',
            'capacity' => 'required',
            'division' => 'required'

        ]);

        $rack = Rack::create([

            'rack_number' => $request->rack_number,
            'capacity' => $request->capacity,
            'division_id' => $request->division

        ]);

        return redirect('rack')->with('success','Okay! Rack successfully added!');
    }

    public function edit(Request $request)
    {
        $edit = Rack::find($request->id);
        $division = Division::all();

        return view('rack.edit',compact('edit','division'));
    }

    public function update(Request $request)
    {
        $this->validate($request , [

            'rack_number' => 'required',
            'capacity' => 'required',
            'division' => 'required'
        ]);

        $update = Rack::find($request->id);
        $update->rack_number = $request->rack_number;
        $update->capacity = $request->capacity;
        $update->division_id = $request->division;
        $update->save();

        return redirect('rack')->with('success','Rack successfully updated!');
    }

    public function qr_code(Request $request)
    {
        $qr_codePdf = Box::find($request->id);
        $pdf = PDF::loadView('rack.barcode_pdf',compact('qr_codePdf'));
        return $pdf->stream();
    }

    public function delete(Request $request)
    {
        $rack = Rack::find($request->id);

        $roles = Auth::user()->roles()->first();

        if($roles->name == 'administrator' || $roles->name == 'manager')
        {
            $rack->delete();

            return redirect('/rack')->with("success","Thanks rack successfully deleted!");
        } else {

            return redirect()->back()->with('error',"Whoops! Can't delete, only admins and manager have access.");
        }
    }
}
