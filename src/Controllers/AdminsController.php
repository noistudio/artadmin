<?php


namespace Artadmin\Controllers;


use App\Http\Controllers\Controller;
use Artadmin\Models\Permission;
use Artadmin\Models\Role;
use Artadmin\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{

    public function index(){
        $user=artadmin_user();
        $request_vars=request()->all();

        $admins=User::query()->with(["roles","permissions"])->where(function($query) use ($user,$request_vars){
            $query->where("id","!=",$user->id);

            if(isset($request_vars['role']) and is_numeric($request_vars['role']) and (int)$request_vars['role']>0){
            $query->whereHas("roles",function($query) use ($request_vars){

               $query->where("id",$request_vars['role']);
            });
            }
            if(isset($request_vars['permission']) and is_numeric($request_vars['permission']) and (int)$request_vars['permission']>0) {
                $query->where(function ($query) use ($request_vars) {

                    $query->orWhereHas("roles.permissions", function ($query) use ($request_vars) {
                        $query->where("id", (int)$request_vars['permission']);
                    });
                    $query->orWhereHas("permissions", function ($subquery) use ($request_vars) {
                        $subquery->where("id", (int)$request_vars['permission']);
                    });
                });
            }

        })->get();


        $data=array();
        $data['rows']=$admins;
        $data['roles']=Role::query()->get();
        $data['permissions']=Permission::query()->get();
        $data['request_all']=$request_vars;


        return view("artadmin::admins.list",$data);
    }

    public function add(Request $request){

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:rfc,dns|unique:\Artadmin\Models\User,email',
            'password'=>'required|min:6|max:255',
        ]);

        $new_admin=new User();
        $new_admin->name=$validated['name'];
        $new_admin->email=$validated['email'];
        $new_admin->password=Hash::make($validated['password']);




        $new_admin->save();

        $roles=$request->post('roles');
        $permissions=$request->post("permissions");
        if(isset($roles) and is_array($roles) and count($roles)>0){
            foreach($roles as $role){
                $role_model=Role::query()->find($role);
                if($role_model){
                    $new_admin->roles()->attach($role_model);
                }
            }
        }

        if(isset($permissions) and is_array($permissions) and count($permissions)>0){
            foreach($permissions as $permission){
                $permission_model=Permission::query()->find($permission);
                if($permission_model){
                    $new_admin->permissions()->attach($permission_model);
                }
            }
        }

        return back()->with("success",trans("artadmin::notify.admin_success"));

    }

    public function doedit($id){

        $request=request();

        $admin=User::query()->find($id);
        if(!$admin){
            return back()->with("error",trans("artadmin::notify.not_found_admin"));
        }
        $validated = $request->validate([
            'name' => 'required|max:255',

            'password'=>'nullable|min:6|max:255',
        ]);


        $admin->name=$validated['name'];

        if(isset($validated['password']) and strlen($validated['password'])>0) {

            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        $admin->roles()->detach();
        $admin->permissions()->detach();

        $roles=$request->post('roles');
        $permissions=$request->post("permissions");
        if(isset($roles) and is_array($roles) and count($roles)>0){
            foreach($roles as $role){
                $role_model=Role::query()->find($role);
                if($role_model){
                    $admin->roles()->attach($role_model);
                }
            }
        }

        if(isset($permissions) and is_array($permissions) and count($permissions)>0){
            foreach($permissions as $permission){
                $permission_model=Permission::query()->find($permission);
                if($permission_model){
                    $admin->permissions()->attach($permission_model);
                }
            }
        }

        return back()->with("success",trans("artadmin::notify.admin_success_save"));

    }
    public function edit($id){
        $user=User::query()->find($id);
        if(!$user){
            return back()->with("error",trans("artadmin::notify.not_found_admin"));
        }

        $data=array();
        $data['user']=$user;
        $data['roles']=Role::query()->get();
        $data['permissions']=Permission::query()->get();

        return view("artadmin::admins.edit",$data);



    }
    public function delete($id){
        $user=artadmin_user();

        User::query()->where("id","!=",$user->id)->where("id",$id)->delete();
        return back()->with("success",trans("artadmin::notify.admin_delete"));
    }

}
