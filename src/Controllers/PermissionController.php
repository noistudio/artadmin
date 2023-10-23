<?php


namespace Artadmin\Controllers;


use App\Http\Controllers\Controller;
use Artadmin\Models\Permission;

class PermissionController extends Controller
{

    function index(){

        $data=array();
        $data['rows']=Permission::query()->where("slug","!=","root")->get();

        return view("artadmin::permissions.list",$data);
    }

    function add(){
        $request=request();
        $validated=$request->validate([
            'name' => 'required|unique:\Artadmin\Models\Permission,name|max:255',
            'slug' => 'required|regex:/(^([a-zA-Z_.]+)(\d+)?$)/u|unique:\Artadmin\Models\Permission,slug|max:30',]);


        $permission=new Permission();
        $permission->name=$validated['name'];
        $permission->slug=$validated['slug'];
        $permission->save();

        return back()->with("success",trans("artadmin::notify.permission_success"));



    }

    function delete($id){
        Permission::query()->where("slug","!=","root")->where("id",$id)->delete();

        return back()->with("success",trans("artadmin::notify.permission_delete"));

    }


}
