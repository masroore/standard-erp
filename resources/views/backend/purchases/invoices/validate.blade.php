<script>
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='invoice']").validate({
    // Specify validation rules
    rules: {
      reference_no: "required",
      date: "required",
      supplier_id:"required",
    },
    // Specify validation error messages
    messages: {
        reference_no: "Please enter your reference_no",
        date: "Please enter your date",
        supplier_id: "Please enter your supplier",
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
