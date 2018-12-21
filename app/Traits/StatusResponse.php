<?php
 
namespace App\Traits;
use SoapBox\Formatter\Formatter; 

trait StatusResponse {
	public function Status($stat,$message){
		$response=[
			'status'=>$stat,
			'message'=>$message
		];
		$formatter = Formatter::make($response, Formatter::ARR);
		return $formatter->toJson();		
	}
	public function Response($arr){
		$formatter = Formatter::make($arr, Formatter::ARR);
		return $formatter->toJson();		
	}
	
}