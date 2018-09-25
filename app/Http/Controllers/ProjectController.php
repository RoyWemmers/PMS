<?php

namespace App\Http\Controllers;

use App\User;
use App\Participant;
use App\Project;
use App\Category;
use App\Customer;
use App\Userroles;
use App\Roles;
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
        $id =  Project::insertGetId([
            'name' => $request->projectname,
            'customer_id' => $request->customerid,
            'active' => 1,
            'budget' => $request->budget,
            'spent' => '00:00:00',
            'trello_link' => '',
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return \Redirect::route('projects.show', ['id' => $id, 'status' => 'success', 'statusMessage' => 'Project created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data['project'] = Project::where('id', $id)->with('customer')->get()[0];
        $data['deadlines'] = Deadline::where('project_id', $id)->get();
        $data['category'] = Category::where('project_id', $id)->get();
        $data['participants'] = Project::with(['User', 'user.roles'])->get();
        $data['users'] = User::get();
        $data['roles'] = Roles::get();
        $data['customers'] = Customer::get();

        if($request->user()->is_admin == 1) {
            return view('project/projectadmin', $data);
        }
        return view('project/project', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $projectname    = $request->projectname;
        $customerid     = $request->customer_id;
        $budget         = $request->budget;
        $spent          = $request->spent;
        $trello         = $request->trellolink;
        if(empty($request->active)) {
            $active = 0;
        } else {
            $active         = $request->active;
        }
        $description    = $request->description;

        Project::where('id', $id)
            ->update([
                'name'          => $projectname,
                'customer_id'   => $customerid,
                'budget'        => $budget,
                'spent'         => $spent,
                'active'        => $active,
                'trello_link'   => $trello,
                'description'   => $description,
                ]);

        return \Redirect::route('projects.show', ['id' => $id, 'status' => 'success', 'statusMessage' => 'Update executed successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->projectid;

        Participant::where('project_id', $id)->delete();
        Deadline::where('project_id', $id)->delete();
        Project::where('id', $id)->delete();

        return \Redirect::route('projects', ['status' => 'success', 'statusMessage' => 'Project deleted successfully']);
    }

}
