jQuery(function($){
  var end = $("#endDateIn").html();
  var endDate = new Date(end);
  var endDateUTC = new Date(endDate.getTime() + endDate.getTimezoneOffset() * 60000);
  var tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
  var today = new Date();
  if (endDateUTC > tomorrow) {
    $("#endTime").countdown(end, function(event) {
      $(this).text(
        event.strftime('%-D días')
      );
    });
  } else {
    if ( new Date(endDateUTC - today).getHours() < 24) {
      $("#endTime").html("Mañana");
    } else {
      $("#endTime").html("Ya venció");
    }
  }
  $("#endDate").html(endDateUTC.toLocaleDateString());
});
