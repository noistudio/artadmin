<?php


namespace Artadmin\Controllers;


use App\Http\Controllers\Controller;
use Artadmin\Models\Permission;
use Artadmin\Models\Role;

class RoleController extends Controller
{

    function index(){

        $request_vars=request()->all();
        $data=array();
        $data['rows']=Role::query()->where(
            function($query) use ($request_vars){
                $query->where("slug","!=","admin");

                if(isset($request_vars['permission']) and is_numeric($request_vars['permission']) and (int)$request_vars['permission']>0) {
                    $query->whereHas("permissions", function ($query) use ($request_vars) {
                        $query->where("id", (int)$request_vars['permission']);
                    });
                }
            }
        )->get();
        $data['permissions']=Permission::query()->get();
        $data['request_all']=$request_vars;

        return view("artadmin::roles.list",$data);
    }

    function show($id){

        $role=Role::query()->find($id);
        if(!$role){
            return back();
        }
        $data=array();
        $data['role']=$role;
        $data['permissions']=Permission::query()->get();

        return view("artadmin::roles.show",$data);
    }

    function update($id){
        $role=Role::query()->find($id);
        if(!$role){
            return back()->with("error",trans("artadmin::notify.role_not_found"));
        }

        $role->permissions()->detach();

        $request=request();
        $permissions=$request->post("permissions");


        if(isset($permissions) and is_array($permissions) and count($permissions)>0){
            foreach($permissions as $permission){
                $permission_model=Permission::query()->find($permission);
                if($permission_model){
                    $role->permissions()->attach($permission_model);
                }
            }
        }

        return back()->with("success",trans("artadmin::notify.role_success_save"));

    }

    function add(){
            $request=request();
            $validated=$request->validate([
                'name' => 'required|unique:\Artadmin\Models\Role,name|max:255',
                'slug' => 'required|regex:/(^([a-zA-Z_]+)(\d+)?$)/u|unique:\Artadmin\Models\Role,slug|max:30',]);


            $role=new Role();
            $role->name=$validated['name'];
            $role->slug=$validated['slug'];
            $role->save();

            return back()->with("success",trans("artadmin::notify.role_success"));



        }

    function delete($id){
        Role::query()->where("slug","!=","admin")->where("id",$id)->delete();

        return back()->with("success",trans("artadmin::notify.role_delete"));

    }


}
