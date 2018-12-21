@extends('layouts.app')
@section('content')
<div class="page-content">
	<!-- BEGIN PAGE HEADER-->
	<!-- BEGIN PAGE BAR -->
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="{{ url('/dashboard') }}">Home</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="javascript:;">Settings</a>
				<i class="fa fa-circle"></i>
			</li>			
			<li>
				<a href="javascript:;">Access Permissions</a>
				<i class="fa fa-circle"></i>
			</li>	
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h3 class="page-title"> Permissions Setup</h3>
	<!-- END PAGE TITLE-->
	<div class="row">

		<div class="col-md-8">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<span class="caption-subject bold uppercase"> Permission</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
						<a href="javascript:;" class="reload" id="reload_data" data-original-title="" title=""> </a>
					</div>
				 </div>
				<div class="portlet-body">
				
				<div class="row">
					<div class="col-md-12">
						<button type="button" class="btn green btnnewperm" data-toggle="modal" data-target="#mdPerm"><i class="fa fa-plus"></i> New Permission</button>
					</div>
				</div>		
			  <br/>
			
				
              <table id="tblPermissions" class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                <tr>
				  <th class="col-md-1">#</th>
                  <th>Permissions</th>
                  <th class="col-md-3">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                </tfoot>
              </table>					
				
				</div>
			</div>
			<!-- END PORTLET-->
		</div>	
	
	</div>
</div>


<!--------------------- new permission -------------------------->
<div class="modal fade" id="mdPerm" data-backdrop="static" data-keyboard="false">
  <form method="post" id="frmPerm" class="form-horizontal" action="{{ url('/dashboard/settings/permission') }}">
  <input type="hidden" name="mode" value="new">
  <input type="hidden" name="id" value="">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Enter new permission name</h4>
	  </div>
	  <div class="modal-body">
		  {{ csrf_field() }}
		<div class="note note-info note-bordered">
			<p>
			Note: Permission name has to be one word only otherwise you may put a under score character in case of compound words. example: upload_documents
			</p>
		</div>		  
		  <div class="form-group has-feedback">
			<label for="name" class="col-sm-4 control-label">Permission name</label>
			<div class="col-sm-8">
			<input type="text" class="form-control" name="name" id="name"  value="" required autofocus>
			</div>	
		  </div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Submit</button>
	  </div>
	</form> 
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection


@push('scripts-footer')
<!-- DataTables -->
<script>
$( document ).ready(function() {
	
    $('#tblPermissions').DataTable({
        processing: false,
		paging:false,
		searching:false,
		info:false,
        serverSide: true,
        ajax: '{!! url('dashboard/settings/permission/data') !!}',
        order: [[1, 'asc']],   //start with Zero(0)
        columns: [
			{ data: 'DT_Row_Index', orderable: false, searchable: false},
            { data: 'name', name: 'name' ,"searchable": true},
            { data: 'action', name: 'action', "orderable":false,"defaultContent": ""}
        ]
    });
	
	
	$('#frmPerm').on('submit', function(e) {
		e.preventDefault(); 
		$.ajax({
			type: "POST",
			url: '/dashboard/settings/permission',
			data: $(this).serialize(),
			beforesend: function(){
				$('#mdPerm').modal('hide');
			},
			success: function(dat) {
				json = $.parseJSON(dat);
				if(json.status=="ok"){
					$('#tblPermissions').DataTable().ajax.reload();
					$('#frmPerm').trigger('reset');
					$('#mdPerm').modal('hide');
					toastr["success"]("Record was successfully saved.", "Success")
				}else{
					toastr["error"](json.message, "Error")
				}
			}
		});
	});	
	
	$(document).on('click', '#reload_data', function(){ 
		$('#tblPermissions').DataTable().ajax.reload();
	});		
	
	$(document).on('click', '.btnnewperm', function(){
		$("#frmPerm input[name='mode']").val("new");
	})
	
	$(document).on('click', '.btnedit', function(){  
		var token = $(this).data("token");
		var docid = $(this).data("docid");
		$.ajax({
			type: "GET",
			url: '/dashboard/settings/permission/'+docid,
			data: $(this).serialize(),
			beforesend: function(){
				//$('#mdPerm').modal('hide');
				$("#frmPerm input[name='name']").val(""); 
			},
			success: function(dat) {
				json = $.parseJSON(dat);
				$('#frmPerm').trigger('reset');
				$("#frmPerm input[name='name']").val(json.data);
				$("#frmPerm input[name='mode']").val("update");
				$("#frmPerm input[name='id']").val(docid);
				//$('#mdPerm').modal('hide');
			}
		});		
		
	})		
	
	$(document).on('click', '.btndelete', function(){  
		var token = $(this).data("token");
		var docid = $(this).data("docid");
		swal({ title: "Are you sure?",   
				text: "You will not be able to recover this record!",   
				type: "warning",
				buttons: true})
				.then((willDelete) => {
				  if (willDelete) {
					//swal("Poof! Your imaginary file has been deleted!", {
					//  icon: "success",
					//});
					var value = {
					   'id':docid,
					   _token:token
					};
					$.ajax({  
						url:'{!! URL::to( 'dashboard/settings/permission/delete') !!}', 			
						type:"delete",  
						data: value,  
						success:function(){ 
							$('#tblPermissions').DataTable().ajax.reload();
							toastr["success"]("Record was successfully deleted.", "Success")
						}  
					});  						
				  }
				});

	});		
	
	
})
</script>  
@endpush 

