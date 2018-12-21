   <!-- Header
   ================================================== -->
   <header>

      <div class="row">

         <div class="twelve columns">

            <div class="logo">
               <a href="/"><img src="{{asset('images/logo.png')}}"></a>
            </div>

            <nav id="nav-wrap">

               <a class="mobile-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
	            <a class="mobile-btn" href="#" title="Hide navigation">Hide navigation</a>

               <ul id="nav" class="nav">

                  <li><a href="/">Home</a></li>
                  <li><a href="/page/portfolio">Portfolio</a></li>
	               <li><a href="/article/about-this-site">About</a></li>

               </ul> <!-- end #nav -->

            </nav> <!-- end #nav-wrap -->

         </div>

      </div>

   </header> <!-- Header End -->

   <!-- Page Title
   ================================================== -->
   <div id="page-title">

      <div class="row">

         <div class="ten columns centered text-center">
            <h1>{{$header_title}}<span>.</span></h1>
            <p>{!! $header_sub !!}</p>
         </div>

      </div>

   </div> <!-- Page Title End-->