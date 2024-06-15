@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card card-stats">
            <div class="card-header card-header-primary">
              <h5 class="mb-0">Home Page OCN-Daily Ad</h5>
            </div>
            <div class="p-3">
              <form method="post" action="{{route('home-ocn-update')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              @method('post')
                <div class="row">
                  <div class="col-sm-12">
                    <label for="">Title:</label>
                    <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }} input-large-text" name="title" id="input-title" type="text" value="{{$home_ocn->title}}" required="true" aria-required="true"/>
                    @if ($errors->has('title'))
                      <span id="name-error" class="error text-danger" for="input-title">{{ $errors->first('title') }}</span>
                    @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <label for="">Link:</label>
                    <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }} input-large-text" name="link" id="input-link" type="text" value="{{$home_ocn->link}}" placeholder="example:  https://ontarioconstructionnews.com/" required="true" aria-required="true"/>
                    @if ($errors->has('link'))
                      <span id="name-error" class="error text-danger" for="input-link">{{ $errors->first('link') }}</span>
                    @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <label for="">Image:</label>
                    <input  name="image"  type="file" />
                    </div>
                    <div class="p-3"><img src="{{asset($home_ocn->image)}}" alt="" class="w-25"></div>
                  </div>
                </div>
                <div class="p-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary ml-auto">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card card-stats">
            <div class="card-header card-header-primary">
              <h5 class="mb-0">Search Page OCN-Daily Ad</h5>
            </div>
            <div class="p-3">
              <form method="post" action="{{route('search-ocn-update')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
              @csrf
              @method('post')
                <div class="row">
                  <div class="col-sm-12">
                    <label for="">Link:</label>
                    <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }} input-large-text" name="link" id="input-link" type="text" value="{{$search_ocn->link}}" placeholder="example:  https://ontarioconstructionnews.com/" required="true" aria-required="true"/>
                    @if ($errors->has('link'))
                      <span id="name-error" class="error text-danger" for="input-link">{{ $errors->first('link') }}</span>
                    @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <label for="">Image:</label>
                    <input  name="image"  type="file"/>
                    </div>
                    <div class="p-3"><img src="{{asset($search_ocn->image)}}" alt="" class="w-25"></div>
                  </div>
                </div>
                <div class="p-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary ml-auto">Save</button>
                </div>
              </form>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush