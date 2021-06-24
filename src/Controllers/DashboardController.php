<?php


namespace Artadmin\Controllers;


use App\Http\Controllers\Controller;
use Artadmin\Repository\CacheRepository;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index(){


        return view("artadmin::index");
    }

    public function clear_cache(){
        CacheRepository::clear();

        return back()->with("success",trans("artadmin::notify.cache_clear"));
    }

    public function logout(){
        $user=Auth::guard("admin")->logout();

        return redirect()->route("artadmin.login");

    }
}
