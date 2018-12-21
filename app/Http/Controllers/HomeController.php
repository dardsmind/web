<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use ConfigController as CONFIG;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
        return view('dashboard.home');
    }
	
	
	
    public function tasks()
    {
        return view('dashboard.tasks');
    }	
	
    public function apihelp()
    {
        return view('dashboard.help');
    }		
	
    public function routes()
    {
		$routes = Route::getRoutes();
        return view('dashboard.routes',compact('routes'));
    }	
}
