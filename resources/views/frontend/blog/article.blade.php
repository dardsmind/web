@extends('frontend.blog.app')
@section('content')
<!-- Content
   ================================================== -->
   <div class="content-outer">

      <div id="page-content" class="row" style="padding-top:14px !important">

         <div id="primary" class="eight columns">


            <article class="post">
               <div class="entry-header cf">
                  <p class="post-meta">
                     <a href="#"><i class="fa fa-home"></i> Home</a> /
                     <a href="#" title="">{{$blog->title}}.</a> 
                  </p>
                  <hr>
               </div>
               <div class="post-content">
                  {!! $blog->content !!}
               </div>
            </article> <!-- post end -->


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