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
				<a href="javascript:;">User Accounts</a>
				<i class="fa fa-circle"></i>
			</li>			
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h3 class="page-title">  User Accounts 
	</h3>
	<!-- END PAGE TITLE-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<span class="caption-subject bold uppercase"> User List</span>
					</div>
					<div class="tools">
					</div>
				 </div>
				<div class="portlet-body">
				
				<div class="row">
					<div class="col-md-12">
						<a href="{!! url('dashboard/user/new') !!}" class="btn green"><i class="fa fa-plus"></i> New User</a>
					</div>
				</div>		
				<br/>
				  <table id="tblUserList" class="table table-bordered table-condensed table-striped table-hover">
					<thead>
					<tr>
					  <th>#</th>
					  <th class="col-md-3">Fullname</th>
					  <th>Account ID</th>
					  <th>Roles</th>
					  <th>Status</th>
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
	
    $('#tblUserList').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url('dashboard/users/data') !!}',
        order: [[1, 'asc']],   //start with Zero(0)
        columns: [
			{ data: 'DT_Row_Index', orderable: false, searchable: false},
            { data: 'fullname', name: 'name' ,"searchable": true},
			{ data: 'uid', name: 'uid' ,"searchable": true},
            { data: 'role', name: 'role' ,"searchable": true },
			{ data: 'status', name: 'status' ,"searchable": false },
            { data: 'action', name: 'action', "orderable":false,"defaultContent": ""}
        ]
    });	
      $(document).on('click', '.btndelete', function(){  
		    var token = $(this).data("token");
		    var docid = $(this).data("docid");
			
			
			swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover this data!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {

				var value = {
				   'id':docid,
				   _token:token
				};
				$.ajax({  
					url:'{!! URL::to( 'dashboard/users/delete') !!}', 			//URL::to('/category/delete')
					type:"delete",  
					data: value,  
					success:function(){ 
						$('#tblUserList').DataTable().ajax.reload();
						toastr["success"]("Record was successfully deleted.", "Success")
					}  
				});			  
			  } 
			});			
			

	    });	
})
</script>  
@endpush 