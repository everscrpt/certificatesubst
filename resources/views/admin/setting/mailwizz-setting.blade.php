@extends('layouts.app', ['activePage' => 'mailwizz-settings', 'titlePage' => __('Mailwizz Settings')])

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<div class="content">
    <div class="container-fluid">
      <div class="row">
	  <div class="col-md-12">
          <form method="post" action="{{route('mailwizz-settings-update')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Mailwizz Settings') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                
				<div class="card-body">
					<div class="row">
						<div class="col">
							<label for="">Active:</label>
							<div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
							<label class="custom-control custom-checkbox">
								<input type="checkbox" name="status" class="custom-control-input" {{($data->status == 1) ? 'checked' : ''}}>
								<span class="custom-control-indicator"></span>
								@if($data->status == 1)
									<span class="custom-control-description">Active</span>
								@else
									<span class="custom-control-description">Inactive</span>
								@endif
							</label>
							@if ($errors->has('status'))
								<span id="name-error" class="error text-danger" for="input-status">{{ $errors->first('status') }}</span>
							@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<label for="">Notification Time:</label>
							<div class="form-group{{ $errors->has('time') ? ' has-danger' : '' }}  form-inline">
								<input 
									id="input-time" 
									class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" 
									name="time"
									type="time" 
									value="{{$data->time}}" 
									required="true" 
									aria-required="true"/>
								@if ($errors->has('time'))
									<span id="name-error" class="error text-danger" for="input-time">{{ $errors->first('time') }}</span>
								@endif
							</div>
						</div>
					</div>

			        <div class="row">
						<div class="col-sm-12">
							<label for="">From Name:</label>
							<div class="form-group{{ $errors->has('from_name') ? ' has-danger' : '' }}">
							<input class="form-control{{ $errors->has('from_name') ? ' is-invalid' : '' }} input-large-text" name="from_name" id="input-from_name" type="text" value="{{$data->from_name}}" required="true" aria-required="true" value="{{old('from_name',$data->from_name)}}" />
							@if ($errors->has('from_name'))
								<span id="name-error" class="error text-danger" for="input-from_name">{{ $errors->first('from_name') }}</span>
							@endif
							</div>
						</div>
					</div>

                    <div class="row">
						<div class="col-sm-12">
							<label for="">From Email:</label>
							<div class="form-group{{ $errors->has('from_email') ? ' has-danger' : '' }}">
							<input class="form-control{{ $errors->has('from_email') ? ' is-invalid' : '' }} input-large-text" name="from_email" id="input-from_email" type="text" value="{{$data->from_email}}" required="true" aria-required="true"  value="{{old('from_email',$data->from_email)}}" />
							@if ($errors->has('from_email'))
								<span id="name-error" class="error text-danger" for="input-from_email">{{ $errors->first('from_email') }}</span>
							@endif
							</div>
						</div>
					</div>

                    <div class="row">
						<div class="col-sm-12">
							<label for="">Reply To:</label>
							<div class="form-group{{ $errors->has('reply_to') ? ' has-danger' : '' }}">
							<input class="form-control{{ $errors->has('reply_to') ? ' is-invalid' : '' }} input-large-text" name="reply_to" id="input-reply_to" type="text" value="{{$data->reply_to}}" required="true" aria-required="true" value="{{old('reply_to',$data->reply_to)}}" />
							@if ($errors->has('reply_to'))
								<span id="name-error" class="error text-danger" for="input-reply_to">{{ $errors->first('reply_to') }}</span>
							@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<label for="">Mail Subject:</label>
							<div class="form-group{{ $errors->has('mail_subject') ? ' has-danger' : '' }}">
							<input class="form-control{{ $errors->has('mail_subject') ? ' is-invalid' : '' }} input-large-text" name="mail_subject" id="input-mail_subject" type="text" value="{{$data->mail_subject}}" required="true" aria-required="true" value="{{old('mail_subject',$data->mail_subject)}}" />
							@if ($errors->has('mail_subject'))
								<span id="name-error" class="error text-danger" for="input-mail_subject">{{ $errors->first('mail_subject') }}</span>
							@endif
							</div>
						</div>
					</div>

                    <div class="row">
						<div class="col-sm-12">
							<label for="">Mailwizz List ID:</label>
							<div class="form-group{{ $errors->has('mailwizz_list_id') ? ' has-danger' : '' }}">
							<input class="form-control{{ $errors->has('mailwizz_list_id') ? ' is-invalid' : '' }} input-large-text" name="mailwizz_list_id" id="input-mailwizz_list_id" type="text" value="{{$data->mailwizz_list_id}}" required="true" aria-required="true"  value="{{old('mailwizz_list_id',$data->mailwizz_list_id)}}" />
							@if ($errors->has('mailwizz_list_id'))
								<span id="name-error" class="error text-danger" for="input-mailwizz_list_id">{{ $errors->first('mailwizz_list_id') }}</span>
							@endif
							</div>
						</div>
					</div>


                    <div class="row">
					<div class="col-sm-12">
						<label for="">Email Template:</label>
						<textarea name="email_template" class="form-control{{ $errors->has('email_template') ? ' is-invalid' : '' }}" id="input-email_template" type="text" required="true" aria-required="true">{{$data->email_template}}</textarea>
					  	<style>
                        .cke_contents_ltr{
                          height: 100vh!important;
                        }
                        </style>
                        <script>
                          var editPostCKEditor;
                          $(document).ready(function(){
                            editPostCKEditor = CKEDITOR.replace( 'input-email_template',{
                              height: 500,         
                              extraPlugins: 'justify',
                            });
                            
                          });
                        </script>
					</div>
					</div>
                    <button type="submit" class="btn btn-primary mt-3">{{ __('Save Setting') }}</button>
				</div>
				
				</div>
              </div>
              </div>
              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


@endsection