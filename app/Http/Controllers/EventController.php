<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use DataTables;


class EventController extends Controller{

    public function getEvents(Request $request)

    {
        if ($request->ajax()) {
            $data = Event::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $upadate_url=route('event.edit', $row->id);
                    $delete_url=route('event.delete', $row->id);
                    $actionBtn = '<a href="'.$upadate_url.'" class="edit btn btn-success btn-sm">Edit</a> <a href="'.$delete_url.'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('image', function ($row) {
                    $url= asset('uploads/'.$row->image);
                    return '<img src="'.$url.'" border="0" width="100px" class="img-rounded" align="center" />';
                     })
                     ->rawColumns(['image','action'])
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
        $all_events = Event::all();

        return view('admin.event.index', compact('all_events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');

     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ext = $request->file('image')->extension();
        $file_name = 'event' . '-' .  date('dmYHis') . '.' . $ext;

        # This will upload inside the directory
        $request->file('image')->move(public_path('uploads/'), $file_name);


        # Save into DB
        $event = new Event();
        $event->image = $file_name;
        $event->author = $request->author;
        $event->description = $request->description;
        $event->start_time = $request->start_time;
        $event->venue = $request->venue;
        $event->statut = $request->statut;
        $event->name = $request->name;


        $event->save();

        # After saving the data return back to home page and show success
        return redirect()->route('event.index')->with('success', 'Your data is added successfully. 🥳');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event=Event::find($id);

        return view('admin.event.edit', compact('event'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {
        $event=Event::find($id);
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            # Delete existing image
            if (file_exists(public_path('uploads/' . $event->image)) and !empty($event->image)) {
                unlink(public_path('uploads/' . $event->image));
            }

            # Upload a new image
            $ext = $request->file('image')->extension();
            $file_name = 'event' . '-' .  date('dmYHis') . '.' . $ext;

            $request->file('image')->move(public_path('uploads/'), $file_name);
            #
            $event->image  = $file_name;
        }
        $event->author = $request->author;
        $event->description = $request->description;
        $event->start_time = $request->start_time;
        $event->venue = $request->venue;
        $event->statut = $request->statut;
        $event->name = $request->name;


        $event->save();
        return redirect()->route('event.index')->with('success', 'Your data is added successfully. 🥳');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event=Event::find($id);

        # If file is existed then delete it
        if (file_exists(public_path('uploads/' . $event->image)) and !empty($event->image)) {
            unlink(public_path('uploads/' . $event->image));
        }

        # Delete the row data
        $event->delete();

        return redirect()->route('event.index')->with('success', 'You has been deleted this event 🥹');
    }
}
