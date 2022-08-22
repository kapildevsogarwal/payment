<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        //isAdmin middleware lets only users with a
        //specific permission permission to access these resources
        //$this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('id', 'desc')->get(); //Get all permissions
		if($permissions->count() > 0){ 
			//$permissions = $permissions->toJson();
			//$permissions = json_decode($permissions, true);
		}
		
        $page_title = 'Permissions';
        $page_description = 'Manage Permissions';
       

        return view('permissions.index', compact('permissions', 'page_title', 'page_description'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get(); //Get all roles
        $page_title = 'Manage Permissions';
        $page_description = 'Create Permission';

        return view('permissions.create', compact('roles', 'page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (! empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = Role::where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = Permission::where('name', '=', $name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }

        return redirect()->route('permissions.index')
            ->with('success', $permission->name.' added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $page_title = 'Permissions';
        $page_description = 'Manage Permissions';

        return view('permissions.edit', compact('permission', 'page_title', 'page_description'));
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
        $permission = Permission::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $input = $request->all();
        $permission->fill($input)->save();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission, "'.$permission->name.'" updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response()->json(['status' => 'success'], 200);
    }
}
