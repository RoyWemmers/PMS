<?php

namespace App\Http\Controllers;

use App\Deadlines;
use App\Participant;
use App\Project;
use App\Category;
use App\Customer;
use Illuminate\Http\Request;

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
        $data = [];

        $data['projects'] = Project::join('deadlines', 'projects.id', '=', 'deadlines.projectid')
                                    ->join('participants', 'projects.id', '=', 'participants.projectid')
                                    ->join('categories', 'projects.id', '=', 'categories.projectid');

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
        $data['deadlines'] = Deadlines::where('projectid', $projectid)->get();
        $data['category'] = Category::where('projectid', $projectid)->get();
        $data['participants'] = Participant::where('projectid', $projectid)->get();

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
