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
				<a href="{{ url('dashboard/settings/roles') }}">Role List</a> 
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="javascript:;">Edit Role</a>
				<i class="fa fa-circle"></i>
			</li>			
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h3 class="page-title">  Edit Role
	</h3>
	<!-- END PAGE TITLE-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<span class="caption-subject"> Role and Permissions</span>
					</div>
					<div class="tools">
					</div>
				 </div>
				<div class="portlet-body">
				
					<form method="post" class="form-horizontal" action="{{ url('/dashboard/settings/role/update') }}">
					  {{ csrf_field() }}
					  <input type="hidden" name="id" value="{{$data->hashid}}">
					  <div class="form-group has-feedback form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
						<span class="bold uppercase">{{ $data->name }}</span>
						</div>	
					  </div>
					  <div class="form-group has-feedback form-group{{ $errors->has('description') ? ' has-error' : '' }}">
						<label for="name" class="col-sm-2 control-label">Description</label>
						<div class="col-sm-10">
						<input type="text" class="form-control" name="description" id="description" value="{{ $data->description }}" required autofocus>
							@if ($errors->has('description'))
								<span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
							@endif		
						</div>	
					  </div>	
					  <div class="form-group has-feedback form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label for="name" class="col-sm-2 control-label">Choose permissions</label>
						<div class="col-sm-10">
						
							<table class="table table-bordered table-condensed table-striped table-hover">
							<thead>
							<tr><th class="col-sm-1">&nbsp;</th><th>&nbsp;</th></tr>
							</thead>
							<tbody>												
								@foreach($permission as $perm) 
								<tr><td><input type="checkbox" @if(in_array($perm->id,$rolePermissions)) checked @endif  name="permissions[]" value="{{$perm->name}}"></td><td>{{$perm->name}}</td></tr>
								@endforeach										
							</tbody>
							</table>
						</div>	
					  </div>					  
					  <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						  <button type="submit" class="btn btn-success">Update</button>
						</div>
					  </div>					  
					</form>	

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
	
    // $('#tblUserList').DataTable({
        // processing: true,
        // serverSide: true,
        // ajax: '{!! url('dashboard/users/data') !!}',
        // order: [[3, 'desc']],   //start with Zero(0)
        // columns: [
			// { data: 'DT_Row_Index', orderable: false, searchable: false},
            // { data: 'fullname', name: 'name' ,"searchable": true},
            // { data: 'email', name: 'email' ,"searchable": true},
            // { data: 'created_at', name: 'created_at' ,"searchable": true },
            // { data: 'updated_at', name: 'updated_at' ,"searchable": true },
			// { data: 'status', name: 'status' ,"searchable": false },
            // { data: 'action', name: 'action', "orderable":false,"defaultContent": ""}
        // ]
    // });	
      // $(document).on('click', '.btndelete', function(){  
		    // var token = $(this).data("token");
		    // var docid = $(this).data("docid");
			// swal({
			  // title: "Are you sure?",
			  // text: "Once deleted, you will not be able to recover this data!",
			  // icon: "warning",
			  // buttons: true,
			  // dangerMode: true,
			// })
			// .then((willDelete) => {
			  // if (willDelete) {

				// var value = {
				   // 'id':docid,
				   // _token:token
				// };
				// $.ajax({  
					// url:'{!! URL::to( 'dashboard/users/delete') !!}', 			//URL::to('/category/delete')
					// type:"delete",  
					// data: value,  
					// success:function(){ 
						// $('#tblUserList').DataTable().ajax.reload();
						// toastr["success"]("Record was successfully deleted.", "Success")
					// }  
				// });			  
			  // } 
			// });			
			

	    // });	
})
</script>  
@endpush 