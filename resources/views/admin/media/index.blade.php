@extends('layouts.app', ['activePage' => 'media', 'titlePage' => __('Media')])

@section('content')
<link href="{{ asset('media-library') }}/mini-file-upload/css/style.css" rel="stylesheet" />
<style>
select {
    -webkit-appearance: checkbox; ;
    -moz-appearance: checkbox;
    text-indent: 1px;
    text-overflow: '';
}
.media-box {
    height: 350px!important;
    overflow-y: scroll;
}
</style>

<div class="content">
    <div class="container-fluid">
      <div class="row">
	  <div class="col-md-12">
 <!-- <div class="modal" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered my-dialog dialog-fullscreen" role="document"> -->
        <div class="modal-content h-100">
        <div class="modal-header my-modal-header bg-dark">
            <div class="nav-tabs-navigation  w-100">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                            <a class="nav-link">Media:</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#upload-tab" data-toggle="tab">
                            <i class="material-icons">publish</i> Upload
                            <div class="ripple-container"></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-dark nav-link-media-library" href="#gallery-tab" data-toggle="tab">
                            <i class="material-icons">collections</i> Gallery
                            <div class="ripple-container"></div>
                            </a>
                        </li>
                      
                    </ul>
                    
                </div>
            </div>
        </div>
        <div class="modal-body">
            <div class="tab-content">
            <div class="tab-pane" id="upload-tab">
                <form id="upload" method="post" action="{{ route('upload.media') }}"  enctype="multipart/form-data">
                @csrf
                    @method('post')
                    <input type="hidden" name="attachment_type" class="media-modal-attachment-type">
                    <div id="drop" class="media-drop-zone">
                    <a>
                    <div class="upload-btn">
                    <svg width="50" enable-background="new 0 0 512 512" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                    <rect x="231.23" y="116.59" width="49.548" height="247.59" fill="#56545A"/>
                    <g fill="#88888F">
                    <polygon points="135.6 132.74 376.39 132.74 256.01 12.387"/>
                    <polygon points="512 499.61 0 499.61 0 243.61 49.548 243.61 49.548 450.06 462.45 450.06 462.45 243.61 512 243.61"/>
                    </g>
                    <g fill="#56545A">
                    <polygon points="256 132.74 376.39 132.74 256.01 12.387 256 12.397"/>
                    <polygon points="462.45 243.61 462.45 450.06 256 450.06 256 499.61 512 499.61 512 243.61"/>
                    </g>
                    </svg>
                    </div>
                    </a>
                    <h5>Drag and drop file if you want to upload.</h5>
                    <span class="text-muted">Allowed file types: jpg, jpeg, png, gif, pdf, doc, ppt, odt, pptx, docx, pps, ppsx, xls, xlsx, key, asc.</span>
                        <input type="file" name="upl" multiple />
                    </div>
                </form>
            </div>
            <div class="tab-pane active" id="gallery-tab">
                <div class="row">
                    <div class="col-lg-9 col-12 border-right">
                        <div class="row media-box media-file-container">
                        </div>
                        <div class="text-center"><button id="media-load-more" class="btn btn-primary btn-sm"> {{ __('Load More') }}</button></div>
                    </div>
                    <div class="col-lg-3 d-xs-none">
                        <div class="imageDescription w-100 h-100"></div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-0">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Select</button>
                </div>
            </div>
            </div>
        </div>
        </div>
    <!-- </div>
</div> -->

        </div>
        </div>
    </div>
</div>

<!-- jQuery File Upload Dependencies -->
<script src="{{ asset('media-library/mini-file-upload/js') }}/jquery.ui.widget.js"></script>
<script src="{{ asset('media-library/mini-file-upload/js') }}/jquery.iframe-transport.js"></script>
<script src="{{ asset('media-library/mini-file-upload/js') }}/jquery.fileupload.js"></script>

<!-- Our main JS file -->
<script src="{{ asset('media-library/mini-file-upload/js') }}/script.js"></script>

<script>

var media_multi_select = false;
var media_loading = false;
var media_selected_items = [];
var media_selected_size = [];
var mediaAPI = "{{route('media.all', 'thumbnail')}}";
// var mediaAPIDup = mediaAPI;

