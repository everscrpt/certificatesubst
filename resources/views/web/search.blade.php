@extends('layouts.website', ['activePage' => 'search', 'pageTitle' => __($pageTitle)])

@section('content')
    <div class="hero-section flex-center flex-column">
        <h1 class="title">{{$data->section_1->title}}</h1>
        <p>{!! $data->section_1->sub_title !!}</p>
        <div class="content search-container my-3">
            <form method="get" action="{{route('search')}}" autocomplete="off">
                @method('get')
                @csrf
                <div class="search-wrap">
                    <div class="search-box">
                        <div class="input-group mb-3">
                            <input name="search" value="{{ request()->query('search') }}" type="text" class="form-control" placeholder='For exact match please enclose your search keyword with double quote, e.g. "search keyword"' aria-label='For exact match please enclose your search keyword with double quote, e.g. "search keyword"' aria-describedby="basic-addon2" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary font-white" type="submit" value="Search"><i class="fa fa-search font-white"></i> Search</button>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="date-selection-wrap flex-center">
                        <div class="input-group mb-3 date-selector-width">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                            <input id="dateRangeSelector" type="text" name="dateBetween" class="form-control dateRangeSelector" aria-describedby="basic-addon2">
                        </div>
                    </div> --}}

                    <div class="date-selection-wrap flex-center d-flex flex-row">
                        <div class="input-group mb-3 date-selector-width mr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                            <input value="{{ request()->query('dateStart') }}" id="dateRangeStart" placeholder="Start Date" type="text" name="dateStart" class="form-control dateSelector" aria-describedby="basic-addon2" required>
                        </div>

                        <div class="input-group mb-3 date-selector-width">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                            <input value="{{ request()->query('dateEnd') }}" id="dateRangeEnd" placeholder="End Date"  type="text" name="dateEnd" class="form-control dateSelector" aria-describedby="basic-addon2" required>
                        </div>
                    </div>   
                    
                </div>
            </form>
        </div>
    </div>
    
    <div class="container">
        {{-- @include('nav') --}}
        <div class="content">
            <div class="search-results">

                @if($totalResult)
                    <h2 class="text-left my-3">Results showing for search key "<span class="font-weight-bold">{{ trim(request()->query('search'), '"') }}</span>"</h2>
                @else
                    <h2 class="text-left my-3">No result found for search key "<span class="font-weight-bold">{{ trim(request()->query('search'), '"') }}</span>"</h2>
                @endif;

                <div class="d-flex flex-column">
                    @foreach ($certificates as $certificate)
                        @if($certificate['ad'] == true)
                            <div class="ad-image-container mb-3">
                                <a href="{{$certificate['landingPage']}}" target="_blank"><img class="ad-image image-responsive w-50" src="{{$certificate['url']}}" alt="Ontario construction news"></a>
                            </div>
                        @else
                            @if(isset( $certificate['title'] ) && $certificate['link'])
                                <div class="search-result card flex-fill m-2 d-flex">
                                    <div class="card-header flex-center flex-column col-md-3">
                                        <a href="{{$certificate['link']}}" target="_blank">{{$certificate['title']}}</a>
                                        
                                        @if(isset($certificate['date_of_publish']))
                                        <p class="date-published">{{$certificate['date_of_publish']}}</p>
                                        @endif
                                    </div>
                                    <div class="card-body col-md-8 text-left">
                                        @if(isset($certificate['site']))
                                            <p><span class="font-weight-bold">Publication:</span> {{$certificate['site']}}</p>
                                        @endif

                                        {{-- @if(isset($certificate['contractor']))
                                        <p><span class="font-weight-bold">Contractor:</span> {{$certificate['contractor']}}</p>
                                        @endif  --}}

                                        {{-- @if(isset($certificate['owner']))
                                        <p><span class="font-weight-bold">Owner:</span> {{$certificate['owner']}}</p>
                                        @endif --}}

                                        @if(isset($certificate['owner_data']))
                                            @foreach ($certificate['owner_data'] as $o_data)
                                                <p><span class="font-weight-bold">{{$o_data['title']}}:</span> {{$o_data['data']}}</p>
                                            @endforeach
                                        @endif

                                        @if(isset($certificate['location']))
                                        <p><span class="font-weight-bold">Location of premises:</span> {{$certificate['location']}}</p>
                                        @endif
                                        
                                    </div>
                                    <div class="card-footer flex-center">
                                        <a href="{{$certificate['link']}}" class="btn btn-primary" target="_blank">View</a>
                                        {{-- @if(isset($certificate['date_of_publish']))
                                        <p><span class="font-weight-bold">Date published:</span> {{$certificate['date_of_publish']}}</p>
                                        @else
                                        <p>-</p>
                                        @endif --}}
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>

            @if($totalResult > 0)
                <div class="pagination-pn my-5">
                    @if($pagination['page']>1)
                        <a href="{{$pagination['previousPageLink']}}" class="btn btn-primary mr-auto">Previous Page<a>
                    @else
                        <a href="#" class="btn btn-primary mr-auto disabled" disabled>Previous Page<a>
                    @endif
                    <a href="#" class="btn btn-primary-outline"><strong>Page</strong>: {{$pagination['page']}}<a>
                    <a href="{{$pagination['nextPageLink']}}" class="btn btn-primary ml-auto">Next Page<a>

                    {{-- <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            @if($pagination['page']>1)
                            <li class="page-item">
                                <a class="page-link" href="{{$pagination['previousPageLink']}}" tabindex="-1">Previous</a>
                                <li class="page-item"><a class="page-link" href="{{$pagination['pageOne']}}">{{$pagination['pageOneVal']}}</a></li>
                            </li>
                            @else
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                            @endif
                            <li class="page-item"><a class="page-link" href="#">{{$pagination['page']}}</a></li>
                            <li class="page-item"><a class="page-link" href="{{$pagination['nextPageLink']}}">...</a></li>
                            <li class="page-item"><a class="page-link" href="{{$pagination['nPlusTwo']}}">{{$pagination['nPlusTwoVal']}}</a></li>
                            <li class="page-item">
                                <a class="page-link" href="{{$pagination['nextPageLink']}}">Next</a>
                            </li>
                        </ul>
                    </nav> --}}
                </div>
            @endif
            <div class="my-5"></div>
        </div>
    </div>

@endsection
