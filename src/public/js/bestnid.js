jQuery(function($){

  $('#questions-button').click(function(){
    if ( $('#questions').hasClass('hidden') ) {
      $('#questions').removeClass('hidden')
    } else {
      $('#questions').addClass('hidden')
    }
  });

  $('#uploadImage').change(function(){
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("uploadPreview").src = oFREvent.target.result;
    };

    $(".uploadField").attr('data-content','Cambiar');

    $("#uploadPreview").fadeIn(500);
  });

});
