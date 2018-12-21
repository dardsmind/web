@extends('layouts.app')

@push('links-head')
<link href="{{asset('assets/global/plugins/dropzone/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/global/plugins/dropzone/basic.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts-footer')
<script src="{{asset('assets/global/plugins/dropzone/dropzone.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/pages/scripts/form-dropzone.min.js')}}" type="text/javascript"></script>
@endpush

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
				<a href="javascript:;">Document list</a>
				<i class="fa fa-circle"></i>
			</li>
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h3 class="page-title"> Documents list
	</h3>
	<!-- END PAGE TITLE-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<span class="caption-subject bold uppercase"> Files</span>
					</div>
					<div class="tools">
						<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
						<a href="#" class="reload refresh" data-original-title="" title=""> </a>
					</div>
				 </div>
				<div class="portlet-body">
				
				<div class="row">
					<div class="col-md-12">
						<button type="button" class="btn green" data-toggle="modal" data-target="#mdNewUpload"><i class="fa fa-plus"></i> Add File</button>
					</div>
				</div>		
			  <br/>
              <table id="tblRoles" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
					<th>#</th>
									<th>&nbsp;</th>
                  <th>Type</th>
                  <th>Created</th>
                  <th>&nbsp;</th>
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


<!--------------------- new file -------------------------->
<div class="modal fade" id="mdNewUpload" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">Upload new Files</h4>
	  </div>
	  <div class="modal-body">
		<form method="post" id="frmFilesDropzone" class="dropzone dropzone-file-area" action="{{ route('upload.document') }}" style="width: 500px; margin-top: 50px;">
		  {{ csrf_field() }}
			<h3 class="sbold">Drop files here or click to upload</h3>
			<p>Allowed file type are: jpeg,jpg,png with maximum size of 3mb<br/>
			<?php 
			
			$maxUpload      = (int)(ini_get('upload_max_filesize'));
			$maxPost        = (int)(ini_get('post_max_size'));			
			echo "max upload:".$maxUpload;
			echo "<br/>max post:".$maxPost;
			?>
			</p>
		</form> 
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	  </div>
	</div>
	<!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@endsection


@push('scripts-footer')
<script>
$( document ).ready(function() {
	
	Dropzone.options.frmFilesDropzone = {
	  autoProcessQueue: true,
	  init: function() {
		// var submitButton = document.querySelector("#submit-all")
			// frmFilesDropzone = this;
		// submitButton.addEventListener("click", function() {
		  // frmFilesDropzone.processQueue();
		// });
		this.on("complete", function() {
			var _this = this;
			_this.removeAllFiles();
			
		  //if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
			 $('#tblRoles').DataTable().ajax.reload();
		 // }
		});
	  }
	};	
	
	
    $('#tblRoles').DataTable({
        processing: false,
		paging:false,
		searching:false,
		info:false,
        serverSide: true,
        ajax: '{!! route('dashboard.documents.data') !!}',
        order: [[3, 'desc']],   
        columns: [
			{ data: 'DT_Row_Index', orderable: false, searchable: false},
			{ data: 'fpath', name: 'fpath' ,"searchable": false},
      { data: 'mime_type', name: 'mime_type' ,"searchable": true},
			{ data: 'created_at', name: 'createdat' ,"searchable": false },
            { data: 'action', name: 'action', "orderable":false,"defaultContent": ""}
        ]
    });	
	
	$(document).on('click', '.refresh', function(e){  
		e.preventDefault();
		$('#tblRoles').DataTable().ajax.reload(); 
	})
	
	// $('#frmRole').on('submit', function(e) {
		// e.preventDefault(); 
		// $.ajax({
			// type: "POST",
			// url: '/dashboard/role',
			// data: $(this).serialize(),
			// beforesend: function(){
				// $('#mdRole').modal('hide');
			// },
			// success: function(msg) {
				// $('#frmRole').trigger('reset');
				// $('#tblRoles').DataTable().ajax.reload();
			// }
		// });
	// });	
	
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
									url:"{{ route('delete.document')}}", 			
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

				
	});	
})
</script>  
@endpush 