function setAttachmentType($type){
    $(".media-modal-attachment-type").val($type);
  }
setAttachmentType('image');

function setAllowMultiple($allow){
    setAllowMultiple = $allow;
}

$(function(){

var uploaded_file_container = $('.media-file-container');



$('#drop a').click(function(){
    // Simulate a click on the file input button
    // to show the file browser dialog
    $(this).parent().find('input').click();
});

// Initialize the jQuery File Upload plugin
$('#upload').fileupload({

    // This element will accept file drag/drop uploading
    dropZone: $('#drop'),

    // This function is called when a file is added to the queue;
    // either via the browse button, or via drag/drop:
    add: function (e, data) {

        var tpl =$('<div class="col-lg-3 col-4 mb-3" id="column_1">\
                        <div class="custom-checkbox pointer image-attachment" data-media-id="">\
                        <div class="thumbnail"> \
                            <img class="img-fluid" src="https://cynthiarenee.com/wp-content/uploads/2018/11/placeholder-product-image.png" data-id="1"> \
                            <div class="progress"> \
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> \
                            </div> \
                          </div> \
                          <div class="sel-stat"> \
                            <div class="sel-stat-inner"> \
                              <i class="material-icons">check</i> \
                            </div> \
                          </div> \
                        </div>\
                    </div>');
                    
        // Add the HTML to the Div element
        data.context = tpl.prependTo(uploaded_file_container);

        // Automatically upload the file once it is added to the queue
        var jqXHR = data.submit();

    },

    progress: function(e, data){
        // Calculate the completion percentage of the upload
        var progress = parseInt(data.loaded / data.total * 100, 10);
        data.context.find('.progress-bar').attr('aria-valuenow', progress);
        data.context.find('.progress-bar').css('width', progress + "%");
        data.context.find("img").attr('class','w-100 h-100');

        if(progress == 100){
          data.context.find('.progress-bar').addClass("progress-bar-animated");
        }

        $('.nav-link-media-library').trigger('click');
        
    },

    done: function (e, data) {
        $.each(data.files, function (index, file) {
        //  console.log(JSON.stringify(data.result));
         
          if(data.result.success){
            data.context.find("img").attr('src',data.result.data.thumbnail.url);
            data.context.find(".image-attachment").attr('data-media-id', data.result.data.media_id);
            data.context.find(".progress").hide();
          }
          else{
            alert('Upload error, please retry.');
          }
        });
    },

    fail:function(e, data){
        // Something has gone wrong!
        data.context.addClass('error');
    }

});


// Prevent the default action when a file is dropped on the window
$(document).on('drop dragover', function (e) {
    e.preventDefault();
});

// Helper function that formats the file sizes
function formatFileSize(bytes) {
    if (typeof bytes !== 'number') {
        return '';
    }

    if (bytes >= 1000000000) {
        return (bytes / 1000000000).toFixed(2) + ' GB';
    }

    if (bytes >= 1000000) {
        return (bytes / 1000000).toFixed(2) + ' MB';
    }

    return (bytes / 1000).toFixed(2) + ' KB';
}

});

$(function(e){

$(document).on('click', '.image-attachment', function(e){

  var media_item_id = $(this).attr('data-media-id');

  if(!media_selected_items.includes(media_item_id)){


    if(media_multi_select){

      media_selected_items.push(media_item_id);
    }
    else{
      $(".sel-stat").hide();
      media_selected_items = [];
      media_selected_items.push(media_item_id);
    }

    $(this).children(".sel-stat").toggle();

  }
  else{      
    const index = media_selected_items.indexOf(media_item_id);
    if (index > -1) {
      media_selected_items.splice(index, 1);
    }
    $(this).children(".sel-stat").toggle();
  }

  getItemDescription(media_selected_items)

});

    loadMedia();

    $('#media-load-more').click(function(e){

        if(!media_loading){

            loadMedia();

        }

    });

});

