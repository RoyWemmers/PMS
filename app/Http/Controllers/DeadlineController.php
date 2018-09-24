<?php

namespace App\Http\Controllers;

use App\deadline;
use Illuminate\Http\Request;

class DeadlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function show(deadline $deadline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function edit(deadline $deadline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->deadlinename;
        $date = date('Y-m-d', strtotime($request->deadlinedate));
        $project_id = $request->projectid;

        Deadline::where('id', $id)->update([
            'name' => $name,
            'time' => $date
            ]);

        return \Redirect::route('projects.show', ['id' => $project_id, 'status' => 'success', 'statusMessage' => 'Updated deadline successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function destroy(deadline $deadline)
    {
        //
    }
}
