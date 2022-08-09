<?php

namespace App\Http\Controllers;

use App\Subsector;
use Illuminate\Http\Request;
use DataTables;


class SubsectorController extends Controller
{
    public function getSubsectors(Request $request)
    {
        if ($request->ajax()) {
            $data = Subsector::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
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
        $subsectors = Subsector::all();
        return view('admin.subsector.index',compact('subsectors'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subsector.create');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subsector = new subsector();
        $subsector->name = $request->get('name');
        $subsector->save();
        return redirect('/admin/subsector')->with("success","Password changed successfully !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subsector  $subsector
     * @return \Illuminate\Http\Response
     */
    public function show(Subsector $subsector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subsector  $subsector
     * @return \Illuminate\Http\Response
     */
    public function edit(Subsector $subsector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subsector  $subsector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subsector $subsector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subsector  $subsector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subsector $subsector)
    {
        //
    }
}
