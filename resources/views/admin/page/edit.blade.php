@extends('layouts.app', ['activePage' => 'page', 'titlePage' => __('Edit Page')])

@section('content')

  <div class="content">
    <div class="container-fluid">
      <div class="row">
	  <div class="col-md-12">
          <form method="post" action="{{ route('page.update', $post->id) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{$post->id}}">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add Page') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                    @if($post->post_status == 'published')
                      @if($post->slug)
                      <a rel="tooltip" target="_blank" class="btn btn-info text-white btn-sm" href="{{ route('page-layout', $post->slug) }}" data-original-title="" title="Veiw">
                        <small>View</small>
                      </a>
                      @endif
                    @endif
                    <a href="{{ route('page.index') }}" class="btn btn-sm btn-primary">{{ __('All Trail') }}</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <label for="">Title:</label>
                    <div class="form-group{{ $errors->has('post_title') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('post_title') ? ' is-invalid' : '' }} input-large-text" name="post_title" id="input-post_title" type="text" placeholder="{{ __('Title') }}" value="{{ old('post_title') ?  old('post_title')  : $post->post_title }}" required="true" aria-required="true"/>
                      @if ($errors->has('post_title'))
                        <span id="name-error" class="error text-danger" for="input-post_title">{{ $errors->first('post_title') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                
				        @if(isset($post->slug))
                <div class="row">
                  <div class="col-sm-12">
                    <label for="">Slug:</label>
                    <div class="form-group{{ $errors->has('slug') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" id="input-slug" type="text" placeholder="{{ __('Slug') }}" value="{{ old('slug') ? old('slug') : $post->slug }}" required="true" aria-required="true"/>
                      @if ($errors->has('slug'))
                        <span id="name-error" class="error text-danger" for="input-slug">{{ $errors->first('slug') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                @endif

                <div class="row">
                  <div class="col-sm-12">
                    <label for="">Meta Description:</label>
                    <div class="form-group{{ $errors->has('meta_description') ? ' has-danger' : '' }}">
                      <textarea rows="3" name="meta_description" class="form-control{{ $errors->has('meta_description') ? ' is-invalid' : '' }}" id="input-meta_description" type="text"  placeholder="{{ __('Meta Description') }}" required="true"  aria-required="true">{{ old('meta_description') ? old('meta_description') : $post->meta_description }}</textarea>
                      @if ($errors->has('meta_description'))
                        <span id="name-error" class="error text-danger" for="input-meta_description">{{ $errors->first('meta_description') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
               
                <div class="row">
                  <div class="col-sm-12">
                    <label for="">Content:</label>
                    <div class="form-group{{ $errors->has('post_content') ? ' has-danger' : '' }}">
                      <textarea name="post_content" class="form-control{{ $errors->has('post_content') ? ' is-invalid' : '' }}" id="input-post_content" type="text" placeholder="{{ __('Post Content') }}" required="true" aria-required="true">{{ old('post_content') ? old('post_content') : $post->post_content }}</textarea>
                        <style>
                        .cke_contents_ltr{
                          height: 100vh!important;
                        }
                        </style>
                        <script>
                          var editPostCKEditor;
                          $(document).ready(function(){
                            editPostCKEditor = CKEDITOR.replace( 'input-post_content',{
                              height: 500,
                              extraPlugins: 'justify',
                            });
                            
                          });
                        </script>
                      @if ($errors->has('post_content'))
                        <span id="name-error" class="error text-danger" for="input-post_content">{{ $errors->first('post_content') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <label for="">Excerpt:</label>
                    <div class="form-group{{ $errors->has('post_excerpt') ? ' has-danger' : '' }}">
                      <textarea style="height:500px" name="post_excerpt" class="form-control{{ $errors->has('post_excerpt') ? ' is-invalid' : '' }}" id="input-post_excerpt"  placeholder="{{ __('Post Excerpt') }}" type="text" aria-required="true">{{ old('post_excerpt') ? old('post_excerpt') : $post->post_excerpt }}</textarea>
                      @if ($errors->has('post_excerpt'))
                        <span id="name-error" class="error text-danger" for="input-post_excerpt">{{ $errors->first('post_excerpt') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
				        @php
                  $post_statuses = Config::get('custom.post.post_statuses');
                @endphp
              <div class="row">
                <div class="col-lg-12">
                  <label class="col-form-label">{{ __('Post Status') }}</label>
                  <div class="col-sm-2 p-0">
                    <div class="form-group{{ $errors->has('post_status') ? ' has-danger' : '' }}">
                      <select data-style="btn-outline-secondary rounded-0 p-2 ml-2"  data-width="fit" show-tick  class="selectpicker"  name="post_status" id="post_status">
                      @foreach ($post_statuses as $key => $post_status)
                        <option {{ $post->post_status == $key ? 'selected' : '' }} value="{{$key}}">{{$post_status}}</option>
                      @endforeach
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="row mb-3">
                  <label class="col-12 col-form-label text-muted">{{ __('Featured Image:') }}</label>
                  <div class="col-md-12">
                    <input id="featured_image" type="hidden" name="featured_image" readonly value="{{ isset($post->featured_image) ? $post->featured_image : ''}}">
                    <div id="output_image_featured"></div>
                    <div id="old_image_featured">
                      @if(isset($post->media))
                        @foreach($post->media->children as $child_image)
                          @if($child_image->image_size == 'thumbnail')
                          <img src="{{asset($child_image->url)}}" alt="" class="w-75">
                          @endif
                        @endforeach
                      @endif
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mediaModal" onClick="setImageType('featured_image')">
                    <i class="material-icons">image</i>
                      Select Image
                    </button>
                  </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Save Page') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @include('media.index')

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