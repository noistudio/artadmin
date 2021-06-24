<?php


namespace Artadmin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class MyController extends  Controller
{

    function index(){


        return view("artadmin::change_password");
    }

    function change(){
        $admin=artadmin_user();
        $post=request()->post();
        $admin->makeVisible(['password']);



        if(!(isset($post['old_password']) and is_string($post['old_password']) and Hash::check($post['old_password'],$admin->password)) ){
            return back()->with("error",trans("artadmin::notify.old_password_incorrect"));
        }
        if(!(isset($post['new_password']) and is_string($post['new_password']) and strlen($post['new_password'])>5)){
            return back()->with("error",trans("artadmin::notify.new_password_incorrect"));
        }

        $admin->password=Hash::make($post['new_password']);
        $admin->save();

        return back()->with("success",trans("artadmin::notify.password_success"));


    }

}
