@extends('layouts.app')
@section('content')

<div class="page-content">
	<!-- BEGIN PAGE BAR -->
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="{{ url('/dashboard') }}">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="javascript:;">Route Path </a>
				<i class="fa fa-circle"></i>
			</li>			
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h4 class="page-title">  Routes 
	</h4>
	<!-- END PAGE TITLE-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i>Current Routes</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"> </a>
						<a href="javascript:;" class="reload"> </a>
					</div>
				</div>
				<div class="portlet-body" id="resourcePage">
					<div class="note note-info note-bordered">
						<p>Below are the list of current routes for this API system
						</p>
					</div>
						<form method="post" id="frmRoutes" class="form-horizontal" action="">	
						{{ csrf_field() }}						

					
						<span  class="caption-subject bold uppercase">Tables</span></br>
						<table id="tblDbTables" class="table table-bordered table-condensed table-striped table-hover">
						<thead>
						<tr>
						<th class="col-sm-3" style="text-align:center">HTTP Method</th>
						<th>Route</th>
						<th>Name</th>
						<th>Action</th>
						</tr>
						</thead>
						<tbody>	
						@foreach($routes as $r) 
							<tr>
							<td>{{$r->getMethods()[0]}}</td>
							<td>{{$r->getPath()}}</td>
							<td>{{$r->getName()}}</td>
							<td>{{$r->getActionName()}}</td>
							</tr>
						@endforeach
						</tbody>
						</table><br/>				
						</form>
				</div>
			</div>
			<!-- END PORTLET-->
		</div>
	</div>
	

</div>



<!--------------------- edit  -------------------------->
<div class="modal fade" id="mdTableFields" data-backdrop="static" data-keyboard="false">
  <form method="post" id="frmTableFields" class="form-horizontal" action="">
  <input type="hidden" name="database" value="">
  <input type="hidden" name="table" value="">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Set Fields</h4>
	  </div>
	  <div class="modal-body">
		  {{ csrf_field() }}
		  <div class="form-group">
			<div class="col-sm-12 lstFields">
	
			<table id="tblTableFields" class="table table-bordered table-condensed table-striped table-hover">
			<thead>
			<tr><th class="col-sm-4" style="text-align:center">Set available</th><th>Field name</th></tr>
			</thead>
			<tbody>												
			</tbody>
			</table>	
	
			</div>
		  </div>		  

	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Set Fields</button>
	  </div>
	</form> 
	</div>
  </div>
</div>
@endsection


@push('scripts-footer')
<!-- DataTables -->

<script>
	
$( document ).ready(function() {
$.ajaxSetup({ async :true});
	//reload_tables();

	

	$(document).on('click', '.btnFetch', function(){  
		reload_tables();	  
	});	


	$('#frmTables').on('submit', function(e) {
		e.preventDefault(); 
		App.blockUI({target:"#tblDbTables",animate: true});
		$.ajax({
			type: "POST",
			url: '/dashboard/resource/tables/update',
			data: $(this).serialize(),
			beforeSend: function(){
				
			},
			success: function(dat) {
				reload_tables();
				$("#tblDbTables").unblock();
			}
		});
	});	
		
	$(document).on('click', '.btnOpenTableFields', function(e){ 
		e.preventDefault(); 
	    var table = $(this).data("table");
		var database = $("select[name='database_connection']").val();
		
		$('#mdTableFields').modal('show');
		$('#mdTableFields h4.modal-title').html("Set fields for <b>" + table + "</b>");
		$("#frmTableFields input[name='table']").val(table);
		$("#frmTableFields input[name='database']").val(database);
		reload_table_fields();
	});		
		
		
	$('#frmTableFields').on('submit', function(e) {
		e.preventDefault(); 
		App.blockUI({target:"#mdTableFields",animate: true});
		$.ajax({
			type: "POST",
			url: 'resource/tables/fields',
			data: $(this).serialize(),
			beforeSend: function(){
				
			},
			success: function(dat) {
				$("#mdTableFields").unblock();
				reload_table_fields();
			}
		});
	});			
		
		
	function reload_tables(){
		App.blockUI({target:"#tblDbTables",animate: true});
		
		var database = $("select[name='database_connection']").val();
		$.ajax({  
			url: 'resource/' + database+'/tables',
			type:"GET",
			cache: false,	
			async :true,
			beforeSend: function(){
				
			},			
			success:function(dat){ 
				data = $.parseJSON(dat);
				$("#tblDbTables tbody").empty();
				$.each(data.tables, function(i, v) {
					
					if(v.selected!=""){
						btnset ="<a href='#' class='btn btn-xs btn-info btnOpenTableFields' data-table='"+v.name+"'>Set Fields</a>";
					}else{ btnset =""; };
					td="<tr><td style='text-align:center'><input type='checkbox' name=tables[] value='"+v.name+"' "+v.selected+" ></td><td>"+v.name+"</td><td>"+btnset+"</td></tr>";
					$("#tblDbTables tbody").append(td);
				})
				$("#tblDbTables").unblock();
			}  
		});
	
	}	
	
	function reload_table_fields(){
		var database = $("select[name='database_connection']").val();
		var table = $("#frmTableFields input[name='table']").val();
					
		$.ajax({  
			url: 'resource/tables/fields',
			type:"GET",
			cache: false,	
			async :true,
			traditional: true,			
			data:{
				table:table,
				database:database,
			},			
			beforeSend: function(){
				$("#tblTableFields tbody").empty();			
				App.blockUI({target:"#tblTableFields",animate: true});
			},			
			success:function(dat){ 
				data = $.parseJSON(dat);
				$.each(data.fields, function(i, v) {
					td="<tr><td style='text-align:center'><input type='checkbox' name=fields[] value='"+v.name+"' "+v.selected+" ></td><td>"+v.name+"</td></tr>";
					$("#tblTableFields tbody").append(td);
				})
				$("#tblTableFields").unblock();
			}  
		});
	
	}

	
})
</script>  
@endpush 