$(function() {
  $('.check-all').on('click', function() {
    $('.checkboxes input:checkbox').prop('checked', true);
  });
  $('.uncheck-all').on('click', function() {
    $('.checkboxes input:checkbox').prop('checked', false);
  });
});