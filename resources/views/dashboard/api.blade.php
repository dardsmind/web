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
				<a href="javascript:;">My API </a>
				<i class="fa fa-circle"></i>
			</li>			
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h3 class="page-title">  API
	</h3>
	<!-- END PAGE TITLE-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-body">
				<div class="row">
					<div class="col-md-12"> 
						<form method="post" id="frmRole" class="form-horizontal" action="{{ url('/dashboard/api') }}">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Generate new API Key</button>
						</form>
						
					</div>
				</div>	
				
				<div class="row"><br/>		
				<div class="note note-info note-bordered">
					<p>
					Note: Your account only allowed to generate a maximum of 3 API keys
					</p>
				</div>			
				</div>	
				
              <table id="tblRoles" class="table table-bordered table-striped table-condensed table-hover">
                <thead>
                <tr>
				  <th>#</th>
                  <th>Key</th>
                  <th>Created</th>
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
@endsection


@push('scripts-footer')
<!-- DataTables -->

<script>
$( document ).ready(function() {
	
    // $('#tblRoles').DataTable({
        // processing: false,
		// paging:false,
		// searching:false,
		// info:false,
        // serverSide: false,
	// })		
	
    $('#tblRoles').DataTable({
        processing: false,
		paging:false,
		searching:false,
		info:false,
        serverSide: true,
        ajax: '{!! url('dashboard/api/data') !!}',
        order: [[1, 'desc']],   //start with Zero(0)
        columns: [
			{ data: 'DT_Row_Index', orderable: false, searchable: false},
            { data: 'key', name: 'key' ,"searchable": true},
            { data: 'created_at', name: 'created_at' ,"searchable": false},
            { data: 'action', name: 'action', "orderable":false,"defaultContent": ""}
        ]
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
					var value = {
					   'id':docid,
					   _token:token
					};
					$.ajax({  
						url:'{!! URL::to( 'dashboard/api/delete') !!}', 	
						type:"delete",  
						data: value,  
						success:function(){ 
							$('#tblRoles').DataTable().ajax.reload();
							toastr["success"]("Record was successfully deleted.", "Success")
						}  
					});  						
				  }
				});
	});	
	
	
})
</script>  
@endpush 