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
				<a href="{{ url('/dashboard/users') }}">User list</a>
				<i class="fa fa-circle"></i>
			</li>			
			<li>
				<a href="javascript:;">Edit user</a>
				<i class="fa fa-circle"></i>
			</li>	
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h3 class="page-title"> User Profile </h3>
	<!-- END PAGE TITLE-->
				
				 <div class="row">
					<div class="col-md-4">	
					
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption font-dark">
									<i class="fa fa-user font-dark"></i>
									<span class="caption-subject bold uppercase"> Avatar</span>
								</div>
								<div class="tools">
								</div>
							 </div>
							<div class="portlet-body">
								<div class="row">
										<div class="box-body box-profile">
										  <center><img id="uploadPreview" class="profile-user-img img-responsive img-circle" src="{{$data->profile_pic}}" alt="User profile picture" style="height:160px;width:160px"></center>
										  <h3 class="profile-username text-center">{{ $data->name }}</h3>
										  <p class="text-muted text-center">{{ $data->designation }}</p>
											<form  method="POST" action="{{ route( 'user.avatar',$data->hashid) }}" class="form-horizontal" enctype="multipart/form-data">
												{{ csrf_field() }}
												<input  class="hidden btn btn-success btn-round" type="file"  id="uploadImage" name="avatar" accept="image/*" onchange="PreviewImage();">		
												<br>
												<p>Requirements: 160x160px, Max: 3MB File</p>					
												<div class="col-md-6">
													<button type="button" class="btn btn-block btn-primary " onclick="document.getElementById('uploadImage').click()">
													Change
													</button>	
												</div>
												<div class="col-md-6">
													<button type="submit" class="btn btn-block btn-info ">
													Update
													</button>	
												</div>
											</form>			  
										</div>						

								</div>

							</div>
						</div>					

					</div>
					<div class="col-md-8">
						
							<div class="portlet light">
								<div class="portlet-title">
									<div class="caption font-dark">
										<i class="fa fa-newspaper-o font-dark"></i>
										<span class="caption-subject bold uppercase"> Account Information</span>
									</div>
									<div class="tools">
									</div>
								 </div>
								<div class="portlet-body">						
							
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab"> Personal Details </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab"> More Info </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_3" data-toggle="tab"> Roles </a>
                                        </li>										
                                    </ul>							
							        <div class="tab-content">
										<div class="tab-pane fade active in" id="tab_1_1">
								
											<form method="post" class="form-horizontal" action="{{ url('/dashboard/user/'.$data->hashid) }}">
											  {{ csrf_field() }}
											  
											  <div class="form-group has-feedback form-group{{ $errors->has('name') ? ' has-error' : '' }}">
												<label for="name" class="col-sm-4 control-label">Name</label>
												<div class="col-sm-8">
												<input type="text" class="form-control" name="name" id="name" placeholder="Full name" value="{{ $data->name }}" autofocus>
													@if ($errors->has('name'))
														<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
													@endif		
												</div>	
											  </div>
											  <div class="form-group has-feedback form-group{{ $errors->has('designation') ? ' has-error' : '' }}">
												<label for="designation" class="col-sm-4 control-label">Designation</label>
												<div class="col-sm-8">
												<input type="text" class="form-control" name="designation" id="designation" value="{{ $data->designation }}" autofocus>
													@if ($errors->has('designation'))
														<span class="help-block"><strong>{{ $errors->first('designation') }}</strong></span>
													@endif		
												</div>	
											  </div>
											  <div class="form-group has-feedback form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
												<label for="phone" class="col-sm-4 control-label">Phone</label>
												<div class="col-sm-8">
												<input type="text" class="form-control" name="phone" id="phone" value="{{ $data->phone }}"  autofocus>
													@if ($errors->has('phone'))
														<span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>
													@endif		
												</div>	
											  </div>					  
											  <div class="form-group has-feedback form-group{{ $errors->has('email') ? ' has-error' : '' }}">
												<label for="email" class="col-sm-4 control-label">Email</label>
												<div class="col-sm-8">
												<input type="text" class="form-control"  id="email" name="email" value="{{ $data->email }}" disabled>
												</div>	
											  </div>
											  
											  <div class="form-group has-feedback form-group{{ $errors->has('country') ? ' has-error' : '' }}">
												<label for="country" class="col-sm-4 control-label">country</label>
												<div class="col-sm-8">
												<input type="text" class="form-control" id="country" name="country" value="{{ $data->country }}" >
													@if ($errors->has('country'))
														<span class="help-block"><strong>{{ $errors->first('country') }}</strong></span>
													@endif		
												</div>	
											  </div>					  
											  
											  <div class="form-group has-feedback form-group{{ $errors->has('city') ? ' has-error' : '' }}">
												<label for="city" class="col-sm-4 control-label">city</label>
												<div class="col-sm-8">
												<input type="text" class="form-control" id="city" name="city" value="{{ $data->city }}" >
													@if ($errors->has('city'))
														<span class="help-block"><strong>{{ $errors->first('city') }}</strong></span>
													@endif		
												</div>	
											  </div>					  
											  
											  <div class="form-group has-feedback form-group{{ $errors->has('address') ? ' has-error' : '' }}">
												<label for="address" class="col-sm-4 control-label">address</label>
												<div class="col-sm-8">
												<input type="text" class="form-control" id="address" name="address" value="{{ $data->address }}" >
													@if ($errors->has('address'))
														<span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>
													@endif		
												</div>	
											  </div>					  
											  
											  <div class="form-group has-feedback">
												<label for="address" class="col-sm-4 control-label">Status</label>
												<div class="col-sm-4">
													<select name="status" id="status" class="form-control">
														<option value="pending" @if($data->status=="pending") selected @endif>Pending</option>
														<option value="approve" @if($data->status=="approve") selected @endif>Approved</option>
														<option value="block" @if($data->status=="block") selected @endif>Blocked</option>
													</select>
												</div>	
											  </div>										  
											  
											  <div class="form-group">
												<div class="col-sm-offset-4 col-sm-10">
												  <button type="submit" class="btn btn-success">Update</button>
												</div>
											  </div>					  
											</form>	
											
										</div> <!-- end tab -->
										<div class="tab-pane fade " id="tab_1_2">
										  <table class="table table-bordered table-condensed table-striped table-hover">
											<thead>
											<tr><th>Data</th><th>Info</th></tr>
											</thead>
											<tbody>
											<tr><td>Account ID</td><td>{{$data->uid}}</td></tr>
											<tr><td>Date registered</td><td>{{$data->created_at->format('M d, Y')}}</td></tr>
											<tr><td>Last modified</td><td>{{$data->updated_at->diffForHumans()}}</td></tr>
											<tr><td>Last logged</td><td>-</td></tr>
											<tr><td>Company member</td><td>-</td></tr>
											<tr><td>Status</td><td>{{$data->status}}</td></tr>
											<tr><td>Permissions</td><td>
											@foreach($permissions as $perm)
												<span class="badge badge-success badge-roundless">{{$perm}}</span> 
											@endforeach
											</td></tr>
											</tbody>
										  </table>
										
										</div>
										<div class="tab-pane fade " id="tab_1_3">
											<form method="post" id="frmUserRole" class="form-horizontal" action="#">
												{{ csrf_field() }}
												<table class="table table-bordered table-condensed table-striped table-hover">
												<thead>
												<tr><th class="col-sm-1">&nbsp;</th><th>Roles</th><th>Description</th></tr>
												</thead>
												<tbody>												
													@foreach($roles as $role) 
													<tr><td><input type="checkbox"  @if(in_array($role->name,$userRole)) checked @endif   name="roles[]" value="{{$role->name}}"></td><td>{{$role->name}}</td><td>{{$role->description}}</td></tr>
													@endforeach										
												</tbody>
												</table>											
										
											  <div class="form-group">
												<div class="col-sm-offset-4 col-sm-10">
												  <button type="submit" class="btn btn-success">Update</button>
												</div>
											  </div>
											</form>  
										</div>
									</div>
							
								</div>
							</div>	
						
						
							
					</div>
				  </div>				

			<!-- END PORTLET-->
</div>
@endsection


@push('scripts-footer')
<!-- DataTables -->
<script>
$( document ).ready(function() {

	
	$('#frmUserRole').on('submit', function(e) {
		e.preventDefault(); 
		$.ajax({
			type: "POST",
			url: '/dashboard/user/{{$data->hashid}}/role',
			data: $(this).serialize(),
			beforesend: function(){
				
			},
			success: function(dat) {
				json = $.parseJSON(dat);
				App.unblockUI('#boxSetting');
				if(json.status=="ok"){
					toastr["success"](json.message, "success")
					window.location.reload(true);
				}else{
					toastr["error"]("Something wrong while updating configuration.", "error")
				}				
			}
		});
	});	
	
	
})
</script>  
@endpush 


@push('scripts-footer')
<script>
 	function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>
@endpush 