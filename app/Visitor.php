<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
use DateTime;

class Visitor extends Model
{
	protected $table = 'visitor';
	public $timestamps = true;	
    protected $fillable=['id','query','ip','created_at','updated_at'];
    
	private function getCountries(){
		return self::select('country')->distinct()->get()->toArray();
	}    

	public function today(){
        $countries = $this->getCountries();
        
        //$gcolor =['#00ff00','#ff8080','#8080ff','#ff0080','#0080ff'];
		date_default_timezone_set('Asia/Dubai'); 
		
		$response=array();
		foreach($countries as $i=>$key){
            //$color ='#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
            $color = '#' .substr(md5(rand()), 0, 6);
			$data2 = array();
			//foreach($dow as $dw){
                $thisday = date("Y-m-d",strtotime('today'));
                
				$dat = DB::table('visitor')
					  ->select('created_at',
						DB::raw('DATE(created_at) as today'),
						DB::raw('HOUR(created_at) as hour'), 
						DB::raw('UNIX_TIMESTAMP(created_at) as log_date'),
						DB::raw('count(*) as views'))
                      ->where(DB::raw('DATE(created_at)'),'=',$thisday)
                      ->where('country','=',$key['country'])
                      ->groupBy('hour')->orderBy('created_at','ASC')->get();
                      	
				foreach($dat as $d){
					$data2[]=$this->gdt($d->log_date,$d->views,$d->created_at); 
				}
				if(sizeof($dat)==0){
					$udate = Carbon::parse($thisday);
					$carbon = $udate->toDateTimeString($thisday);
					$data2[]=$this->gdt($udate->timestamp,0,$carbon); 
				}
			//}	
			$out=[
				'label'=>$key['country'],
				'color'=>$color,
				'points'=>['fillColor'=>$color,'show'=>true],
				'lines'=>['show'=>true,'fill'=>"0.6",'lineWidth'=>'0'],
				'data'=>$data2,
			];
			array_push($response,$out);
		}
		return $response;			
    }
    
	public function weekly(){
		date_default_timezone_set('Asia/Dubai'); 
		$countries = $this->getCountries();		
		$dow = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
		$gcolor =['#00ff00','#ff8080','#8080ff','#ff0080','#0080ff'];
		
		$response=array();
		foreach($countries as $i=>$key){
            $color = '#' .substr(md5(rand()), 0, 6);
			$i=0;
			$data2 = array();
			foreach($dow as $dw){
				$thisday = date("Y-m-d",strtotime($dw.' this week'));
				$dat = DB::table('visitor')
					  ->select('created_at',
						DB::raw('DATE(created_at) as today'),
						DB::raw('UNIX_TIMESTAMP(created_at) as log_date'),
						DB::raw('count(*) as views'))
                      ->where(DB::raw('DATE(created_at)'),'=',$thisday)
                      ->where('country','=',$key['country'])
					  ->groupBy('today')->orderBy('created_at','ASC')->get();	
				foreach($dat as $d){
					$data2[]=$this->gdt($d->log_date,$d->views,$d->created_at); 
				}
				if(sizeof($dat)==0){
					$udate = Carbon::parse($thisday);
					$carbon = $udate->toDateTimeString($thisday);
					$data2[]=$this->gdt($udate->timestamp,0,$carbon.'-'.$dw); 
				}
			}	
			$out=[
				'label'=>$key['country'],
				'color'=>$color,
				'points'=>['fillColor'=>$color,'show'=>true],
				'lines'=>['show'=>true,'fill'=>"0.6",'lineWidth'=>'0'],
				'data'=>$data2,
			];
			array_push($response,$out);
		}
		return $response;		
	}


	public function monthly(){
		date_default_timezone_set('Asia/Dubai'); 
		$countries = $this->getCountries();		
		$dow = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
		$gcolor =['#00ff00','#ff8080','#8080ff','#ff0080','#0080ff'];
		
		$response=array();
		foreach($countries as $i=>$key){
			$i=0;
			$data2 = array();
			foreach($dow as $dw){
				$thisday = date("Y-m-d",strtotime($dw.' this week'));
				$dat = DB::table('visitor')
					  ->select('created_at',
						DB::raw('DATE(created_at) as today'),
						DB::raw('UNIX_TIMESTAMP(created_at) as log_date'),
						DB::raw('count(*) as views'))
                      ->where(DB::raw('DATE(created_at)'),'=',$thisday)
                      ->where('country','=',$key['country'])
					  ->groupBy('today')->orderBy('created_at','ASC')->get();	
				foreach($dat as $d){
					$data2[]=$this->gdt($d->log_date,$d->views,$d->created_at); 
				}
				if(sizeof($dat)==0){
					$udate = Carbon::parse($thisday);
					$carbon = $udate->toDateTimeString($thisday);
					$data2[]=$this->gdt($udate->timestamp,0,$carbon.'-'.$dw); 
				}
			}	
			$out=[
				'label'=>$key['country'],
				'color'=>$color,
				'points'=>['fillColor'=>$color,'show'=>true],
				'lines'=>['show'=>true,'fill'=>"0.6",'lineWidth'=>'0'],
				'data'=>$data2,
			];
			array_push($response,$out);
		}
		return $response;		
	}




	private function gdt($datetime,$value,$log) {
		$retval = array();
		//$retval[]=strtotime($datetime)*1000;
		$retval[]=$datetime*1000;	
		$retval[]=$value;
		$retval[]=$log;
		return  $retval;
	}
	private function gdn($n,$value) {
		$retval = array();
		$retval[]=$n;
		$retval[]=$value;
		return  $retval;
	}


	private function gd($year, $month, $day,$value) {
		$retval = array();
		$retval[]=intval(strtotime($day."-".$month."-".$year))*1000;
		$retval[]=$value;
		return  $retval;
	}    

}
