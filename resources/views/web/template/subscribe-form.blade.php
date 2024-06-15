<style>
.loader1 {
   display:inline-block;
   font-size:0px;
   padding:0px;
}
.loader1 span {
   vertical-align:middle;
   border-radius:100%;
   
   display:inline-block;
   width:10px;
   height:10px;
   margin:3px 2px;
   -webkit-animation:loader1 0.8s linear infinite alternate;
   animation:loader1 0.8s linear infinite alternate;
}
.loader1 span:nth-child(1) {
   -webkit-animation-delay:-1s;
   animation-delay:-1s;
  background:#e8f0fe;
}
.loader1 span:nth-child(2) {
   -webkit-animation-delay:-0.8s;
   animation-delay:-0.8s;
  background:#e8f0fe;
}
.loader1 span:nth-child(3) {
   -webkit-animation-delay:-0.26666s;
   animation-delay:-0.26666s;
  background:#e8f0fe;
}
.loader1 span:nth-child(4) {
   -webkit-animation-delay:-0.8s;
   animation-delay:-0.8s;
  background:#e8f0fe;
  
}
.loader1 span:nth-child(5) {
   -webkit-animation-delay:-1s;
   animation-delay:-1s;
  background:#e8f0fe;
}

@keyframes loader1 {
   from {transform: scale(0, 0);}
   to {transform: scale(1, 1);}
}
@-webkit-keyframes loader1 {
   from {-webkit-transform: scale(0, 0);}
   to {-webkit-transform: scale(1, 1);}
}

.success_alert{
    background: #3ccd32;
    border-radius: 3px;
    padding: 9px 15px;
    margin-bottom: 7px;
}
.error_alert{
    background: #da4d49;
    border-radius: 3px;
    padding: 9px 15px;
    margin-bottom: 7px;
}
</style>

<!-- Template  -->
<div id="status"></div>
<form id="subscribeFrom">
@csrf
@method('post')
  <div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Name">
  </div>
  <div class="form-group">
    <input type="email" class="form-control" name="email" placeholder="Email">
  </div>
  <button id="mailWizzSubscribe" class="btn btn-danger w-100 d-flex justify-content-center align-items-center">Subscribe <span id="subscribeLoader"></span></button>
</form>


<!-- Ajac Submit Scripts  -->
<script>
$("#subscribeFrom").validate({
  rules: {
    name: {
        required: true
    },
    email: {
        required: true
    }
  },
  submitHandler: function(form) {
    
    $('#mailWizzSubscribe').attr('disabled', true);

    var formData = new FormData(form);
    $("#subscribeLoader").prepend('<div class="d-flex justify-content-center ml-3"><div class="loader1"><span></span><span></span><span></span><span></span><span></span></div></div>');
    $.ajax({
        url: "<?php echo asset('') ?>subscribe",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        data: formData,
        dataType: "json",
        success: function(data) {
            $("#status").fadeIn().html('<div class="success_alert">Successfully Subscribed</div>');
                setTimeout(function(){ 
                    jQuery("#status").fadeOut();
                }, 4000);
            $("#subscribeFrom")[0].reset();
            $("#subscribeLoader").empty();
            $('#mailWizzSubscribe').removeAttr('disabled');
        },
        error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            $("#status").fadeIn().html('<div class="error_alert">'+ err.error +'</div>');
                setTimeout(function(){ 
                    jQuery("#status").fadeOut();
                }, 4000);
            $("#subscribeLoader").empty();
            $('#mailWizzSubscribe').removeAttr('disabled');
        },
        cache: false,
        contentType: false,
        processData: false
    });
    return false;
  }
});

</script>