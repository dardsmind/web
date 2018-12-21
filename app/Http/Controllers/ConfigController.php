<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Config;

use Krucas\Settings\Facades\Settings;
class ConfigController extends Controller
{
	use \App\Traits\StatusResponse;
	
    public function config()
    {
		//var_dump(Config::all());
		
		$config = array();
		$cnfarr =[
		'filesystems.disks.ftp.host',
		'filesystems.disks.ftp.username',
		'filesystems.disks.ftp.password',
		'filesystems.disks.ftp.root',
		'filesystems.disks.ftp.public',
		'filesystems.disks.s3.key',
		'filesystems.disks.s3.secret',
		'filesystems.disks.s3.region',
		'filesystems.disks.s3.bucket',
		'filesystems.disks.s3.public',
		'mail.host',
		'mail.port',
		'mail.username',
		'mail.password',
		'mail.from.name',
		'mail.from.address',
		'filesystems.default'
		];
		
		foreach($cnfarr as $key){
			$k = str_replace(".", "_", $key);
			$config[$k]=Config::get($key);
		}
        return view('dashboard.configuration')->with($config);
    }	
	public function save_config(Request $request){ 
		$configs = $request->except('_token');
		foreach($configs as $key=>$val){
				$k = str_replace("_", ".", $key);
				//if(Settings::has($k)){
					Settings::forget($k);
					Settings::set($k, $val);
				//}
		}
		return $this->Status("ok","Configuration successfully updated");
	}
	
}
