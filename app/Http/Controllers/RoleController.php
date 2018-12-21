<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests;
//use App\Roles;
use Hashids;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as Roles;

class RoleController extends Controller
{
	use \App\Traits\StatusResponse;   // json status response
    public function __construct()
    {
        $this->middleware('auth');
    }	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view('dashboard.roles');
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
		$name = str_replace(" ", "_", strtolower($request->name));
		
		if(Roles::where('name',$name)->get()->count()){

			return $this->Status("error","Duplicate entry");
		}else{
			$data = new Roles();
			$data->name =  $name;
			$data->description = ucfirst($request->description);
			$data->save();
			return $this->Status("ok","Role successfully save");
		}

        //return redirect($this->route)->with('success',' Record was successfully saved.');
    }

    public function update(Request $request) 
    {
		$input = $request->all();
		
		$id = $request->get('id');
		$i=Hashids::decode($id);
        $role = Roles::findorfail(strval($i[0]));		
		$role->description = trim($request->description);
		$role->update();
		
		$permissions = $request->get("permissions");
		if(!is_array($permissions)){
			$permissions=array();
		}
		$role->syncPermissions($permissions); 
		return redirect()->back()->with('success',' Role was successfully updated.');		
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
    public function edit($id_)
    {
		$id =  strval(Hashids::decode($id_)[0]);
        $data = Roles::findorfail($id);
		$data->hashid=$id_;
		$permission = Permission::all();

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
		->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id');
		//->all();

		return view('dashboard.editrole',compact('data','permission','rolePermissions')); 
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
        $data = Roles::findorfail(strval($i[0]));
		$data->syncPermissions([]); 
        $data->delete();
    }
	
   public function data(){
        $data = Roles::all();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
				$hid=Hashids::encode($data->id);
                return '<div class="text-center">
                            <div class="btn-group">
                                <a href="/dashboard/settings/role/'.$hid.'" class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit Record"><i class="fa fa-pencil-square"></i></a>
                                <button id="btndelete" class="btn btn-sm btn-danger btndelete" data-toggle="tooltip" data-placement="top" title="Delete Record" data-token='. csrf_token() .' data-docid='.$hid.'><i class="fa fa-trash-o"></i></button> 
                            </div>
                        </div>
                        ';
            })
        ->addIndexColumn()
        ->editColumn('name', '<strong>{{ $name }}</strong>')
        ->editColumn('description', '{{ $description }}')
        ->editColumn('permission',function ($data){
						$rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$data->id)
						->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id');
						$perms="";	
						foreach($rolePermissions as $perm){
							$perm_data = Permission::find($perm);
							$perms.='<span class="badge badge-primary badge-roundless">'.$perm_data->name.'</span> ';
						}
						
                        return	$perms;
                        })
		->make(true);
    }
	
	
	
}
