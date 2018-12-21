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
				<a href="javascript:;">Tag list</a>
				<i class="fa fa-circle"></i>
			</li>
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h3 class="page-title"> Blog tags
	</h3>
	<!-- END PAGE TITLE-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<span class="caption-subject bold uppercase"> Tags</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
						<a href="javascript:;" class="reload" id="reload_data" data-original-title="" title=""> </a>
					</div>
				 </div>
				<div class="portlet-body">
				
				<div class="row">
					<div class="col-md-12">
						<button type="button" class="btn green" data-toggle="modal" data-target="#mdRole"><i class="fa fa-plus"></i> New</button>
					</div>
				</div>		
			  <br/>
              <table id="tblRoles" class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                <tr>
				  <th>#</th>
                  <th>Name</th>
                  <th>Date Created</th>
                  <th>Date Updated</th>
                  <th class="col-md-2">&nbsp;</th>
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




<!--------------------- new role -------------------------->
<div class="modal fade" id="mdRole" data-backdrop="static" data-keyboard="false">
  <form method="post" id="frmCategory" class="form-horizontal" action="{{ route('dashboard.category.save') }}">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Enter new Tag</h4>
	  </div>
	  <div class="modal-body">
		  {{ csrf_field() }}
		<div class="note note-info note-bordered">
			<p>
			Note: Tag name has to be one word only otherwise you may put a under score character in case of compound words. example: information_technology
			</p>
		</div>		  
		  <div class="form-group has-feedback form-group">
			<label for="name" class="col-sm-2 control-label">Tag</label>
			<div class="col-sm-10">
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

<!--------------------- edit role -------------------------->
<div class="modal fade" id="mdEditRole" data-backdrop="static" data-keyboard="false">
  <form method="post" id="frmEditRole" class="form-horizontal" action="">
  <input type="hidden" name="id" value="">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Edit Category</h4>
	  </div>
	  <div class="modal-body">
		  {{ csrf_field() }}
		  <div class="form-group has-feedback">
			<label for="name" class="col-sm-2 control-label">Name</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" name="name" value="" required>
			</div>	
		  </div>

	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		<button type="submit" class="btn btn-primary">Update</button>
	  </div>
	</form> 
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection


@push('scripts-footer')
<script>
$( document ).ready(function() {
	
    $('#tblRoles').DataTable({
        processing: false,
		paging:true,
		searching:true,
		info:false,
        serverSide: true,
        ajax: "{{ route('dashboard.tags.data') }}",
        order: [[3, 'desc']],   //start with Zero(0)
        columns: [
			{ data: 'DT_Row_Index', orderable: false, searchable: false},
            { data: 'name', name: 'name' ,"searchable": true},
            { data: 'created_at', name: 'created_at' ,"searchable": false},
            { data: 'updated_at', name: 'updated_at' ,"searchable": false },
            { data: 'action', name: 'action', "orderable":false,"defaultContent": ""}
        ]
    });	
	
	$('#frmCategory').on('submit', function(e) {
		e.preventDefault(); 
		$.ajax({
			type: "POST",
			url: "{{ route('dashboard.tags.save')}}",
			data: $(this).serialize(),
			beforesend: function(){
				$('#mdRole').modal('hide');
			},
			success: function(dat) {
				//json = $.parseJSON(dat);
				if(dat.status=="ok"){
					$('#tblRoles').DataTable().ajax.reload();
					$('#frmCategory').trigger('reset');
					
					$("#frmCategory input[name='name']")
					.closest(".form-group").removeClass("has-error")
					.next("span.help-block").remove();
					
				}else{ 
					toastr["error"](dat.message, "Error")
					$("#frmCategory input[name='name']")
					.after("<span class='help-block'><i class='fa fa-warning'></i> "+dat.message+"</span>")
					.closest(".form-group").addClass("has-error");
				}
			}
		});
	});	
	
	
	$('#frmEditRole').on('submit', function(e) {
		e.preventDefault(); 
		$.ajax({
			type: "POST",
			url: '/dashboard/settings/role/update',
			data: $(this).serialize(),
			beforesend: function(){
				$('#mdEditRole').modal('hide');
			},
			success: function(msg) {
				$('#tblRoles').DataTable().ajax.reload();
				
			}
		});
	});	
	
	$(document).on('click', '#reload_data', function(){ 
		$('#tblRoles').DataTable().ajax.reload();
	});	

	
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
						url:'{!! route('dashboard.tags.delete') !!}', 		
						type:"delete",  
						data: value,  
						success:function(){ 
							$('#tblRoles').DataTable().ajax.reload();
							toastr["success"]("Record was successfully deleted.", "Success")
						}  
					});  						
				  } else {
					swal("Delete cancelled");
				  }
				});
			//function(){   
			 //};
	});	
	
	
	$(document).on('click', '.btnedit', function(){  
		var token = $(this).data("token");
		var docid = $(this).data("docid");
		$.ajax({
			type: "GET",
			url: '/dashboard/settings/role/'+docid,
			data: $(this).serialize(),
			beforesend: function(){
				//$('#mdPerm').modal('hide');
				//$("#frmPerm input[name='name']").val(""); 
			},
			success: function(dat) {
				json = $.parseJSON(dat);
				$('#frmEditRole').trigger('reset');
				$("#frmEditRole input[name='name']").val(json.name);
				$("#frmEditRole input[name='description']").val(json.description);
				
				$("#frmEditRole input[name='id']").val(docid);
			}
		});		
		
	})	
	
	
})
</script>  
@endpush 