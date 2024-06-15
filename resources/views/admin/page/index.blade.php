@extends('layouts.app', ['activePage' => 'page', 'titlePage' => __('Pages')])

@section('content')

  <div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('All Pages') }}</h4>
                <p class="card-category"></p>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row mb-2">
                            <form class="w-25" id="bulk-action-form" method="post" action="{{ route('admin.page.bulkaction') }}" autocomplete="off" class="form-horizontal">
                                @csrf
                                @method('post')
                                <div class="d-flex mr-5">
                                    <div class="col d-flex align-items-center">
                                        <select id="bulk_action" name="bulk_action" data-style="btn-outline-secondary rounded-0 p-2 ml-2"  data-width="fit" class="selectpicker">
                                            <option value="" selected>Bulk Action</option>
                                            <option value="draft">Move to Draft</option>
                                            <option value="published">Publish</option>
                                            <option value="delete">Delete</option>
                                        </select>
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <input type="submit" name="submit" onClick="return BulkActionConfirm()" value="Apply" placeholder="Apply" class="btn btn-sm btn-danger">
                                    </div>
                                </div>
                            </form>

                            <form class="w-50" id="search-form" method="get" action="{{ route('page.index') }}" autocomplete="off" class="form-horizontal">
                                @csrf
                                @method('get')
                                <div class="d-flex">
                                    <div class="col-auto d-flex align-items-center">
                                        <input type="text" name="search" value="{{ app('request')->input('search') }}" placeholder="Search" class="form-control h-75 rounded">
                                    </div>

                                    <div class="col d-flex align-items-center">
                                        <select id="post_status" name="post_status" form="search-form" data-style="btn-outline-secondary rounded-0 p-2 ml-2"  data-width="fit" class="selectpicker">
                                            <option value="" selected>Post Status</option>
                                            @foreach ($post_statuses as $key => $post_status)
                                                @if (app('request')->input('post_status') == $key)
                                                    <option value="{{$key}}" selected>{{$post_status}}</option>
                                                @else
                                                    <option value="{{$key}}">{{$post_status}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col d-flex align-items-center">                                
                                        <input type="submit" name="submit" value="Filter" placeholder="Filter" class="btn btn-sm btn-info">
                                    </div>
                                </div>
                            </form>

                            <div class="col text-right w-25">
                                <a href="{{ route('page.index') }}" class="btn btn-sm btn-primary">{{ __('All page') }}</a>
                                <a href="{{ route('page.create') }}" class="btn btn-sm btn-success">{{ __('New page') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table post-table">
                            <thead class="text-primary">
                                <th class="text-right">
                                  <div class="custom-control custom-checkbox">
                                    <input type="checkbox" 
                                    class="custom-control-input" 
                                    id="check_box_bulk_action_select_all" 
                                    type="checkbox" 
                                    >
                                    <label class="custom-control-label" for="check_box_bulk_action_select_all">#</label>
                                  </div>
                                </th>
                                <th class="text-left">
                                	<small>Title</small>   
                                </th>
                                <th class="text-left">
									                <small>Post Status</small>   
                                </th>
                                <th class="text-left">
									                <small>Date Published</small>   
                                </th>
                                <th class="text-left">
								                	<small>Last Updated</small>   
                                </th>
                                <th class="text-right">
									                <small>Actions</small>   
                                </th>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr class="{{ $post->post_status == 'draft' || $post->post_status == 'scheduled' ? 'bg-light' : ''}}">
                                    <td class="text-right">
                                      <div class="custom-control custom-checkbox">
                                        <input type="checkbox" 
                                        form="bulk-action-form"
                                        class="custom-control-input check_box_bulk_action" 
                                        id="check_box_bulk_action-{{$post->id}}" 
                                        type="checkbox" 
                                        value="{{$post->id}}" 
                                        name="check_box_bulk_action[]"
                                        >
                                        <label class="custom-control-label" for="check_box_bulk_action-{{$post->id}}">{{ ++$loop->index }}</label>
                                      </div>
                                    </td>

                                    <td>
                                      @if($post->slug)
                                        <a target="_blank" href="">{{ $post->post_title }}</a>
                                      @else
                                      {{ $post->post_title }}
                                      @endif
                                    </td>

                                    <td class="text-left">
                                      {{ Config::get('custom.post.post_statuses')[$post->post_status] }}
                                    </td>

                                    <td class="text-left">
                                      {{ $post->created_at }}
                                    </td>

                                    <td class="text-left">
                                      {{ $post->updated_at }}
                                    </td>
                                
                                    <td class="td-actions text-right">
                                      <form action="{{ route('page.destroy', $post->id) }}" method="post">
                                      @csrf
                                      @method('delete')
                                        @if($post->post_status == 'published')
                                          @if($post->slug)
                                          <a rel="tooltip" target="_blank" class="btn btn-info text-white btn-sm" href="{{ route('page-layout', $post->slug) }}" data-original-title="" title="Veiw">
                                            <small>View</small>
                                          </a>
                                          @endif
                                        @endif
                                          <a rel="tooltip" class="btn btn-success text-white" href="{{ route('page.edit', $post) }}" data-original-title="" title="Edit">
                                          <i class="material-icons">edit</i>
                                          <div class="ripple-container"></div>
                                          </a>
                                          <button rel="tooltip" class="btn btn-danger text-white" onClick="return DeleteConfirm()" data-original-title="" title="Delete">
                                          <i class="material-icons">close</i>
                                          <div class="ripple-container"></div>
                                          </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function DeleteConfirm(){

    return confirm('Are you sure you want to delete this item?');

}

function BulkActionConfirm(){

    return confirm('Are you sure you want to do this bulk action? Be careful, Some action can\'t be reverted.');

}

$(function(){
    $("#check_box_bulk_action_select_all").click(function () {
        $(".check_box_bulk_action").prop('checked', $(this).prop('checked'));
    });    
});


</script>
@endsection