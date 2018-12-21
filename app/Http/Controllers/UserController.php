<?php

namespace App\Http\Controllers;

//use App\Http\Requests\StoreUser as ValidateRequest;
//use App\Http\Requests\StoreUserPassword as ValidateRequestPass;
use App\User as Cls;
use App\Roles;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use Hashids;
//use Image;
use File;
use Config;

use Intervention\Image\Facades\Image as Image;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
	use \App\Traits\StatusResponse;   // json status response
	
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function newuser()
    {
        return view('dashboard.newuser');
    }
    public function create()
    {
        $user = new Cls; 
        return view('dashboard.newuser')->with(compact('user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'email' => 'required|email|unique:users',
           'name' => 'required|string|max:50',
           'password' => 'required|min:6'
       ]);
		if ($validator->fails()) {
            //Session::flash('error', $validator->messages()->first());
			//Session::flash('error', $validator->messages()->all());
            return redirect()->back()->withInput()->withErrors($validator);
       }    
        $request->merge(['password' => bcrypt($request->password)]);
		//$request->merge(['uid'=>"u".bcrypt($request->email)]);
        $user = Cls::create($request->all()); 
        return redirect('/dashboard/users'); 
    }	
    public function delete(Request $request)
    {
		$id = $request->get('id');
		$i=Hashids::decode($id);
        $data = Cls::findorfail(strval($i[0]));
		$ids=strval($i[0]);
		if ($data->avatar!="") { 
			$tempfile = 'upload/avatars/' . $data->avatar;
			if (File::exists($tempfile)) {
				unlink($tempfile);
			}
		}		
        $data->delete();
		$data->syncRoles([]); // remove all roles for this user
		//$data->role()->whereIn('id', $ids)->delete();
		
    }
    public function edit($id_)
    {
		$id =  Hashids::decode($id_)[0];
        $data = Cls::findorfail(strval($id));
		$data->hashid=$id_;
        
        $avatar_path = "/upload/avatars/default_profile.jpg";
        $ppath = public_path("media/avatar/".$data->avatar);
        if((trim($data->avatar)!="")&&(File::exists($ppath))){
            $avatar_path = "/media/avatar/".$data->avatar;
        }
        $data->profile_pic = $avatar_path;

		// // list of all roles
        $userRole = $data->roles->pluck('name')->toArray();	
		$CurrentUserRole = auth()->user()->roles->pluck('name')->toArray();	
		if(in_array(Config::get('app.admin_level.1'),$CurrentUserRole)){
			$roles = Roles::all(); // list of all roles
		}else{
			$roles = Roles::where('name','<>',Config::get('app.admin_level.1'))->get();			
		}
		$permissions = $data->getPermissionsViaRoles()->pluck('name','name')->toArray();
		return view('dashboard.edituser',compact('data','roles','userRole','permissions'));
    }	

    public function profile($id_)
    {
		$id =  Hashids::decode($id_)[0];
        $data = Cls::findorfail(strval($id));
		$data->hashid=$id_;
		$avatar_path = Cls::ProfilePic($data->avatar);
		if(trim($data->avatar)!=""){
			$avatar_path ="/media/avatar/".$data->avatar;
		}		
		$data->profile_pic = $avatar_path;
		// // list of all roles
        $userRole = $data->roles->pluck('name')->toArray();	
		$CurrentUserRole = auth()->user()->roles->pluck('name')->toArray();	
		if(in_array(Config::get('app.admin_level.1'),$CurrentUserRole)){
			$roles = Roles::all(); // list of all roles
		}else{
			$roles = Roles::where('name','<>',Config::get('app.admin_level.1'))->get();			
		}
		$permissions = $data->getPermissionsViaRoles()->pluck('name','name')->toArray();
		return view('dashboard.profile',compact('data','roles','userRole','permissions'));
    }	
	
	
	
    public function set_role(Request $request, $id_)
    {
		//$user = $request->user()->name;
		$id =  Hashids::decode($id_)[0];
        $user = Cls::findorfail(strval($id));		
		$input = $request->except(['_token']);
		// All current roles will be removed from the user and replace by the array given
		$user->syncRoles($input);		
		return $this->Status("ok","Configuration successfully updated");		
	}	
	
	
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:50'
       ]);
		if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
       }		
        //$profile = $request['profile'];
        $input = $request->except(['password','id']);
        //$input['published'] = ($request['published'] == "on") ? true : false;

        $id = Hashids::decode($id)[0];
        $user = Cls::findorfail($id);
        $user->update($input);

		//$user->assignRole('Guest', 'Super Admin');

        //DB::table('role_user')->where('user_id',$id)->delete();
        //foreach ($request->input('roles') as $key => $value) {
        //    $user->attachRole($value);
        //}
        return back()->with('success',' Record was successfully updated.');    
    }	
	
	
    public function users()
    {
        return view('dashboard.users');
    }	
	
	public function data(){
		$data = Cls::orderBy("name");
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
				$hid=Hashids::encode($data->id);
                return '<div class="text-center">
                        <div class="btn-group">
                        <a href="/dashboard/user/'.$hid.'" class="btn btn-sm btn-warning btnedit" data-toggle="tooltip" data-placement="top" title="Edit Record" data-token='. csrf_token() .' data-docid='.$hid.'><i class="fa fa-pencil-square"></i></a>
                        <button class="btn btn-sm btn-danger btndelete" data-toggle="tooltip" data-placement="top" title="Delete Record" data-token='. csrf_token() .' data-docid='.$hid.'><i class="fa fa-trash-o"></i></button> 
                        </div>
                        </div>
                        ';
            })
			->addIndexColumn()
            ->editColumn('fullname', function ($data) { 
				$hid=Hashids::encode($data->id);
				
				$avatar_path = "/upload/avatars/default_profile.jpg";
				$ppath = public_path("media/avatar/".$data->avatar);
				if((trim($data->avatar)!="")&&(File::exists($ppath))){
					$avatar_path = "/media/avatar/".$data->avatar;
				}
				//if(trim($data->avatar)!=""){
					//$avatar_path ="http://images.dmspi.com/avatar/".$data->avatar;
					//$avatar_path = "/upload/avatars/".$data->avatar;
				//}
				
                return '<img class="img-responsive" align="left" src="'.$avatar_path.'" style="height:30px;width:30px">				
						&nbsp;<a href="/dashboard/user/'.$hid.'">'.$data->name.'</a>
                        ';			
			})
			->editColumn('uid', '{{ $uid }}')
			->editColumn('role',function ($data){
						$userRole = $data->roles->pluck('name')->toArray();		
						//$role=Roles::where('alias', '=', $data->role)->firstOrFail();
						
							$roles="";	
							foreach($userRole as $r){
								//$perm_data = Roles::find($r);
								$roles.='<span class="badge badge-primary badge-roundless">'.$r.'</span> ';
							}
							return	$roles;
                        })	
			->editColumn('status',function ($data){
						$status='<span class="badge badge-success badge-roundless">active</span>';
						switch($data->status){
							case "approve":
							break;
							case "pending":
								$status='<span class="badge badge-warning badge-roundless">pending</span>';
							break;
							case "block":
								$status='<span class="badge badge-danger badge-roundless">blocked</span>';
							break;
						}
                        return	$status;
                        })						
            ->make(true);		
	}
	
	
    public function avatar(Request $request, $id){
        $file = array('avatar' => $request->avatar);
        $rules = array('avatar'=>'mimes:jpeg,jpg,png|max:3000|required',); 
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->with('error', "Upload file is not valid, please check the file size.");
        }
        $id = Hashids::decode($id)[0];
        try {
            if($request->hasfile('avatar')){
                $img = $request->file('avatar');
                $filename = $id . '-avatar-' .  time() . '.' . $img->getClientOriginalExtension();
                $input['avatar'] = $filename;
				
				$old = Cls::findorfail($id);
				if (($old->avatar !== 'default.png')&&($old->avatar!="")) { 
					if (Storage::disk(Config::get('filesystems.default'))->exists("public/media/avatar/".$old->avatar)) {
						Storage::disk(Config::get('filesystems.default'))->delete("public/media/avatar/".$old->avatar);
					}
				}				
				Storage::disk(Config::get('filesystems.default'))->put("public/media/avatar/".$filename, fopen($img, 'r+'));

				
                // $path = public_path('upload/avatars/' . $filename);
                // Image::make($img)->resize(150,150)->save($path);
                //$input['avatar'] = $filename;
                // $old = Cls::findorfail($id);
                // if (($old->avatar !== 'default.png')&&($old->avatar!="")) { 
                    // $tempfile = 'upload/avatars/' . $old->avatar;
                    // if (File::exists($tempfile)) {
                        // unlink($tempfile);
                    // }
                // }
				
				
                $user = Cls::findorfail($id);
                $result = $user->update($input);    
                return redirect()->back()->with('success',' Avatar was successfully updated.');
            }
        } catch (Exception $e) {
            return Redirect::back()->with('error', "Upload File is not valid");
        }


    }	
	
	
}
