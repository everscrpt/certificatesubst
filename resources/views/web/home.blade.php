@extends('layouts.website', ['activePage' => 'home', 'title' => __('Dashboard Template')])

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
                            <input name="search" type="text" class="form-control" placeholder='For exact match please enclose your search keyword with double quote, e.g. "search keyword"' aria-label='For exact match please enclose your search keyword with double quote, e.g. "search keyword"' aria-describedby="basic-addon2" required>
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
                    </div>                     --}}

                    <div class="date-selection-wrap flex-center d-flex flex-row">
                        <div class="input-group mb-3 date-selector-width mr-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                            <input id="dateRangeStart" placeholder="Start Date" type="text" name="dateStart" class="form-control dateSelector" aria-describedby="basic-addon2" required>
                        </div>

                        <div class="input-group mb-3 date-selector-width">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                            <input id="dateRangeEnd" placeholder="End Date"  type="text" name="dateEnd" class="form-control dateSelector" aria-describedby="basic-addon2" required>
                        </div>
                    </div>   
                    
                </div>
            </form>
            
            <script>
               
            </script>
        </div>
    </div>

    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-4 col-12 mb-5">
                <div class="card mx-3 h-100 d-flex justify-content-center align-items-center">
                    <a href="{{$data->section_2->grid_one->link}}" target="_blank">
                    <div class="card-body flex-center flex-column">
                        <i class="fa-3x {{$data->section_2->grid_one->icon}} "></i>
                        <h5 class="card-title my-3 text-blue">{{$data->section_2->grid_one->title}}</h5>
                        <p class="card-text">{{$data->section_2->grid_one->sub_title}}</p>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-12 mb-5">
                <div class="card mx-3 h-100 d-flex justify-content-center align-items-center">
                    <a href="{{$home_ocn->link}}" target="_blank">
                    <div class="card-body flex-center flex-column">
                        <img src="{{$home_ocn->image}}" alt="{{env('APP_URL')}}" class="w-100">
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-12 mb-5">
                <div class="card mx-3 h-100 d-flex justify-content-center align-items-center">
                    <a href="{{$data->section_2->grid_three->link}}" target="_blank">
                    <div class="card-body flex-center flex-column">
                        <i class="fa-3x {{$data->section_2->grid_three->icon}}"></i>
                        <h5 class="card-title my-3 text-blue">{{$data->section_2->grid_three->title}}</h5>
                        <p class="card-text">{{$data->section_2->grid_three->sub_title}}</p>
                    </div>
                    </a>
                </div>     
            </div>
        </div>
    </div>

    <div class="ocn-image mb-5">
        <div class="container">
            {!! $data->section_3->featured !!}
        </div>
    </div>
@endsection
