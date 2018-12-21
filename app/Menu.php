<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
	public static function SetMenuActive($route,$menuitem){
		$active="";
		if($route==$menuitem){
			$active="active";
		}
		return $active;
		// {{App\Menu::SetMenuActive(Request::path(),'dashboard/configuration')}}
	}
}
