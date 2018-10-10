<?php

namespace App\Http\Controllers;

use App\Roles;
use App\Userroles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = Roles::get();
        return view('roles', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rolename = $request->rolename;

        Roles::insert([
            'name' => $rolename,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return \Redirect::route('roles', ['status' => 'success', 'statusMessage' => 'Role created successfully']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $roleid     = $id;
        $rolename   = $request->rolename;

        if(!empty($rolename)) {
            Roles::where('id', $roleid)
                ->update([
                    'name'      => $rolename,
                    'updated_at'    => now()
                ]);
            return \Redirect::route('roles', ['status' => 'success', 'statusMessage' => 'Role updated successfully']);
        }

        return \Redirect::route('roles', ['status' => 'error', 'statusMessage' => 'Looks like something went wrong!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Userroles::where('roles_id', $id)->delete();
        Roles::where('id', $id)->delete();

        return \Redirect::route('roles', ['status' => 'success', 'statusMessage' => 'Role deleted successfully!']);
    }
}
