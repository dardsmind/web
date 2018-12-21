<!DOCTYPE html>
<!--[if lt IE 8 ]><html class="no-js ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 8)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- Basic Page Needs
   ================================================== -->
   <meta charset="utf-8">
	<title>Blog | {{ config('app.name', 'Laravel') }}</title>
	<meta name="description" content="">
	<meta name="author" content="">

   <!-- Mobile Specific Metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
    ================================================== -->
   <link rel="stylesheet" href="{{asset('css/default.css?r=$rand')}}">
	<link rel="stylesheet" href='{{asset("css/layout.css?r=$rand")}}'>
   <link rel="stylesheet" href="{{asset('css/media-queries.css')}}">

   <!-- Script
   ================================================== -->
	<script src="{{asset('js/modernizr.js')}}"></script>
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">	

   <!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="{{asset('favicon.ico')}}" > 

   <style>
      pre {
         display: block !important;
         padding: 9.5px !important;
         margin: 0 0 10px !important;
         font-size: 13px;
         line-height: 1.42857;
         word-break: break-all !important;
         word-wrap: break-word !important;
         background-color: #f0f0f0 !important;
         border: 1px solid #ccc !important;
         border-radius: 4px !important;
      }
   </style> 
		@stack('links-head')
		@stack('scripts-head')   
</head>

<body>

   @include("frontend.blog.header")

   @yield('content')


   <!-- footer
   ================================================== -->
   <footer>

      <div class="row">

         <div class="twelve columns">

            <ul class="footer-nav">
					<li><a href="#">Home.</a></li>
              	<li><a href="#">Blog.</a></li>
              	<li><a href="#">Portfolio.</a></li>
              	<li><a href="#">About.</a></li>
              	<li><a href="#">Contact.</a></li>
			   </ul>

            <ul class="footer-social">
               <li><a href="#"><i class="fa fa-facebook"></i></a></li>
               <li><a href="#"><i class="fa fa-twitter"></i></a></li>
               <li><a href="https://github.com/dardsmind"><i class="fa fa-github"></i></a></li>
               <li><a href="https://www.linkedin.com/in/dards/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
            </ul>

            <ul class="copyright">
               <li>Copyright &copy; 2019 MindWorkSoft</li> 
               <li>Website Theme by <a href="http://www.styleshout.com/">Styleshout</a></li>               
            </ul>

         </div>

         <div id="go-top" style="display: block;"><a title="Back to Top" href="#">Go To Top</a></div>

      </div>

   </footer> <!-- Footer End-->

   <!-- Java Script
   ================================================== -->
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script>
   <script type="text/javascript" src="{{asset('js/jquery-migrate-1.2.1.min.js')}}"></script>

   <script src="{{asset('js/jquery.flexslider.js')}}"></script>
   <script src="{{asset('js/doubletaptogo.js')}}"></script>
   <script src="{{asset('js/init.js')}}"></script>
   @stack('scripts-footer')

</body>

</html>