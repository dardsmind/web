<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Blog;
use App\Category;
use App\User;
use App\Tags;
use Yajra\Datatables\Datatables;
use Hashids;
use File;
use Config;

class BlogController extends Controller
{
    public function index()
    {
        return view('dashboard.blogs');
    }

    public function new_blog()
    {
        $category = Category::all();
        return view('dashboard.blog_new')->with(compact('category'));
    }
 
    public function edit($id_)
    {
        $category = Category::all();        
        $id =  implode("",Hashids::decode($id_));
        $data = Blog::findorfail($id);

        $tag_selected = array();
        foreach(explode(",",$data->tags) as $tag_id){
               $t = Tags::find($tag_id);
               if($t){
               $ta_info = new \stdClass;
               $ta_info->id=$t->id;
               $ta_info->name=$t->name;
               $tag_selected[]=$ta_info;
               }
        }
        $data->tag_selected=$tag_selected;
        return view('dashboard.blog_edit')->with(compact('data','category','id_'));
    }

    public function store(Request $request)
    {
        //$title = str_slug($request->title);
        //$blog = Blog::where('slug',$title)->get();

        $blog = new Blog; 
        $blog->title=$request->title;
        $blog->slug=str_slug($request->title);
        $blog->tags=implode(',', $request->tags);
        $blog->publish=$request->publish;
        $blog->frontpage=$request->frontpage;
        $blog->content=$request->content;
        $blog->author_id=$request->user()->id;
        $blog->category_id=$request->category;
        $blog->save();
        $hid=Hashids::encode($blog->id);
		$data = array(
            'status'=>'ok',
			'message' => 'successfull', 
            'alert-type' => 'success',
            'id'=>$hid,
		);		
		return response()->json($data);	
    }    

    public function reorder(Request $request)
    {
        Blog::setNewOrder($request->order);
		$data = array(
            'status'=>'ok',
			'message' => 'successfull', 
            'alert-type' => 'success',
            'data'=>$request->all(),
		);		
		return response()->json($data);
    }
    public function update(Request $request)
    {
		$id =  Hashids::decode($request->id)[0];
        $blog = Blog::findorfail($id);
        $blog->title=$request->title;
        $blog->slug=str_slug($request->title);
        $blog->tags=implode(',', $request->tags);
        $blog->publish=$request->publish;
        $blog->frontpage=$request->frontpage;
        $blog->content=$request->content;
        $blog->author_id=$request->user()->id;
        $blog->category_id=$request->category;
        $blog->update();

		$data = array(
            'status'=>'ok',
			'message' => 'successfull', 
			'alert-type' => 'success'
		);		
		return response()->json($data);	
    }

    public function data(){ 
        $data = Blog::orderBy("order_column")->get(['order_column','id','title','author_id','category_id','tags','publish','frontpage','created_at']);
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                $hid=Hashids::encode($data->id);
                return '<div class="text-center">
                            <div class="btn-group">
                                <a href="/dashboard/blog/'.$hid.'" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Delete Record" data-token='. csrf_token() .'><i class="fa fa-edit"></i></a> 
                                <button  class="btn btn-sm btn-danger btndelete" data-toggle="tooltip" data-placement="top" title="Delete Record" data-token='. csrf_token() .' data-docid='.$hid.'><i class="fa fa-trash-o"></i></button> 
                            </div>
                        </div>
                        ';
            })
        ->addIndexColumn()
        ->editColumn('title', function($data){
            $hid=Hashids::encode($data->id);
            return '<a href="/dashboard/blog/'.$hid.'" >'.$data->title.'</a>'; 
        })
        ->editColumn('author_id', function($data){
            $user = User::find($data->author_id);
            return $user->name;
        })
        ->editColumn('category_id', function($data){
            $category = Category::find($data->category_id);
            return $category->name;
        })
        ->editColumn('tags', function($data){
            $tag_selected = "";
            foreach(explode(",",$data->tags) as $tag_id){
                   $t = Tags::find($tag_id);
                   if($t){
                        $tag_selected .="<span class='badge badge-default badge-roundless'>".$t->name."</span> ";
                   }
            }
            return $tag_selected;
        })
        ->editColumn('publish', function($data){
            return ($data->publish=="yes")? "<span class='badge badge-success badge-roundless'>yes</span>":"<span class='badge badge-warning badge-roundless'>no</span>";
        })
        ->editColumn('frontpage', function($data){
            return ($data->frontpage=="yes")? "<span class='badge badge-success badge-roundless'>yes</span>":"<span class='badge badge-warning badge-roundless'>no</span>";
        })
        ->editColumn('created_at',function ($data){
                        return  '<div class="text-center">' . $data->created_at->diffForHumans() . '</div>';
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
        $data = Blog::findorfail(strval($i[0]));
        $data->delete();
    }  

    public function titlesearch(Request $request)
    {
        $title = str_slug($request->title);
        $blog = Blog::where('slug',$title)->first(); 
        $exist=false;
        if($blog){
            $exist=true;
        }
		$data = array(
            'status'=>'ok',
			'exist' => $exist, 
		);		
		return response()->json($data);	
    }  

}
