@extends('layouts.app', ['activePage' => 'menu', 'item' => 'Menus', 'titlePage' => __('Menu')])

@section('content')

  <div class="content">
    <div class="container-fluid">
		<div class="card">
			<div class="card-body">
				{!! Menu::render() !!}

				{!! Menu::scripts() !!}
			</div>
		</div>
    </div>
</div>
@endsection