<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'category';
	public $timestamps = true;	
	protected $fillable=['name','slug']; 
}
