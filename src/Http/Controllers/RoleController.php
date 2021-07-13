<?php


#==========================
# Author: Shahid
# Date: April 2021
# shahidcseku@gmail.com
#==========================


namespace sha443\rbac\Http\Controllers;

use sha443\rbac\Models\Role;
use Illuminate\Http\Request;

class RoleController extends RBACBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Role List";
        $role_list = Role::paginate(20);
        return view('rbac::roles.index', compact('role_list','title'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addEdit(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'display_name'=>'required',
        ]);
        $id = $request->input('id');
        if($id)
        {
            // Edit/Update
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->display_name = $request->input('display_name');
            $role->active = $request->input('active');
            $role->save();
            self::success('Role updated successfully!');
            return redirect('/role/');
        }
        else
        {
            // create new one
            Role::create($request->all());
            self::success('Role created successfully!');
            return redirect('/role/');
        }

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
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
