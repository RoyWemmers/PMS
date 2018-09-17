<?php

namespace App\Http\Controllers;

use App\User;
use App\Participant;
use App\Project;
use App\Category;
use App\Customer;
use App\Userroles;
use Illuminate\Http\Request;
use App\Deadline;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $data['projects'] = Project::get();

        $data['users'] = User::get();

        return view('project/projects', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['customers'] = Customer::get();
        $data['users'] = User::get();

        return view('project/create', $data);
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
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $projectid = $project->id;

        $data['project'] = Project::where('id', $projectid)->get();
        $data['deadlines'] = Deadline::where('projectid', $projectid)->get();
        $data['category'] = Category::where('projectid', $projectid)->get();
        $data['participants'] = Participant::join('users', 'participants.userid', '=', 'users.id')->join('roles', 'roles.id', '=', 'userroles.roleid')->where('projectid', $projectid)->get();

        return view('project/project', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
