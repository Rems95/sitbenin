<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subsector;


class AdhesionController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsectors = Subsector::all();
        return view('adhesion',compact('subsectors'));
    }
}
