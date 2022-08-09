<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;


class IndexController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = event::latest()->get();
        $events_count= event::latest()->count();
        return view('site.home',compact('events','events_count'));
    }
}
