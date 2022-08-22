<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
	public function __construct() {
        // $this->middleware(['auth', 'isAdmin']);//isAdmin middleware lets only users with a //specific permission permission to access these resources
    }
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get()->map(function ($role) {
            $role->roles = str_replace(['[', ']', '"'], '', $role->permissions()->pluck('name'));
            $role->created_at = date('d F Y', strtotime($role->created_at));

            return $role;
        });
		
		
		
		if($roles->count() > 0){ 
			 //$roles = json_decode($roles, true);
		}
        $page_title = 'Roles';
        $page_description = 'Manage Roles';
       

        return view('roles.index', compact('roles', 'page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        //Get all permissions
        return view('roles.create', ['permissions'=>$permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate name and permissions field
        $this->validate(
            $request,
            [
            'name'=>'required|unique:roles|max:30',
            'permissions' =>'required',
        ]
        );

        $name = $request['name'];
        $role = new Role();
        $role->name = $name;

        $permissions = $request['permissions'];

        $role->save();
        //Looping thru selected permissions
        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            //Fetch the newly created role and assign permission
            $role = Role::where('name', '=', $name)->first();
            $role->givePermissionTo($p);
        }

        return redirect()->route('roles.index')
            ->with('success', $role->name.' added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles = Role::where('id', $id)->get()->map(function ($role) {
            $role->roles = str_replace(['[', ']', '"'], ' ', $role->permissions()->pluck('name'));
            $role->created_at = date('d F Y', strtotime($role->created_at));

            return $role;
        });
        $page_title = 'Details';
        $page_description = 'Roles Details';

        return view('roles.detail', compact('roles', 'page_title', 'page_description'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id); //Get role with the given id
        //Validate name and permission fields
        $this->validate($request, [
            'name'=>'required|max:10|unique:roles,name,'.$id,
            'permissions' =>'required',
        ]);

        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];
        $role->fill($input)->save();

        $p_all = Permission::all(); //Get all permissions

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p); //Remove all permissions associated with role
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form //permission in db
            $role->givePermissionTo($p);  //Assign permission to role
        }

        return redirect()->route('roles.index')
            ->with('success', $role->name.' updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(['status' => 'success'], 200);
    }
}
