<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\AuthTraits\OwnsRecord;
use Auth;
use App\Document;
use App\Box;
use App\Contain;
use App\Rack;
use App\File;
use PDF;
use Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PhpParser\Comment\Doc;

class DocumentController extends Controller
{

    use OwnsRecord;

    public function index()
    {
        $document = Auth::user()->division()->first();

    	return view('document.index', compact('document'));
    }

    public function add_document(Request $request)
    {
        $user = Auth::user()->id;
        $box = Box::all();
        $contains = Contain::all();

    	return view('document.add_document',compact('box','contains','user'));
    }

    public function store(Request $request )
    {

        $this->validate($request,[

            'job_number' => 'required|unique:document',
            'date' => 'required',
            'box_id' => 'required',
            'contain' => 'required',
            'description' => 'nullable',
            'user_id' => 'required',
            'filename' => 'nullable',
            'filename.*' => 'mimes:doc,docx,pdf,zip,jpg,png,jpeg|max:20480',

        ]);

        $date_input = $request->get('date');
        $ref_number = Document::ref_number($date_input);


        $document = Document::create([

            'reference_number' => $ref_number,
            'job_number' => $request->job_number ,
            'date' => $request->date ,
            'contain' => $request->contain ,
            'box_id' => $request->box_id ,
            'description' => $request->description ,
            'user_id' => $request->user_id ,

        ]);

        $data = [];
        if($request->hasFile('filename')){
            foreach($request->file('filename') as $file){
                $name = $file->getClientOriginalName();
                $path = 'data_file';
                $file->move($path , $name);
                array_push($data , $name);
            }
        }

        $filenames = $data ;
        $doc_id = $document->id;

            foreach($filenames as $filename)
            {
                File::create([
                    'filename' => $filename,
                    'document_id' => $doc_id
                ]);
            }

        $document->contain()->sync($request->contain);

        return redirect('document')->with('success','Okay! Data successfully added!');
    }

    public function detail(Request $request )
    {
        
        $detail = \App\Document::find($request->id);

        return view('document.detail',compact('detail'));
    }

    public function edit(Request $request , $id )
    {

        $edit = \App\Document::find($id);
        
        if($this->userNotOwnerOf($edit))
        {
            return redirect()->back()->with('error',"Can't edit, You're not the owner of this post.");
        }

        $allContains = \App\Contain::all();
        $assignedContains = $edit->contain-> pluck('id')->toArray();
        $edit_box = \App\Box::all();


        return view('document.edit', compact('edit','allContains','edit_box','assignedContains'));
    }

    public function update($id , Request $request)
    {
        $this -> validate($request, [

            'job_number' => 'required',
            'date' => 'required',
            'box_id' => 'required',
            'description' => 'nullable',
            'user_id' => 'required' ,
            'filename' => 'nullable',
            'filename.*' => 'mimes:doc,docx,pdf,zip,jpg,png,jpeg|max:20480',

        ]);

            $updateDateInput = $request->get('date');
            $updateRefNumber = Document::ref_number($updateDateInput);

            $update = Document::find($id);
            $update->reference_number = $updateRefNumber ;
            $update->job_number = $request->job_number ;
            $update->date = $request->date ;
            $update->box_id = $request->box_id ;
            $update->description = $request->description ;
            $update->user_id = $request->user_id ;
            $update->save();

            $data = [];
            if($request->hasFile('filename')){
                foreach($request->file('filename') as $file){
                    $name = $file->getClientOriginalName();
                    $path = 'data_file';
                    $file->move($path,$name);
                    array_push($data , $name);
                }
            }

            $doc_id = $update->id;
            $filenames = $data;

                foreach ($filenames as $filename) {

                    File::create([
                        'filename' => $filename,
                        'document_id' => $doc_id
                    ]);
                }

        $update->contain()->sync($request->contain);

        return redirect('/document')->with('success','Document successfully updated!');

    }

    public function delete($id)
    {

        $document = \App\Document::find($id);

        $roles = Auth::user()->roles()->first();

        if($roles->name == 'administrator')
        {
            $document->delete();
        } else {

            return redirect()->back()->with('error',"Can't delete, only administrator have access.");
        }
        // if($this->adminOrCurrentUserOwns($document)){
        //     return redirect()->back()->with('error',"Whoops! Can't delete, You're not the owner of this post.");
        // }
 
        return redirect('/document')->with('success','Documents will be thrown in the trash!');
    }

    public function trash()
    {
        //get document after delete!
        $document = \App\Document::onlyTrashed()->get();
        return view('document.document_trash',compact('document'));
    }

