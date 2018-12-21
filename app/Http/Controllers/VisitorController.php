<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests;
use App\Api;
use App\ApiLog;
use App\Visitor;
use Hashids;
use DB;
use Config;
use Torann\GeoIP\Facades\GeoIP;

class VisitorController extends Controller
{
	use \App\Traits\StatusResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		// if super admin, then list all api
		// $CurrentUserRole = auth()->user()->roles->pluck('name')->toArray();	
		// if(in_array(Config::get('app.admin_level.1'),$CurrentUserRole)){
			// $apis = Api::all(); 
		// }else{
			$apis = Api::where('account_uid',auth()->user()->uid)->get();			
		//}
        return view('dashboard.api')->with(compact('apis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

			if(Api::where('account_uid',$request->user()->uid)->count()<3){
				$data = new Api();
				$data->account_uid =  $request->user()->uid;
				$data->key = Api::generateKeyCode();
				$data->save();
				return back()->with('success',' Record was successfully updated.');
			}
			return back()->with('error',' maximum allowed api reached.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
		$id = $request->get('id');
		$i=Hashids::decode($id);
        $data = Api::findorfail(strval($i[0]));
        $data->delete();
    }
	
   public function data(){
		
		// if super admin, then list all api
		//$CurrentUserRole = auth()->user()->roles->pluck('name')->toArray();	
		//if(in_array(Config::get('app.admin_level.1'),$CurrentUserRole)){
		//	$data = Api::all(); 
		//}else{
			$data = Api::where('account_uid',auth()->user()->uid)->get();			
		//}		
		
		
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
				$hid=Hashids::encode($data->id);
                return '<div class="text-center">
                            <div class="btn-group">
                                <button id="btndelete" class="btn btn-sm btn-danger btndelete" data-toggle="tooltip" data-placement="top" title="Delete Record" data-token='. csrf_token() .' data-docid='.$hid.'><i class="fa fa-trash-o"></i></button> 
                            </div>
                        </div>
                        ';
            })
        ->addIndexColumn()
        ->editColumn('key', '<strong>{{ $key }}</strong>')
        ->editColumn('created_at',function ($data){
                        return  '<div class="text-center">' . $data->created_at->diffForHumans() . '</div>';
                        })
		->make(true);
    }	
	
    public function api_log(Request $request)
    {
		$mode = $request->query('mode');
		
		$api_log = new Visitor;
		//$api_log->user_id=auth()->user()->uid;
        
        //$ip = $request->ip();
        //$geo_inf = geoip($ip = null);
        //$g = geoip()->getLocation($ip);
        

		switch ($mode) {
			case "day":
				$out = $api_log->today();
				break;
			case "week":
				$out = $api_log->weekly();
				break;
			case "monthly":
				$out = $api_log->monthly();
				break;				
			default:	
				$out = $api_log->weekly();
		}

		return $this->Response($out);
    }


	
}
