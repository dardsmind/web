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
				<a href="{{ route('dashboard.blog.index') }}">Blogs</a>
				<i class="fa fa-circle"></i>
			</li>				
			<li>
				<a href="javascript:;">Blogs new</a>
				<i class="fa fa-circle"></i>
			</li>			
		</ul>
	</div>
	<!-- END PAGE BAR -->
	<!-- BEGIN PAGE TITLE-->
	<h3 class="page-title">  Compose new 
	</h3>
	<!-- END PAGE TITLE-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PORTLET-->
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<span class="caption-subject bold"> New</span>
					</div>
					<div class="tools">
					</div>
				 </div>
				<div class="portlet-body">
				
				<div class="row">
					<div class="col-md-12">

		    <form method="post" id="frmNewBlog" action="" class="form-horizontal">
			  {{ csrf_field() }}
			  <div class="form-body">

				  <div class="form-group has-feedback form-group{{ $errors->has('title') ? ' has-error' : '' }}">
						<label class="col-md-2 control-label">Blog Title</label>
						<div class="col-md-7">
						<input type="text" class="form-control" name="title" id="title" placeholder="" value="" required autofocus>
							
                        </div>	
						<label class="col-md-1 control-label">Publish</label>
						<div class="col-md-2">			  
							<select id="publish" name="publish" class="form-control">
                                <option value="yes">yes</option>
                                <option value="no" selected >no</option>
							</select>
						</div>                        
					</div>
					
				  <div class="form-group has-feedback form-group{{ $errors->has('category') ? ' has-error' : '' }}">
						<label class="col-md-2 control-label">Category</label>
						<div class="col-md-4">			  
							<select id="category" name="category" class="form-control">
							@foreach($category as $cat)
								<option value="{{$cat->id}}">{{$cat->name}}</option>
							@endforeach
							</select>
						</div>
						<label class="col-md-4 control-label">Show on front page</label>
						<div class="col-md-2">			  
                            <select id="frontpage" name="frontpage" class="form-control">
                                <option value="yes">yes</option>
                                <option value="no" selected>no</option>
							</select>                            
						</div>                        								
					</div>

				  <div class="form-group has-feedback form-group{{ $errors->has('category') ? ' has-error' : '' }}">
						<label class="col-md-2 control-label">Tags</label>
						<div class="col-md-6">
							<select name="tags[]" id="select2-button-addons-single-input-group-sm" class="form-control js-data-example-ajax" multiple required>
							</select>						
						</div>
						<div class="col-md-4">
							&nbsp;&nbsp; <button type="submit" class="btn green pull-right">Save</button>
						</div>						
					</div>

				  <div class="form-group has-feedback form-group{{ $errors->has('content') ? ' has-error' : '' }}">
					<div class="col-md-12">			  
						<textarea class="well" id="content" name="content"></textarea>
					</div>		
					</div>

					
			  </div>
				<div class="form-actions fluid">
					<div class="row">
						<div class="col-md-offset-5 col-md-12">
							<button type="submit" class="btn green disabled btnSubmit">Submit</button>
							<a href="{{ route('dashboard.blog.index') }}" class="btn default">Cancel</a>
						</div>
					</div>
				</div>			  
			</form>


					</div>
				</div>		


				</div>
			</div>
			<!-- END PORTLET-->
		</div>
	</div>
</div>
@endsection

@push('links-head')
	<link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

	<!-- <link href="{{asset('assets/global/plugins/bootstrap-summernote/summernote.css')}}" rel="stylesheet" type="text/css" /> -->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">	
@endpush
@push('scripts-footer')
	<!-- <script src="{{asset('assets/global/plugins/bootstrap-summernote/summernote.min.js')}}" type="text/javascript"></script> -->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>	
	<script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
@endpush