    public function restore($id)
    {
        $document = \App\Document::onlyTrashed()->where('id',$id);
        $document->restore();
        return redirect('/document/trash')->with('success','
                    Okay! Successfully returned the document');
    }

    public function restore_all()
    {
        $document = \App\Document::onlyTrashed();
        $document->restore();
        return redirect('/document/trash');
    }

    public function delete_permanently($id)
    {
        $document = \App\Document::onlyTrashed()->where('id',$id);
        $document->forceDelete();
        return redirect('/document/trash')->with('success','Okay! Document permanently deleted');
    }

    public function delete_permanently_all()
    {
        $document = \App\Document::onlyTrashed();
        $document->forceDelete();
        return redirect('/document/trash')->with('success','Okay! 
            All documents have been permanently deleted');
    }

    // public function search(Request $request)
    // {
    //     $job_number = $request->job_number;
    //     $ref_number = $request->ref_number;


    //     $document = Document::where([
    //         ['job_number','ilike',"%".$job_number."%"],
    //         ['reference_number', 'ilike',"%".$ref_number."%"]
    //          ])->paginate();

    //     return view('document.index',compact('document'));
    // }

    public function boxSearch(Request $request)
    {
        $roles = Auth::user()->roles()->first();

        if($roles->name != 'administrator')
        {
            $division = Auth::user()->division()->first();
            $rack = $division->rack()->get();
            $rack_ids = array();
            foreach ($rack as $r){
                array_push($rack_ids, $r->id);
            }
            $box_ids = array();
            $box = Box::WhereIn('rack_id', $rack_ids)->get();
            foreach ($box as $b) {
                array_push($box_ids, $b->id);
            }            
        }
        else{
            $box_ids = array();
            $box = Box::all();
            foreach ($box as $b) {
                array_push($box_ids, $b->id);
            }
        }

         $output = '';
         $query = $request->get('box');
         if($query != '')
         {
            $dataBox = Box::whereIn('id', $box_ids)->where('box_number', 'ilike', '%'.$query.'%')->get();

            $response = array();

            foreach ($dataBox as $data1) {

                $response[] = array(

                    "id" => $data1->id,
                    "text"=> 'Box [ '.$data1->box_number.' ] / Rack [ '.$data1->rack->rack_number.' ] / Division [ '.$data1->rack->division->name.' ]'
                );
            }
         }
         else
         {
                $response = array();
         }
         echo json_encode($response);
    }

    public function getDocuments()
    {
        $document = Document::select('*');


        $roles = Auth::user()->roles()->first();


        if($roles->name != 'administrator')
        {
            $division = Auth::user()->division()->first();
            $rack = $division->rack()->get();
            $rack_ids = array();
            foreach ($rack as $r){
                array_push($rack_ids, $r->id);
            }
            $box = Box::WhereIn('rack_id', $rack_ids)->get();
            $box_ids = array();
            foreach ($box as $b){
                array_push($box_ids, $b->id);
            }
            $document = Document::select('*')->whereIn('box_id', $box_ids);
        }
        else{
            $document = Document::select('*');
        }

        return \DataTables::eloquent($document)
        ->addColumn('user_upload',function($doc){
            $user = $doc->user->name;

            return $user;
        })
        ->addColumn('date',function($doc){

            $x = date('M d, Y',strtotime($doc->date));
            return $x;

        })

        ->addColumn('box_number',function($doc){

            $boxNumber = $doc->box->box_number;

            return '[ '.$boxNumber.' ] / [ '.$doc->box->rack->rack_number.' ] / [ '.$doc->box->rack->division->name.' ]';

        })
        ->addColumn('action',function($doc){

            return '<a href="/document/detail/'.$doc->id.'" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detail"><span class="lnr lnr-eye"> Detail Document</span></a>';

        })
        ->rawColumns(['box_number','user_upload','file','action','date'])
        ->toJson();
    }

    public function print_pdf(Request $request)
    {
        $detailDocPdf = Document::find($request->id);

        $pdf = PDF::loadView('document.detail_pdf',compact('detailDocPdf'));
        
        return $pdf->stream();

    }

    public function delete_file(Request $request)
    {
        $files = File::findOrFail($request->id);
        
        $file_path = public_path('data_file/'.$files->filename); 
      
            if(file_exists($file_path))
            {           
                 unlink(public_path('data_file/'.$files->filename));
            } 
       
        $files->delete();
        return redirect()->back();     
    }

}
