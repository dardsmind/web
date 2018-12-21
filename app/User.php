<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use File;
use Spatie\Permission\Traits\HasRoles;
use Hashids;
use App\Api;

class User extends Authenticatable
{
	
	use HasRoles;
	//use \BinaryCabin\LaravelUUID\Traits\HasUUID;
	//protected $uuidFieldName = 'uid'; 
	use \App\Traits\AutoUid;
	protected $uidFieldName = 'uid'; 
	protected $uidPrefix = 'U';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
		'name', 
		'email', 
		'password',
		'avatar',
		'designation',
		'phone',
		'country',
		'city',
		'address',
		'gender',
		'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public $picture ="picture";

	public function getHashId(){
		return Hashids::encode($this->id);
	}
	
	public function getProfilePic(){
		$avatar_path = "/upload/avatars/default_profile.jpg";
		// $ppath = public_path("upload/avatars/".$this->avatar);
		// if((trim($this->avatar)!="")&&(File::exists($ppath))){
			// $avatar_path = "/upload/avatars/".$this->avatar;
		// }		
		
		$ppath = public_path("media/avatar/".$this->avatar);
		if((trim($this->avatar)!="")&&(File::exists($ppath))){
			$avatar_path = "/media/avatar/".$this->avatar;
		}

		return $avatar_path;
	}
	
	// prefix function name with "scope" and call User::ProfilePic()
	public static function ProfilePic($avatar){
		$avatar_path = "/upload/avatars/default_profile.jpg";
		$ppath = public_path("upload/avatars/".$avatar);
		if((trim($avatar)!="")&&(File::exists($ppath))){
			$avatar_path = "/upload/avatars/".$avatar;
		}	
		return $avatar_path;
	}	
	
	// public static function _getProfilePic(){
		// $avatar_path = "/upload/avatars/default_profile.jpg";
		// $ppath = public_path("upload/avatars/".self::avatar);
		// if((trim(self::avatar)!="")&&(File::exists($ppath))){
			// $avatar_path = "/upload/avatars/".self::avatar;
		// }		
		// return $avatar_path;
	// }	
	
	public function hasRole($role)
	{
		return User::where('role', $role)->get();
	}	
	
	public function tokens () {
		return $this->hasMany(Api::class, 'uid', 'account_uid'); // user.uid , api.acount_uid
	}	
}