@push('scripts-footer')
<script>
$( document ).ready(function() {
	
    var HelloButton = function (context) {
        var ui = $.summernote.ui;
        var button = ui.button({
            contents: 'Code',
            tooltip: 'hello',
            click: function () {
                $('#content').summernote('editor.pasteHTML', '<pre class="php">Place your code here.</pre>');
			}
		});
		return button.render(); 
	}

var EventData = function (context) {
        var ui = $.summernote.ui;
	    var event = ui.buttonGroup([
            ui.button({
                contents: 'Event <i class="fa fa-caret-down" aria-hidden="true"></i>',
                tooltip: 'Event Data',
                data: {
                    toggle: 'dropdown'
                }
            }),
            ui.dropdown({
			
				className: 'dropdown-menu drop-default summernote-list',
				contents: "<ul role='list'><li role='listitem'><a href='#' data-value='111'>one</a></li><li role='listitem'>two</li><li><a href='#' data-value='333'>three</a></li></ul>",
                callback: function (items) {
                    $(items).find('li a').on('click', function(){
                        context.invoke("editor.insertText", $(this).html())
                    })
                }
            })
        ]);
	   return event.render();   // return button as jquery object
    }


	$('#content').summernote({
        height: 800,
        tabsize: 2,
		toolbar: [
              ['style', ['style']],
			  ['mybutton', ['hello','mylink']],
              ['font', ['bold', 'underline', 'clear']],
              ['fontname', ['fontname']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'video']],
              ['view', ['fullscreen', 'codeview', 'help']]
          ],
		  buttons: {
					hello: HelloButton,
					mylink: EventData
          },
		  callbacks: {
			onImageUpload: function(image) {
            uploadImage(image[0]);
        		}		  
		  }
    });		

	function uploadImage(image) {
		var data = new FormData();
		data.append("file", image);
		data.append("_token","{{ csrf_token() }}");
		$.ajax({
			url: "{{ route('upload.document') }}",
			cache: false,
			contentType: false,
			processData: false,
			data: data,
			type: "post",
			success: function(url) {
				var image = $('<img>').attr('src', 'http://' + url);
				$('#content').summernote("insertNode", image[0]);
			},
			error: function(data) {
				console.log(data);
			}
		});
	}		


	$('#frmNewBlog').on('submit', function(e) {
		e.preventDefault(); 
		$.ajax({
			type: "POST",
			url: "{{ route('dashboard.blog.new') }}",
			data: $(this).serialize(),
			beforesend: function(){
				
			},
			success: function(dat) {
				//json = $.parseJSON(dat);
				//App.unblockUI('#boxSetting');
				if(dat.status=="ok"){
					toastr["success"](dat.message, "success")
					window.location.replace("/dashboard/blog/" + dat.id);
				}else{
					toastr["error"]("Something wrong.", "error")
				}				
			}
		});
	});	

	$("#frmNewBlog input[name='title']").on('blur', function(e) {
		$.ajax({
			type: "POST",
			url: "{{ route('dashboard.blog.titlesearch') }}",
			data: {
				title: $(this).val(),
				_token:'{{ csrf_token() }}'
			},
			success: function(dat) {
				if(dat.exist==false){
					$("#frmNewBlog button.btnSubmit").removeClass("disabled");
				}else{
					toastr["error"]("Title already exist!", "error")
					$("#frmNewBlog button.btnSubmit").addClass("disabled");
				}				
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


	$(".js-data-example-ajax").select2({
		width: "off",
		ajax: {
			url: "{{route('dashboard.tags.search')}}",  //"{{route('dashboard.tags.search')}}"
			dataType: 'json',
			delay: 250,
			data: function(params) {
				return {
					q: params.term, // search term  "https://api.github.com/search/repositories"
					page: params.page
				};
			},
			processResults: function(data, page) {
				return {
					results: data.items
				};
			},
			cache: true
		},
		escapeMarkup: function(markup) {
			return markup;
		}, // let our custom formatter work
		minimumInputLength: 1,
		templateResult: formatRepo,
		templateSelection: formatRepoSelection
	});

	function formatRepo(repo) {
		if (repo.loading) return repo.text;
		var markup = "<div class='select2-result-repository clearfix'>" +
			"<div class='select2-result-repository__title'>" + repo.name + "</div>";
		return markup;
	}
	function formatRepoSelection(repo) {
		return repo.name || repo.text;
	}


})
</script>  
@endpush 