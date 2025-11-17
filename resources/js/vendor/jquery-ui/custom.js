$(function () {
  // Initialize inline jQuery UI Datepicker
  $("#datepicker").datepicker();

  // Hide loader and show the datepicker container
  $("#datepicker-loader").addClass("d-none");
  $("#datepicker").removeClass("d-none");
});
