<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
		
		
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{asset('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{asset('assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{asset('assets/layouts/layout/css/layout.css?r=3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/layouts/layout/css/themes/grey.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{asset('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}" > 

		@stack('links-head')
		@stack('scripts-head')
		</head>
    <!-- END HEAD -->
	<!--  page-sidebar-closed-hide-logo //put to body tag to hide logo when menu close -->
	<!--  page-sidebar-closed //put to body tag to permanent menu close -->
    <body class="page-header-fixed page-container-bg-solid">
		@include('layouts.top')

		<div class="clearfix"> </div>
	
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
			@include('layouts.menu')
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
				@yield('content')
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2018 &copy; {{ config('app.name', 'Laravel') }}.
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!--[if lt IE 9]>
		<script src="assets/global/plugins/respond.min.js"></script>
		<script src="assets/global/plugins/excanvas.min.js"></script> 
		<![endif]-->
		
		<!-- <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script> -->
		
        <script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>

		<!-- DataTable -->
        <!-- <script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>-->
        <!-- <script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script> -->
		<script src="{{asset('assets/global/plugins/datatables.net/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
        
        <script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
        

        <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>		
		
        <script src="{{asset('assets/pages/scripts/table-datatables-managed.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>

        <!-- <script src="{{asset('assets/global/plugins/sweetalert/sweetalert.min.js')}}" type="text/javascript"></script> -->
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
		
        <script src="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.js')}}" type="text/javascript"></script>
		
        <script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>

		
		@stack('scripts-footer')
    </body>
</html>