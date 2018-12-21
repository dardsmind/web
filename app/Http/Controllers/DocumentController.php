<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use File;
use Hashids;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\Document as Document;
use Config;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.documents');		
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $file = array('file' => $request->file);
        $rules = array('file'=>'mimes:jpeg,jpg,png,pdf|max:5000|required',); 
        
        $mime_type = $request->file->getMimeType();
        $mime = str_replace("/","_",$mime_type);

        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->with('error', "Upload file is not valid, please check the file size.");
        }
		
        try {
            if($request->hasfile('file')){
                $img = $request->file('file');
                $filename = $mime.'-' .  time() . '.' . $img->getClientOriginalExtension();
					// if (Storage::disk('ftp')->exists("avatar/".$old->avatar)) {
						// Storage::disk('ftp')->delete("avatar/".$old->avatar);
                    // } 
                $fpath ="public/media/".$filename; 
                Storage::disk(Config::get('filesystems.default'))
                ->put($fpath, fopen($img, 'r+'));
				//------------- AWS S3 Storage -----------------
				//$t = Storage::disk('s3')->put($filename, file_get_contents($img), 'public');
				//$imageName = Storage::disk('s3')->url($filename);				
				
				$data = new Document();
				$data->file_name =  $filename;
                $data->doc_name = $filename;
                $data->mime_type = $mime_type;
				$data->save();
		
                //return redirect()->back()->with('success',' file was successfully updated.');
				return "www.mindworksoft.com/media/".$filename;
            }
        } catch (Exception $e) {
            //return Redirect::back()->with('error', "Upload File is not valid");
			return "Upload failed...";
        }
    }


   
	
   public function data(){
        
        $data = Document::all();
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
        ->editColumn('fpath', function ($data){
            $domain = $_SERVER['HTTP_HOST'];
            $fullpath = "http://".$domain."/media/".$data->file_name;

            return "<div style='width:200px'><img style='width:100%' src='".$fullpath."'></div>";
        })
        ->editColumn('mime_type', '{{ $mime_type }}')
        ->editColumn('created_at',function ($data){
                        return  '<div class="text-center">' . $data->created_at->diffForHumans() . '</div>';
                        })						
        ->setRowId('id')
		->setRowClass(function ($data) {
			 return 'odd';
		})
		->make(true);
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
        $data = Document::findorfail(strval($i[0]));
		if (Storage::disk(Config::get('filesystems.default'))->exists("public/media/".$data->doc_name)) {
			Storage::disk(Config::get('filesystems.default'))->delete("public/media/".$data->doc_name);
		}		
        $data->delete();
    }
}
