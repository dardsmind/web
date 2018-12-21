<?php

namespace App;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model implements Sortable
{
	use SortableTrait;

	protected $table = 'blog';
	public $timestamps = true;	
	protected $fillable=['title','content','author_id','category_id','tags','publish','frontpage','order_column']; 

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];	
	  
}
