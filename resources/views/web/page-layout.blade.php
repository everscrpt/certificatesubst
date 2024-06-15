@extends('layouts.website', ['activePage' => $activePage, 'titlePage' => $pageTitle])

@section('content')
	<section class="pb-100">
            <div class="page-title mb-5">
                <div class="container">
                    <h1 class="mb-0">{{$data->post_title}}</h1>
                </div>
            </div>
            <div class="content-card mb-5">
                <div class="container">
                @if($data->media)
                    @foreach($data->media->children as $feutured_image)
                        @if($feutured_image->image_size == 'slider')
                        <img src="{{asset($feutured_image->url)}}" alt="{{env('APP_URL')}}" class="w-100 mb-3">
                        @endif
                    @endforeach
                @endif
                    {!! $data->post_content !!}
                </div>
            </div>
	</section>
@endsection