function loadMedia(){

  media_loading = true;
  $.getJSON(mediaAPI)
    .done(function( response ) {

	if(response.data.length != 0){

		$.each( response.data, function( key, item ) {

			var image_url = '';
		
			if(item.children[0]){
			image_url = item.children[0].url;
			}
			else{
			image_url = item.url;
			}
			
			var tpl =$('<div class="col-lg-3 col-4 mb-3" id="column_'+item.id+'">\
                            <div class="custom-checkbox pointer image-attachment" data-media-id="' + item.id +'">\
                            <div class="thumbnail"> \
								<img class="img-fluid" src="'+ image_url +'"> \
							</div> \
							<div class="sel-stat"> \
								<div class="sel-stat-inner"> \
								<i class="material-icons">check</i> \
								</div> \
							</div> \
                            </div>\
                        </div>');
           
		
			$('.media-file-container').append(tpl);

			if(response.current_page >= response.last_page){
				$('#media-load-more').hide();           
			}
			else{
				mediaAPI = response.next_page_url;
			}
		});

	}else{
		$('#media-load-more').hide();   
	}
      media_loading = false;
    });
}

function getItemDescription(id){
		$(".imageDescription").empty();
		$(".imageDescription").append('<div class="w-100 h-100 d-flex justify-content-center align-items-center"><div class="loader1"><span></span><span></span><span></span><span></span><span></span></div></div>');
		if(id.length != 0){
			$.ajax({
				type: 'GET',
				url: "<?php echo asset('')?>"+"admin/media/get-item/"+id,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data:  '',
				dataType: "json",
				success: function(data) {
                    
                $(".imageDescription").empty();

                var optionString='<h6 class="text-muted text-capitalize">ATTACHMENT DETAILS</h6>\
                                <span>'+data.name+'</span> <br>\
                                <small class="text-muted">'+moment(data.created_at).format('MMMM DD , YYYY')+'<br>\
                                <small class="text-muted">'+data.width+' by '+data.height+' pixels</small> <br>';
                    optionString += '<a href="#" class="text-danger" onClick="deleteImage('+data.id+')"><u>Delete Permanently</u></a><br>';
                    optionString +='<span   span class="font-weight-bold">Image Url: </span><br>\
                                    <div class="form-group">\
                                        <select onChange="displayImageSize(this)" class="p-2 h-25" style="font-size: .8rem;" id="imageSize">\
                                        <option   option tion selected value="'+data.id+'">DEFAULT ('+data.width+'x'+data.height+')</option>';
                                        $.each(data.children, function(i, child) {
                                            optionString += '<option value="'+child.id+'">'+child.image_size.toUpperCase().replace(/_/g, ' ')+'('+child.width+'x'+child.height+')</option>';
                                        });
                    optionString += '</select>\
                                    </div>\
                                    <div id="newUrl" style="overflow:hidden;"></div>\
                                    <div id="defaultUrl" style="overflow:hidden;">\
                                    <a target="_blank" href="{{Request::root()}}'+data.url+'"><u>{{Request::root()}}'+data.url+'</u></a></span> <br>\
                                    </div>';
				let option = $(optionString);
                $('.imageDescription').append(option);
				},
				error: function(data){
					alert('error');
				}
			});
		}else{
            $(".imageDescription").empty();
		}
  }
    function displayImageSize(object){
		$('#defaultUrl').empty();
		$('#newUrl').empty();
        var id = $(object).val();
        media_selected_size= [];
        $.ajax({
            type: 'GET',
				url: "<?php echo asset('')?>"+"admin/media/get-item/"+id,
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data:  '',
				dataType: "json",
				success: function(data) 
                {
                    // console.log(data);
                    media_selected_size.push(data.image_size);
                    $('#newUrl').append('<a target="_blank" href="{{Request::root()}}'+data.url+'"><u>{{Request::root()}}'+data.url+'</u></a></span> <br>');
                }
            });

        
	}

    function deleteImage(id){

        if(confirm('Are you sure want to delete this media?')){
            $.ajax({
                url: "<?php echo asset('') ?>admin/delete_image/"+id,
                type: 'POST',
                data: {
                "_token": "{{ csrf_token() }}",
                "id": id
                },
                success: function ()
                {
                    $('#column_'+id).remove();
                    $(".imageDescription").empty();
                }
            });
        }else{
            console.log("You are not able to delete this media.")
        }
		
    };


</script>
@endsection