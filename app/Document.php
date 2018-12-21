<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
	protected $table = 'documents';
	public $timestamps = true;	
	
	use \App\Traits\AutoUid;
	protected $uidFieldName = 'uid'; 
	protected $uidPrefix = 'DOC';
	
    protected $fillable = [
        'uid','file_name', 'doc_name' 
    ];	
}
