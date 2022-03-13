<script>
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='bank']").validate({
    // Specify validation rules
    rules: {
        title_en: "required",

    },
    // Specify validation error messages
    messages: {
        title_en: 'Please enter Bank name',

    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});

</script>
