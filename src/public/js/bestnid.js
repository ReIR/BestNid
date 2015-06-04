jQuery(function($){

  $('#questions-button').click(function(){
    if ( $('#questions').hasClass('hidden') ) {
      $('#questions').removeClass('hidden')
    } else {
      $('#questions').addClass('hidden')
    }
  })
});
