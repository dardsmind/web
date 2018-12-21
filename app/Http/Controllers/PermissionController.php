<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests;
use Spatie\Permission\Models\Permission;
use Hashids;
use App\Roles;
use DB;

class PermissionController extends Controller
{
    //
	use \App\Traits\StatusResponse;   // json status response
	
    public function index()
    {
        return view('dashboard.permission');
    }	
	
    public function edit($id_)
    {
		$id =  Hashids::decode($id_)[0];
        $data = Permission::findorfail(strval($id));
		
		$data=[
		'status'=>'ok',
		'data'=>$data->name
		];
		return $this->Response($data);		
    }	
	
    public function store(Request $request)
    {
		if($request->mode=="new"){
			$data = new Permission();
			$data->name =  str_replace(" ", "_", strtolower($request->name));
			$data->save();
			return $this->Status("ok","Permission successfully saved");
		}else if($request->mode=="update"){
			
			$id = $request->get('id');
			$i=Hashids::decode($id)[0];	
			$perm = Permission::findorfail($i);
			$input = $request->except(['id','_token','mode']);
			$perm->update($input);
			return $this->Status("ok","Permission successfully updated");
		}
		return; 
    }	
	
    public function destroy(Request $request)
    {
		$id = $request->get('id');
		$i=Hashids::decode($id);
		$ids=strval($i[0]);
        $data = Permission::findorfail(strval($i[0]));
        $data->delete();
		DB::table("role_has_permissions")->where("role_has_permissions.permission_id",$ids)->delete();
    }	
	
   public function data(){
        //$data = Permission::all();
		$data = Permission::select('id','name')->get();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
				$hid=Hashids::encode($data->id);
                return '<div class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary btnedit" data-docid='.$hid.' data-token='. csrf_token() .' data-toggle="modal" data-target="#mdPerm" data-toggle="tooltip" title="Edit Record"><i class="fa fa-pencil-square"></i></button>
                                <button class="btn btn-sm btn-danger btndelete" data-toggle="tooltip" data-placement="top" title="Delete Record" data-token='. csrf_token() .' data-docid='.$hid.'><i class="fa fa-trash-o"></i></button> 
                            </div>
                        </div>
                        ';
            })
        ->addIndexColumn()
        ->editColumn('name', '{{$name}}')
		->make(true);
    }	
	
	
	
}
