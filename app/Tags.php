<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
	protected $table = 'tags';
	public $timestamps = true;	
	protected $fillable=['name','slug'];
}
