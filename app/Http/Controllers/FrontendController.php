<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Blog;
use App\Category;
use App\Tags;
use App\User;
class FrontendController extends Controller
{

    public function index()
    {
        $header_title="Jack of all trades, master of most";
        $header_sub="Polymath is a person whose expertise spans a significant number of different subject areas";

        $rand = rand();
        $blog = Blog::where('publish','yes')->where('frontpage','yes')->orderBy("order_column")->get();
        $categories = Category::orderBy("name")->get();
        $tags = Tags::orderBy("name")->get();
        $articles = Blog::where('publish','yes')->orderBy("order_column")->get(['id','title','slug','author_id','category_id','tags','publish','frontpage','created_at']);
        //return view('dashboard.home'); 
        return view('frontend.blog.index')->with(compact('blog','categories','tags','articles','rand','header_title','header_sub'));
    }

    public function article($slug)
    {
        $rand = rand();
        $blog = Blog::where('slug',$slug)->where('publish','yes')->orderBy("order_column")->get()->first();

        if(!$blog){
            return view('errors.404'); 
        }

        $categories = Category::orderBy("name")->get();
        $tags = Tags::orderBy("name")->get();
        $articles = Blog::where('publish','yes')->orderBy("order_column")->get(['id','title','slug','author_id','category_id','tags','publish','frontpage','created_at']);

        $header_title=$blog->title;
        $header_sub=$blog->created_at->format('d M Y ')."in <a href='#'>".Category::find($blog->category_id)->name."</a> by ".User::find($blog->author_id)->name;

        return view('frontend.blog.article')
        ->with(compact(
        'blog',
        'categories',
        'tags',
        'articles',
        'rand',
        'header_title',
        'header_sub'));
    }

}
