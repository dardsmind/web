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
				<a href="javascript:;">Blogs entries</a>
				<i class="fa fa-circle"></i>
			</li>			
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h3 class="page-title">  Blogs 
	</h3>
	<!-- END PAGE TITLE-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<span class="caption-subject bold"> List</span>
					</div>
					<div class="tools">
					</div>
				 </div>
				<div class="portlet-body">
				<div class="note note-info note-bordered">
					<p>
					To reorder the blog on front page, just drag the row index on the table below
					</p>
				</div>				
				<div class="row">
					<div class="col-md-12">
						<a href="{{ route('dashboard.blog.new') }}" class="btn green"><i class="fa fa-plus"></i> New </a>
					</div>
				</div>		
				<br/>
				  <table id="tblUserList" class="table table-bordered table-condensed table-striped table-hover">
					<thead>
					<tr>
					  <th>#</th>
					  <th class="col-md-3">Title</th>
						<th>Author</th>
						<th>Category</th>
						<th>Tags</th>
						<th>Publish</th>
						<th>Front</th>
					  <th>Date created</th>
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
@endsection


@push('scripts-footer')
<!-- DataTables -->

<script>
$( document ).ready(function() {
	
    var blogTable=$('#tblUserList').DataTable({
				stateSave: true,
        processing: true,
				rowReorder:true,
        serverSide: true,
        ajax: "{{ route('dashboard.blog.data') }}",
				rowReorder: {

				},				
        columns: [
					{ data: 'DT_Row_Index', orderable: false, searchable: false},
					{ data: 'title', name: 'title' ,orderable: false,"searchable": true},
					{ data: 'author_id', name: 'author_id' ,orderable: false,"searchable": true},
					{ data: 'category_id', name: 'category_id' ,orderable: false,"searchable": true },
					{ data: 'tags', name: 'tags' ,orderable: false,"searchable": false },
					{ data: 'publish', name: 'publish' ,orderable: false,"searchable": false },
					{ data: 'frontpage', name: 'frontpage' ,orderable: false,"searchable": false },
					{ data: 'created_at', name: 'created_at' ,orderable: false,"searchable": false },
					{ data: 'action', name: 'action', orderable: false,"defaultContent": ""}
        ]
    });	

		blogTable.on('row-reorder', function ( e, diff, edit ) {
				var ids = new Array();
				for (var i = 1; i < e.target.rows.length; i++) {
						//var b =e.target.rows[i].cells[0].innerHTML.split('data-rowid="');
		//				var b =e.target.rows[i].cells[0].innerHTML;
						//var b2 = b[1].split('"></div>')
						ids.push(e.target.rows[i].id);
		//				console.log(e.target.rows[i].id);
				}
				$.ajax({  
					url:"{{route('dashboard.blog.reorder')}}",
					type:"post",  
					data: {
						_token: "{{ csrf_token() }}",
						order: ids
						},  
					success:function(){ 

						toastr["success"]("Record re ordered", "Success")

					}  
				});				
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
					url:"{{route('dashboard.blog.delete')}}",
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