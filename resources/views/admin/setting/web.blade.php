@extends('layouts.app', ['activePage' => 'web-setting', 'titlePage' => __('Settings')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
	  <div class="col-md-12">
          <form method="post" action="{{route('web-setting-update')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Settings') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                
				<div class="card-body">
					<div class="row">
					<div class="col-sm-12">
						<label for="">Site Title:</label>
						<div class="form-group{{ $errors->has('site_title') ? ' has-danger' : '' }}">
						<input class="form-control{{ $errors->has('site_title') ? ' is-invalid' : '' }} input-large-text" name="site_title" id="input-site_title" type="text" value="{{$data->site_title}}" required="true" aria-required="true"/>
						@if ($errors->has('site_title'))
							<span id="name-error" class="error text-danger" for="input-site_title">{{ $errors->first('site_title') }}</span>
						@endif
						</div>
					</div>
					</div>

                    <div class="row">
					<div class="col-sm-12">
						<label for="">Site Url:</label>
						<div class="form-group{{ $errors->has('site_url') ? ' has-danger' : '' }}">
						<input class="form-control{{ $errors->has('site_url') ? ' is-invalid' : '' }} input-large-text" name="site_url" id="input-site_url" type="text" value="{{$data->site_url}}" placeholder="example:  https://ontarioconstructionnews.com/" required="true" aria-required="true"/>
						@if ($errors->has('site_url'))
							<span id="name-error" class="error text-danger" for="input-site_url">{{ $errors->first('site_url') }}</span>
						@endif
						</div>
					</div>
					</div>

			        <div class="row">
						<div class="col-sm-12">
							<label for="">Site Script:</label>
							<div class="form-group{{ $errors->has('site_script') ? ' has-danger' : '' }}">
							<textarea rows="10" class="form-control{{ $errors->has('site_script') ? ' is-invalid' : '' }} input-large-text" name="site_script" id="input-site_script" type="text" value="{{$data->site_script}}" placeholder="Paste javascript here" required="true" aria-required="true">{{$data->site_script}}</textarea>
							@if ($errors->has('site_script'))
								<span id="name-error" class="error text-danger" for="input-site_script">{{ $errors->first('site_script') }}</span>
							@endif
							</div>
						</div>
					</div>


                    <div class="row">
					<div class="col-sm-12">
						<label for="">Footer Copyright Text:</label>
						<textarea name="copyright_text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="input-description" type="text" required="true" aria-required="true">{{$data->copyright_text}}</textarea>
					  	<style>
                        .cke_contents_ltr{
                          height: 100vh!important;
                        }
                        </style>
                        <script>
                          var editPostCKEditor;
                          $(document).ready(function(){
                            editPostCKEditor = CKEDITOR.replace( 'input-description',{
                              height: 300,         
                              extraPlugins: 'justify',
                            });
                            
                          });
                        </script>
					</div>
					</div>

				</div>
				
				</div>
              </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('Save Setting') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


@endsection