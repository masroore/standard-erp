<script>
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='requisitions']").validate({
    // Specify validation rules
    rules: {
      reference_no: "required",
      date: "required",

      document: {
        required: false,
        accept: "application/pdf,image/jpeg,image/png,text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        }


    },
    // Specify validation error messages
    messages: {
        reference_no: "Please enter your Code",
        date: "Please enter your date",
        document: "Document must be pdf,xls,xlsx,jpeg,jpg,png",

    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
