<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
	protected $table = 'roles';
	public $timestamps = true;
	
	use \App\Traits\AutoUid;
	protected $uidPrefix = 'RL';	
	
}
