// Submit the contact form and show success
$('html').on('submit', '#albright-contact-form', function(){
  $('#albright-contact-form button').addClass('loading').attr('disabled',true);
  $.request('onSendContactForm', {
    data: {
      name:    $('input[name="name"]').val(),
      email:   $('input[name="email"]').val(),
      phone:   $('input[name="phone"]').val(),
      message: $('textarea[name="message"]').val(),
    },
    loading: $.oc.stripeLoadIndicator.show(),
    complete: function() {
      $.oc.stripeLoadIndicator.hide();
      $('#albright-contact-form button').removeClass('loading').attr('disabled',false);
    },
    success: function(data) {
      this.success(data);
      $('input[name="name"], input[name="email"], input[name="phone"], textarea[name="message"]').val('');
      $('.form-before-success').animate({'opacity':0}, 400, function(){
        $(this).slideUp(400);
        $('.form-after-success').slideDown(400, function(){
          $('.form-after-success').animate({'opacity':1}, 400);
        });
      });
    }
  });
  return false;
});
