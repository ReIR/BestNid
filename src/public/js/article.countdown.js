jQuery(function($){  
  var end = $("#endDateIn").html();
  $("#endDate").countdown(end, function(event) {
    $(this).text(
      event.strftime('%D días %H horas %M minutos')
    );
  });
})
