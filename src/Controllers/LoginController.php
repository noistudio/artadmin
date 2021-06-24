<?php

namespace Artadmin\Controllers;



use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends \App\Http\Controllers\Controller
{
    protected $guard = null;
    function __construct()
    {

        $this->guard=config("artadmin.guard");

    }

    function login(){

        $data=array();





        return view('artadmin::login');
    }

    public function doit(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
       // $credentials['password']='$2y$10$knqf72eah8jGZ40DxZ2bMePtKvg1g7Bd5zBIA5QtYhF8XGsAD7rGK';

        if (Auth::guard($this->guard)->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route(config("artadmin.route_after_login"))
                ->withSuccess(trans("artadmin::login.success"));
        }

        return redirect()->route("artadmin.login")->withErrors([trans("artadmin::login.incorrect")]);
    }


}
