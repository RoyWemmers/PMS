<?php

namespace App\Http\Controllers;

use App\participant;
use Illuminate\Http\Request;
use App\Userroles;

class ParticipantController extends Controller
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
        $userid = $request->participant;
        $projectid = $request->projectid;
        $roles = $request->role;

        if(Participant::where('user_id', $userid)->where('project_id', $projectid)->get()->count() == 0) {
            Participant::insert([
                'project_id' => $projectid,
                'user_id' => $userid,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            foreach($roles as $role) {
                if ($role != "") {
                    $command = explode('_', $role)[0];
                    $role_id = explode('_', $role)[1];

                    if ($command == 'remove') {
                        Userroles::where('roles_id', $role_id)
                            ->where('project_id', $projectid)
                            ->where('user_id', $userid)
                            ->delete();
                    }

                    if ($command == 'add') {
                        if(!Userroles::where('user_id', $userid)->where('project_id', $projectid)->where('roles_id', $role_id)->get() == []) {
                            Userroles::insert([
                                'project_id' => $projectid,
                                'user_id' => $userid,
                                'roles_id' => $role_id,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                        }
                    }
                }
            }
            return \Redirect::route('projects.show', ['id' => $projectid, 'status' => 'success', 'statusMessage' => 'Participant Added!']);
        }
        return \Redirect::route('projects.show', ['id' => $projectid, 'status' => 'error', 'statusMessage' => 'This user is already a participant!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $roles          = $request->role;
        $projectid      = $request->projectid;
        $userid         = $request->userid;

        foreach($roles as $role) {
            if($role != "") {
                $command = explode('_', $role)[0];
                $role_id = explode('_', $role)[1];

                if($command == 'remove') {
                    Userroles::where('roles_id', $role_id)
                        ->where('project_id', $projectid)
                        ->where('user_id', $userid)
                        ->delete();
                }

                if($command == 'add') {
                    Userroles::insert([
                        'project_id' => $projectid,
                        'user_id' => $userid,
                        'roles_id' => $role_id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        return \Redirect::route('projects.show', ['id' => $projectid]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $projectid      = $request->projectid;
        $userid         = $request->participantid;

        Userroles::where('project_id', $projectid)
            ->where('user_id', $userid)
            ->delete();


        Participant::where('project_id', $projectid)
            ->where('user_id', $userid)
            ->delete();

        return \Redirect::route('projects.show', ['id' => $projectid]);
    }
}
