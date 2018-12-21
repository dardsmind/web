<?php
 
namespace App\Traits;
use Keygen; 
trait AutoUid {
 
    public static function bootAutoUid(){
		// this execute when creating new record
        static::creating(function($model) {
            $uidFieldName = $model->getUIDFieldName();
			$uidPrefix = $model->getUIDPrefix();
            if(empty($model->$uidFieldName)){
				$id = $uidPrefix.static::generateUID();
				while ($model::whereUid($id)->count() > 0) {
					$id = $uidPrefix.static::generateUID();
				}				
                $model->$uidFieldName = $id;
            }
			
			
        });
		
		// this execute when updating record
        // static::updating(function($model) {
            // $uidFieldName = $model->getUIDFieldName();
			// $uidPrefix = $model->getUIDPrefix();
            // if(empty($model->$uidFieldName)){
				// $id = $uidPrefix.static::generateUID();
				// while ($model::whereUid($id)->count() > 0) {
					// $id = $uidPrefix.static::generateUID();
				// }				
                // $model->$uidFieldName = $id;
            // }
        // });		
    }
	
    public function getUIDFieldName(){
        if(!empty($this->uidFieldName)){
            return $this->uidFieldName;
        }
        return 'uid';
    }	
	
    public function getUIDPrefix(){
        if(!empty($this->uidPrefix)){
            return $this->uidPrefix;
        }
        return 'UID';
    }	
	
    public static function generateUID(){
        //return date('YmdHis');
		return Keygen::numeric(7)->prefix(mt_rand(1, 9))->generate(true);
    }	
 
 
	public static function generateCode()
	{
		return Keygen::bytes()->generate(
			function($key) {
				// Generate a random numeric key
				$random = Keygen::numeric()->generate();

				// Manipulate the random bytes with the numeric key
				return substr(md5($key . $random . strrev($key)), mt_rand(0,8), 20);
			},
			function($key) {
				// Add a (-) after every fourth character in the key
				return join('-', str_split($key, 4));
			},
			'strtoupper'
		);
	} 
 
 
}