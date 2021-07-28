<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    //
    public function create_role(){
        return view('admin.roles.create');
    }


    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required'
        ]);

        $roles = new Role([
            'name' => $request->get('name'),
            'slug' => $request->get('slug')
        ]);

        $roles->save();

        return Redirect::back()->with('success', 'Role Created Successfully');

    }


    public function show(){
        $roles = Role::all();
        return view('admin.roles.view_all_roles', ['roles'=> $roles]);
    }

    public function delete(Role $role){
        $role->delete();
        return redirect()->route('show.roles');
    }

    public function edit($role_id){
        $role = Role::find($role_id);
        return view('admin.roles.edit_role', compact('role'));
    }

    public function update(Request $request, $id){
        $role = Role::find($id);

        $this->validate( $request, [
            'name' => 'required',
            'slug' =>'required'
        ]);

        $role->update($request->all());

        return redirect()->route('show.roles');
    }

    public function user_role_manage(){
        $users = User::all();
        // $roles = Role::all();
        return view('admin.roles.user_role_manage', ['users'=>$users]);
    }

    public function add_user_role(Request $request, $id){
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.roles.add_user_role', ['roles'=> $roles, 'user'=>$user]);
    }

    public function user_role_create(Request $request, $id){
        $user = User::find($id);
        $request_role_id = $_POST['role_id'];
        $user->roles()->attach($request_role_id);
        // $role = Role::whereId($request_role_id);
        // dd($role);
        // $user->roles()->save($role);
    //     DB::table('role_user')->insert(
    //         array(
    //                'user_id'     =>   $user->id, 
    //                'role_id'   =>   $request_role_id
    //         )
    //    );

        
        // $user->roles()->attach($role);
        return redirect()->route('user_role_manage');
    }



    public function delete_user_role($id){
        // dd($id);
        $user = User::find($id);
        $roles = $user->roles;

        return view('admin.roles.delete_user_role', ['roles' => $roles, 'user'=>$user]);
    }


    public function user_role_deleted($id){
        $user = User::find($id);
        $request_role_id = $_POST['role_id'];
        $user->roles()->detach($request_role_id);
        return redirect()->route('user_role_manage');
    }
}