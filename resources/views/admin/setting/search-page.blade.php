@extends('layouts.app', ['activePage' => 'search-page-setting', 'titlePage' => __('Search Page Settings')])

@section('content')
<link href="{{ asset('css') }}/icons.css" rel="stylesheet" />

<style>
a:not([href]):not([tabindex]):hover, a:not([href]):not([tabindex]):focus {
    color: #fff;
    text-decoration: none;
}
.my-modal-body{
	max-height: 400px;
    overflow-y: scroll;
}
</style>
<div class="content">
    <div class="container-fluid">
      <div class="row">
	  <div class="col-md-12">
          <form method="post" action="{{route('search-page-setting-update')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Search Page Settings') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">

				<!-- Seco  -->
				<div class="card-body">
					<div class="bg-primary p-2 text-white mb-3"><h5 class="mb-0">SEO</h5></div>
					<div class="row">
					<div class="col-sm-12">
						<label for="">Title:</label>
						<div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
						<input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }} input-large-text" name="title" id="input-title" type="text" value="{{$data->title}}" required="true" aria-required="true"/>
						@if ($errors->has('title'))
							<span id="name-error" class="error text-danger" for="input-title">{{ $errors->first('title') }}</span>
						@endif
						</div>
					</div>
					</div>

					<div class="row">
					<div class="col-sm-12">
						<label for="">Meta Description:</label>
						<div class="form-group{{ $errors->has('meta_description') ? ' has-danger' : '' }}">
						<textarea rows="3" name="meta_description" class="form-control{{ $errors->has('meta_description') ? ' is-invalid' : '' }}" id="input-meta_description" type="text" required="true"  aria-required="true">{{$data->meta_description}}</textarea>
						@if ($errors->has('meta_description'))
							<span id="name-error" class="error text-danger" for="input-meta_description">{{ $errors->first('meta_description') }}</span>
						@endif
						</div>
					</div>
					</div>
				</div>

				<!-- Hero Section  -->
				<div class="card-body mb-3">
					<div class="bg-primary p-2 text-white mb-3"><h5 class="mb-0">HERO SECTION</h5></div>
					<div class="row">
					<div class="col-sm-12">
						<label for="">Title:</label>
						<div class="form-group{{ $errors->has('section_1[title]') ? ' has-danger' : '' }}">
						<input class="form-control{{ $errors->has('section_1[title]') ? ' is-invalid' : '' }} input-large-text" name="section_1[title]" id="input-section_1[title]" type="text" value="{{$data->section_1->title}}" required="true" aria-required="true"/>
						@if ($errors->has('section_1[title]'))
							<span id="name-error" class="error text-danger" for="input-section_1[title]">{{ $errors->first('section_1[title]') }}</span>
						@endif
						</div>
					</div>
					</div>

					<div class="row">
					<div class="col-sm-12">
						<label for="">Sub Title:</label>
						<!-- <div class="form-group{{ $errors->has('section_1[sub_title]') ? ' has-danger' : '' }}">
						<textarea rows="3" name="section_1[sub_title]" class="form-control{{ $errors->has('section_1[sub_title]') ? ' is-invalid' : '' }}" id="input-section_1[sub_title]" type="text" required="true"  aria-required="true">{{$data->section_1->sub_title}}</textarea>
						@if ($errors->has('section_1[sub_title]'))
							<span id="name-error" class="error text-danger" for="input-section_1[sub_title]">{{ $errors->first('section_1[sub_title]') }}</span>
						@endif
						</div> -->
						<textarea name="section_1[sub_title]" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="input-description" type="text" required="true" aria-required="true">{{$data->section_1->sub_title}}</textarea>
					  	<style>
                        .cke_contents_ltr{
                          height: 100vh!important;
                        }
                        </style>
                        <script>
                          $(document).ready(function(){
                            CKEDITOR.replace( 'input-description',{
							  height: 500,
							  extraPlugins: 'justify',
                            });
                            
                          });
                        </script>
					</div>
					</div>
				</div>
              </div>
			  <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Save Setting') }}</button>
              </div>
              </div>
             
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  	<!-- Icon Modal  -->
  	<div id="iconPicker" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body my-modal-body">
					<div>
						<ul class="icon-picker-list">
							<li>
								<a data-class="'item' 'activeState'" data-index="'index'">
									<span class="'item'"></span>
									<span class="name-class">'item'</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="change-icon" class="btn btn-success">
						<span class="fa fa-check-circle-o"></span>
						Use Selected Icon
					</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	@include('media.index')
	  <script script src="{{ asset('js/') }}/icons.js"></script>
		<script>
		// Only media handling section
		var imageType = "";  // featured_image / gallery
		$(function(e){
			$('#mediaModal').on('hide.bs.modal', function (event) {
			if(media_selected_items.length > 0){
				if(imageType == "featured_image"){
				$('#featured_image').val(media_selected_items[0]);
				}

			}

			$.ajax({
					type: 'GET',
					url: "<?php echo asset('')?>"+"admin/media/get-item/"+media_selected_items[0]+'/'+media_selected_size,
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					data:  '',
					dataType: "json",
					success: function(data) {

					if(imageType == "content_image"){

						var custimage = editPostCKEditor.document.createElement('img');
						custimage.setAttribute('src', data.url);
						custimage.setAttribute('alt', '{{env("APP_URL")}}');
						editPostCKEditor.insertElement(custimage);

					}

					if(imageType == "featured_image"){

						$.each(data.children, function(i, item) {
						if(item.image_size == 'thumbnail'){
							$("#output_image_featured").html('<img src="'+item.url+'" class="w-75">');
							$("#old_image_featured").hide();

						}
						});
					}
					
					},
					error: function(data){
						// alert('error');
					}
				});
			})
		});

		function setImageType(type){
			imageType = type;
			if(imageType == "featured_image"){
			setAllowMultiple(false);
			}
			if(imageType == "gallery"){
			setAllowMultiple(true);
			}
		}
	</script>

@endsection