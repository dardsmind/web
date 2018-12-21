@extends('frontend.blog.app')
@section('content')
<!-- Content
   ================================================== -->
   <div class="content-outer">

      <div id="page-content" class="row">

         <div id="primary" class="eight columns">


            @foreach($blog as $article)
            <article class="post">
               <div class="entry-header cf">
                  <!-- <h1><a href="article/{{$article->slug}}" title="">{{$article->title}}.</a></h1> -->
                  <h1><a href="#" title="">{{$article->title}}.</a></h1>
                  <p class="post-meta">
                     <time class="date" datetime="{{ $article->created_at}}">{{ $article->created_at->format('d M Y ')}}</time>
                     /
                     <span class="categories">
                     in <a href="#">{{App\Category::find($article->category_id)->name}}</a> /
                     by - {{App\User::find($article->author_id)->name}}
                     </span>
                  </p>
               </div>
               <div class="post-content">
                  {!! $article->content !!}
               </div>
            </article> <!-- post end -->
            @endforeach

            <!-- Pagination 
            <nav class="col full pagination">
  			      <ul>
                  <li><span class="page-numbers prev inactive">Prev</span></li>
  				      <li><span class="page-numbers current">1</span></li>
  				      <li><a href="#" class="page-numbers">2</a></li>
                  <li><a href="#" class="page-numbers">3</a></li>
                  <li><a href="#" class="page-numbers">4</a></li>
                  <li><a href="#" class="page-numbers">5</a></li>
  				      <li><a href="#" class="page-numbers next">Next</a></li>
  			      </ul>
  		      </nav> -->

         </div> <!-- Primary End-->

        @include("frontend.blog.sidebar")

      </div>

   </div> <!-- Content End-->
   @endsection