@extends('layouts.app')
@section('content')

@push('links-head')
<link href="{{asset('assets/global/plugins/codemirror/lib/codemirror.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/codemirror/theme/neat.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/codemirror/theme/ambiance.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/codemirror/theme/material.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/codemirror/theme/neo.css')}}" rel="stylesheet" type="text/css" />
@endpush 

<div class="page-content">
	<!-- BEGIN PAGE BAR -->
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="{{ url('/dashboard') }}">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="javascript:;">Help </a>
				<i class="fa fa-circle"></i>
			</li>			
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h3 class="page-title">  API documentations 
	</h3>
	<!-- END PAGE TITLE-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-body">
				
				
		<h3>Product Database</h3>
		<div class="panel panel-primary">
			<div class="panel-heading"> getinfo </div>
			<div class="panel-body"> 
				<p>Example URL (GET method): http://api.psindex.com/v1/product/id/getinfo?apikey=YOUR_API_KEY<br/>
				<strong style="color:#ff0000">Params</strong><br/>
				<i style="font-weight:bold">id</i> - (Required) unique id of the product<br/>
				<i style="font-weight:bold">apikey</i> - (Required) api key given by PS Index<br/>
				<span style="color:#ff0000;font-weight:bold">Sample Output (JSON)</span>			
<textarea id="code_editor_1" class="code_editor">

{
    "refcode": "HFLR",
    "brand": null,
    "place_of_origin": "Canada",
    "email_address": "info@fab-form.com",
    "contact_person": "",
    "supplier_address": "Canada",
    "supplier_id": "USR61",
    "csi_ref": "03 11 00 00",
    "photo": "image_PRDIDX00009_file2015-08-31-10-45-33337567.jpg",
    "website": "www.fab-form.com",
    "manufacturer": "Fab-Form Industries Ltd.",
    "supplier": "Fab-Form Industries Ltd.",
    "short_description": "Fastfoot is a fabric concrete footing form system for linear foundations. ",
    "description": "Fastfoot is a fabric concrete footing form system for linear foundations. ",
    "brandmodel": "Fastfoot, Fastbag, and Fast-Tube Fabric Forms",
    "uid": "PRDIDX00009",
    "rating_code": {
        "Al Safat": [
            "701.07",
            "701.02"
        ],
        "D.G.B.R": [
            "701.07",
            "701.02"
        ],
        "Estidama PBRS": [
            "SM-9(i)",
            "SM-9(ii)",
            "SM-12(i)",
            "SM-12(ii)"
        ],
        "LEED 3": [
            "MRc5",
            "MRc7"
        ],
        "LEED 4": [
            "MRc1(iv)",
            "MRc2(i)",
            "MRc3(i)",
            "MRc4(i)",
            "MRc5(i)",
            "MRc2(ii)",
            "MRc3(ii)",
            "MRc4(ii)",
            "MRc5(ii)",
            "MRc4(iii)"
        ]
    },
    "csi": {
        "product_material": "Concrete Forming",
        "group_category": "Concrete"
    }
}

			
</textarea>				
			</div>
		</div>
				

		<div class="panel panel-primary">
			<div class="panel-heading"> search </div>
			<div class="panel-body"> 
				<p>Example URL (GET method): http://api.psindex.com/v1/product/search?apikey=YOUR_API_KEY&q=KEYWORD<br/>
				<strong style="color:#ff0000">Params</strong><br/>
				<i style="font-weight:bold">q</i> - (Required) keyword to search<br/>
				<i style="font-weight:bold">apikey</i> - (Required) api key given by PS Index<br/>
				<span style="color:#ff0000;font-weight:bold">Sample Output (JSON)</span>			
<textarea id="code_editor_1" class="code_editor">
[
    {
        "uid": "PRDIDX00466",
        "brandmodel": "Croma 100 1jet Showerpipe with single lever mixer",
        "supplier": "Hansgrohe Middle East",
        "csi_ref": "22 41 23 00"
    },
    {
        "uid": "PRDIDX00491",
        "brandmodel": "Exeed Pipe Wrap Insulation (ExPWI)",
        "supplier": "Exeed Glasswool LLC",
        "csi_ref": "23 07 19 00"
    },
    {
        "uid": "PRDIDX00492",
        "brandmodel": "Exeed Sectional Pipe Insulation (ExSPI)",
        "supplier": "Exeed Glasswool LLC",
        "csi_ref": "23 07 19 00"
    },
]	
			
</textarea>				
			</div>
		</div>				
				
				
				
				
				
				
				
				
				
				
				
				
				

				</div>
			</div>
			<!-- END PORTLET-->
		</div>
	</div>
</div>
@endsection


@push('scripts-footer')
<script src="{{asset('assets/global/plugins/codemirror/lib/codemirror.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/codemirror/mode/javascript/javascript.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/codemirror/mode/htmlmixed/htmlmixed.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/codemirror/mode/css/css.js')}}" type="text/javascript"></script>
<script>
$( document ).ready(function() {
	
		$('.code_editor').each(function(index, elem){
			var myCodeMirror = CodeMirror.fromTextArea(elem, {
				lineNumbers: false,
				matchBrackets: true,
				styleActiveLine: true,
				theme:"neat",
				mode: 'application/json',
				readOnly: true
			});
		});	
  
})
</script>  
@endpush 