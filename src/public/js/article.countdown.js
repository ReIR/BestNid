jQuery(function($){
  var end = $("#endDateIn").html();
  $("#endTime").countdown(end, function(event) {
    $(this).text(
      event.strftime('%D días')
    );
  });
  $("#endDate").html((new Date(end)).toLocaleDateString());
});
