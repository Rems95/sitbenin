<?php

namespace App\Http\Controllers;

use App\Adherant;
use App\Subsector;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Mail;





class AdherantController extends Controller
{
    public function getAdherants(Request $request)
    {


        if ($request->ajax()) {
            $data = Adherant::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->setRowClass('align-baseline clickable-row')
                // ->setRowAttr([
                //     "onclick" => "rowSelected(this)",
                //     "style" => "cursor: pointer;",
                // ])
                ->setRowId(function ($record) {
                    return $record->id;
                })
                ->addColumn('action', function($row){
                    $upadate_url=route('adherant.edit', $row->id);
                    $delete_url=route('adherant.delete', $row->id);
                    $actionBtn = '<a href="'.$upadate_url.'" class="edit btn btn-success btn-sm">Edit</a> <a href="'.$delete_url.'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('Sous-categorie', function($data){

                    return $data->subsector->name;
                })
                ->rawColumns(['Sous-categorie','action'])
                ->make(true);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $adherants = Adherant::all();
        return view('admin.adherant.index',compact('adherants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $adherant = new adherant();
        $adherant->name = $request->get('name');
        $adherant->lastname = $request->get('firstname');
        $adherant->email = $request->get('email');
        $adherant->firm_name = $request->get('firm_name');
        $adherant->firm_create_date = $request->get('firm_create_date');
        $adherant->firm_ifu = $request->get('firm_ifu');
        $adherant->personnal_ifu = $request->get('personnal_ifu');
        $adherant->trade_register_number = $request->get('trade_register_number');
        $adherant->subsector_id = $request->get('subsector_id');
        $adherant->save();
        Mail::to($adherant->email)->send(new \App\Mail\AdhesionMail($adherant));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adherant  $adherant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd("kkk");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adherant  $adherant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {
        $adherant=Adherant::find($id);
        $subsectors=Subsector::all();


        return view('admin.adherant.edit', compact('adherant','subsectors'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adherant  $adherant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $adherant = Adherant::find($id);
        $adherant->name = $request->get('name');
        $adherant->lastname = $request->get('firstname');
        $adherant->email = $request->get('email');
        $adherant->firm_name = $request->get('firm_name');
        $adherant->firm_create_date = $request->get('firm_create_date');
        $adherant->firm_ifu = $request->get('firm_ifu');
        $adherant->personnal_ifu = $request->get('personnal_ifu');
        $adherant->trade_register_number = $request->get('trade_register_number');
        $adherant->subsector_id = $request->get('subsector_id');
        $adherant->save();
        return redirect()->route('adherant.index')->with('success', 'Your data is added successfully. 🥳');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adherant  $adherant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $adherant=Adherant::find($id);
        $adherant->delete();
        return redirect()->route('adherant.index')->with('success', 'You has been deleted this event 🥹');



    }
}
