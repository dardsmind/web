<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Blog;
use App\Category;
use Yajra\Datatables\Datatables;
use Hashids;
use File;
use Config;

class CategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.category');
    }
    public function category_save()
    {
        return view('dashboard.category');
    }   
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->save();
		$data = array(
            'status'=>'ok',
			'message' => 'successfull', 
			'alert-type' => 'success'
		);		
		return response()->json($data);	
    }

    public function data(){
        $data = Category::all();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
				$hid=Hashids::encode($data->id);
                return '<div class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-primary btnEdit" data-toggle="tooltip" data-placement="top" title="Edit Record" data-token='. csrf_token() .' data-docid='.$hid.'><i class="fa fa-edit"></i></button> 
                                <button class="btn btn-sm btn-danger btndelete" data-toggle="tooltip" data-placement="top" title="Delete Record" data-token='. csrf_token() .' data-docid='.$hid.'><i class="fa fa-trash-o"></i></button> 
                            </div>
                        </div>
                        ';
            })
        ->addIndexColumn()
        ->editColumn('name', '{{$name}}')
        ->editColumn('created_at',function ($data){
                        return  '<div class="text-center">' . $data->created_at->diffForHumans() . '</div>';
                        })
        ->editColumn('updated_at',function ($data){
            return  '<div class="text-center">' . $data->updated_at->diffForHumans() . '</div>';
            })                        						
        ->setRowId('id')
		->setRowClass(function ($data) {
			 return 'odd';
		})
		->make(true);
    } 
    
    public function destroy(Request $request)
    {
		$id = $request->get('id');
		$i=Hashids::decode($id);
        $data = Category::findorfail(strval($i[0]));
        $data->delete();
    }     
    
}
