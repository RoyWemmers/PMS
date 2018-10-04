<?php

namespace App\Http\Controllers;

use App\logbook;
use App\User;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $userid = $request->user()->id;

        $data['logs'] = Logbook::where('user_id', $userid)->with('project')->get();


        $data['projects'] = User::with('project')->where('id', $userid)->get();

        $data['userid'] = $userid;

        return view('logbook', $data);
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
        $userid         = $request->userid;
        $projectid      = $request->project;
        $description    = $request->description;
        $startdate      = $request->startdate;
        $starttime      = $request->starttime;
        $enddate        = $request->enddate;
        $endtime        = $request->endtime;
        $duration       = $request->duration;

        $start          = $startdate . ' ' . $starttime . ':00';
        $end            = $enddate . ' ' . $endtime . ':00';

        Logbook::insert([
            'project_id'    => $projectid,
            'user_id'       => $userid,
            'description'   => $description,
            'starttime'     => $start,
            'endtime'       => $end,
            'duration'      => $duration,
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
        return \Redirect::route('logbook', ['status' => 'success', 'statusMessage' => 'Added row successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function show(logbook $logbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function edit(logbook $logbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, logbook $logbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\logbook  $logbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(logbook $logbook)
    {
        //
    }
}
