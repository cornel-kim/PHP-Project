$(document).ready(function() {

  $('#myforms').submit(function(e) {
    e.preventDefault();
    var username = $('#username').val();
    var s_name = $('#s_name').val();
    var email = $('#email').val();
    var dateofbirth = $('#dateofbirth').val();
    
    var password = $('#password').val();

    $(".error").remove();

    if (username.length < 1) {
      $('#username').after('<span class="error">This field is required</span>');
    }
    if (surname.length < 1) {
      $('#s_name').after('<span class="error">This field is required</span>');
    }
    if (email.length < 1) {
      $('#email').after('<span class="error">This field is required</span>');
    } else {
      var regEx = /^[A-Z0-9][A-Z0-9._%+-]{0,63}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/;
      var validEmail = regEx.test(email);
      if (!validEmail) {
        $('#email').after('<span class="error">Enter a valid email</span>');
      }
    }
    if (dateofbirth.length < 1) {
      $('#dateofbirth').after('<span class="error">This field is required</span>');
    }
    if (password.length < 5) {
      $('#password').after('<span class="error">Password must be at least 8 characters long</span>');
    }
  });
});
