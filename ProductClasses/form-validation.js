$(function() {
  $.validator.addMethod("phoneA", function(phone_number, element) {
    return this.optional(element) || phone_number.match(/^\d{3}-\d{7}$/); 
  }, "Please specify a valid phone number in the format xxx-xxxxxxx.");

  $("#registration").validate({
    rules: {
      name: {
        required: true,
        minlength: 5
      },
      address: {
        required: true
      },
      phone: {
        required: true,
        phoneA: true
      },
      email: {
        required: true,
        email: true
      },
      payment: {
        required: true
      },
      tos: {
        required: true
      }
    },
    messages: {
      name: {
        required: "Please enter your name.",
        minlength: "Name must be at least 5 characters."
      },
      address: "Please enter your address.",
      phone: {
        required: "Please enter your phone number."
      },
      email: {
        required: "Please enter your email address.",
        email: "Please enter a valid email address."
      },
      payment: "Please select a payment method.",
      tos: "Please accept the terms and conditions."
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
