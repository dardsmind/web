@extends('layouts.app')
@section('content')
<div class="page-content">
	<!-- BEGIN PAGE HEADER-->
	<!-- BEGIN PAGE BAR -->
	<div class="page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="{{ url('/dashboard') }}">Home</a><i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="javascript:;">Settings</a><i class="fa fa-circle"></i>
			</li>				
			<li>
				<a href="javascript:;">System Configuration</a><i class="fa fa-circle"></i>
			</li>	
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h3 class="page-title"> System Configuration </h3>
	<!-- END PAGE TITLE-->
	<div class="row">

			<div class="col-md-12">
					<div class="portlet box blue-hoki" id="boxSetting">
						<div class="portlet-title" >
							<div class="caption font-dark">
								<i class="icon-equalizer font-dark"></i> 
								<span class="caption-subject bold uppercase"> Settings</span>
							</div>
							<div class="tools">
							</div>
						 </div>
						<div class="portlet-body form">						
							<form method="post" id="frmConfig" class="form-horizontal" action="">
								<div class="form-body">
									<h3 class="form-section">Mailer Setting</h3>
									  {{ csrf_field() }}
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Mail Username</label>
												<div class="col-md-8">
												<input type="text" name="mail_username" class="form-control" value="{{$mail_username}}">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Password</label>
												<div class="col-md-8">
												<input type="password" name="mail_password" class="form-control" value="{{$mail_password}}">
												</div>
											</div>
										</div>
									</div>								  
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">SMTP Host</label>
												<div class="col-md-8">
												<input type="text" name="mail_host" class="form-control" value="{{$mail_host}}">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Port</label>
												<div class="col-md-8">
												<input type="text" name="mail_port" class="form-control" placeholder="21" value="{{$mail_port}}">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Sender Name</label>
												<div class="col-md-8">
												<input type="text" name="mail_from_name" class="form-control" value="{{$mail_from_name}}">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Sender Mail Address</label>
												<div class="col-md-8">
												<input type="text" name="mail_from_address" class="form-control" value="{{$mail_from_address}}">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-4 col-md-9">
													<button type="submit" class="btn green">Save Configuration</button>
												</div>
											</div>
										</div>
										<div class="col-md-6"> </div>
									</div>									
									
									<h3 class="form-section">File System</h3>
									<div class="note note-info note-bordered">
										<p>
										File System is use for storing uploaded files such as documents and images this can be in local or separate server
										</p>
									</div>									
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Select Disk System</label>
												<div class="col-md-8">
													<select name="filesystems_default" class="form-control">
														<option value="local" @if($filesystems_default=="local") selected @endif >Local</option>
														<option value="s3" @if($filesystems_default=="s3") selected @endif >AWS S3</option>
														<option value="ftp" @if($filesystems_default=="ftp") selected @endif>FTP</option>
													</select>												

												</div>
											</div>
										</div>
										<div class="col-md-6">
										</div>
									</div>
									<h4 class="form-section">FTP</h4>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Host</label>
												<div class="col-md-8">
												<input type="text" name="filesystems_disks_ftp_host" class="form-control" value="{{$filesystems_disks_ftp_host}}">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Root path</label>
												<div class="col-md-8">
												<input type="text" name="filesystems_disks_ftp_root" class="form-control" placeholder="/public_html/" value="{{$filesystems_disks_ftp_root}}">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Username</label>
												<div class="col-md-8">
												<input type="text" name="filesystems_disks_ftp_username" class="form-control" value="{{$filesystems_disks_ftp_username}}">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Password</label>
												<div class="col-md-8">
												<input type="password" name="filesystems_disks_ftp_password" class="form-control" value="{{$filesystems_disks_ftp_password}}">
												</div>
											</div>
										</div>
									</div>	
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Public base path</label>
												<div class="col-md-8">
												<input type="text" name="filesystems_disks_ftp_public" class="form-control" value="{{$filesystems_disks_ftp_public}}">
												</div>
											</div>
										</div>
										<div class="col-md-6">
										</div>
									</div>									
									<h4 class="form-section">Amazon AWS S3</h4>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Key</label>
												<div class="col-md-8">
												<input type="text" name="filesystems_disks_s3_key" class="form-control" value="{{$filesystems_disks_s3_key}}">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Secret</label>
												<div class="col-md-8">
												<input type="password" name="filesystems_disks_s3_secret" class="form-control" value="{{$filesystems_disks_s3_secret}}">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Region</label>
												<div class="col-md-8">
												<input type="text" name="filesystems_disks_s3_region" class="form-control" value="{{$filesystems_disks_s3_region}}">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Bucket</label>
												<div class="col-md-8">
												<input type="text" name="filesystems_disks_s3_bucket" class="form-control" value="{{$filesystems_disks_s3_bucket}}">
												</div>
											</div>
										</div>
									</div>										
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label col-md-4">Public base path</label>
												<div class="col-md-8">
												<input type="text" name="filesystems_disks_s3_public" class="form-control" value="{{$filesystems_disks_s3_public}}">
												</div>
											</div>
										</div>
										<div class="col-md-6">
										</div>
									</div>	
									
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-offset-4 col-md-9">
													<button type="submit" class="btn green">Save Configuration</button>
												</div>
											</div>
										</div>
										<div class="col-md-6"> </div>
									</div>
								</div>								
							</form>	
						</div>
												
						
					</div>	
				
			</div>

	
	

	</div>
</div>
@endsection


@push('scripts-footer')
<!-- DataTables -->
<script>
$( document ).ready(function() {

	
	$('#frmConfig').on('submit', function(e) {
		e.preventDefault(); 
		
		App.blockUI({
			target: '#boxSetting',
			animate: true					
		});			
		
		$.ajax({
			type: "POST",
			url: '/dashboard/settings/configuration',
			data: $(this).serialize(),
			beforesend: function(){
			
			},
			success: function(dat) {
				json = $.parseJSON(dat);
				App.unblockUI('#boxSetting');
				if(json.status=="ok"){
					toastr["success"]("Configuration successfully updated.", "success")
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