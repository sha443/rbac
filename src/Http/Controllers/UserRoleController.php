<?php


#==========================
# Author: Shahid
# Date: April 2021
# shahidcseku@gmail.com
#==========================


namespace sha443\rbac\Http\Controllers;

use sha443\rbac\Models\UserRole;
use sha443\rbac\Models\DummyUser;
use sha443\rbac\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Route;
use Exception;

class UserRoleController extends RBACBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($search_result=NULL)
    {
        $title = "User role";
        $user_list = DummyUser::get();
        $role_list = Role::where('active',1)->get();
        $user_role_list = UserRole::with('user','role')->paginate(20);

        return view('rbac::roles.assign-role',compact('user_role_list','user_list','role_list','title','search_result'));
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

    public function searchOrStore(Request $request)
    {
        switch($request->submit) {
            case 'Assign Role': 
                return $this->store($request);
            break;

            case 'Search User Role': 
                return $this->search($request);
            break;
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
        
        // print_r($request->all()); exit;
        $valid = Validator::make($request->all(), [
            'user_id'=>'required',
            'role_id'=>'required',
        ]);

        if ($valid->fails())
        {
            return redirect()->back();
        }
        try
        {
            // dd($request->all());
            UserRole::create($request->all());
            self::success('User Role created successfully!');
            return redirect()->back();
        }
        catch (Exception $e)
        {
            self::warning('User Role cannot be created!');
            return redirect()->back();
        }
        return redirect()->back();
    }
    public function search(Request $request)
    {
        // print_r($request->all()); exit;
        $valid = Validator::make($request->all(), [
            'user_id'=>'required',
        ]);

        if ($valid->fails())
        {
            return redirect()->back();
        }
        $search_result = UserRole::with('user','role')->get()->where('user_id',$request->input('user_id'));
        return $this->index($search_result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function show(UserRole $userRole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title="Edit user role";
        if($id)
        {
            // Edit/Update
            $user_role = UserRole::with('user','role')->find($id);
            $user_list = DummyUser::get();
            $role_list = Role::get()->where('active',1);

            return view('rbac::roles.edit-user-role',compact('user_role','title','user_list','role_list'));
      
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_role = UserRole::find($id);

        $valid = Validator::make($request->all(), [
        'user_id'=>'required',
        'role_id'=>'required',
        ]);

        if ($valid->fails())
        {
            return redirect()->back();
        }

        $user_role->update($request->all());
        
        self::success('User Role updated successfully!');
        return redirect(route('user_role_index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserRole  $userRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRole $userRole)
    {
        //
    }
}
