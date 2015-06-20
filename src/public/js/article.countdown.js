jQuery(function($){
  var end = $("#endDateIn").html();
  var endDate = new Date(end);
  var tomorrow = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
  if (endDate > tomorrow) {
    $("#endTime").countdown(end, function(event) {
      $(this).text(
        event.strftime('%D días')
      );
    });
  } else {
    $("#endTime").html("Mañana");
  }
  $("#endDate").html(endDate.toLocaleDateString());
});
