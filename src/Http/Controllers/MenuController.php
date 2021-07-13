<?php

#==========================
# Author: Shahid
# Date: April 2021
# shahidcseku@gmail.com
#==========================


namespace sha443\rbac\Http\Controllers;

use sha443\rbac\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends RBACBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Menu List";
        $menu_list = Menu::paginate(20);
        return view('rbac::menus.index',compact('menu_list','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addEdit(Request $request)
    {
        $this->validate($request, [
            'action'=>'required',
            'display_name'=>'required',
        ]);
        $id = $request->input('id');

        if($id)
        {
            // Edit/Update
            $menu = Menu::find($id);
            $menu->action = $request->input('action');
            $menu->display_name = $request->input('display_name');
            $menu->icon = $request->input('icon');
            $menu->level = $request->input('level');
            $menu->active = $request->input('active');
            $menu->save();
            self::success('Menu updated successfully!');
            return redirect()->back();
        }
        else
        {
            // create new one
            Menu::create($request->all());
            self::success('Menu created successfully!');
            return redirect()->back();
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
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
