jQuery(function($){
  var end = $("#endDateIn").html();
  var endDate = new Date(end);
  var tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
  var today = new Date();
  if (endDate > tomorrow) {
    $("#endTime").countdown(end, function(event) {
      $(this).text(
        event.strftime('%-D días')
      );
    });
  } else {
    if ( (endDate - 1) == today ) {
      $("#endTime").html("Mañana");
    } else {
      $("#endTime").html("Ya venció");
    }
  }
  $("#endDate").html(endDate.toLocaleDateString());
});
