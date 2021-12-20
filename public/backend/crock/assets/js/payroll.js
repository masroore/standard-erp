function handlepercent(checkbox) {

    var add = 0;
    var deduct = 0;

    // If salary_type is salary which value is 2, then make taxmanager checkbox unchecked


    $(".addamount").each(function() {

        var value = this.value;
        isNaN(value) || 0 == value.length || (add += parseFloat(value))

    });
    $(".deducamount").each(function() {

        var value = this.value;
        isNaN(value) || 0 == value.length || (deduct += parseFloat(value))

    });

    if (add != 0 || deduct != 0) {
        alert('All addition and deduction open amount should be empty!');

        // If add/deduct available then if again checked/unchecked the checkbox, it will remain to it's same checked or unchecked state
        if (checkbox.checked == true) {
            document.getElementById("ispercentage").checked = false;
        } else {
            document.getElementById("ispercentage").checked = true;
        }

    } else {

        if (checkbox.checked == true) {
            document.getElementById('ispercentage').value = 1;
            $(".percent").show();
        } else {
            document.getElementById('ispercentage').value = 0;
            $(".percent").hide();
        }
    }



}

function salarySetupsummary() {

    var ispercentage = $('#ispercentage').val();

    var addper = 0;
    var b = parseInt($('#basic').val());
    var add = 0;
    var deduct = 0;

    if (ispercentage == "1") {

        $(".addamount").each(function() {
            // alert(ispercentage);

            isNaN(this.value) || 0 == this.value.length || (addper += parseFloat(this.value))
        });
        if (addper > 100) {
            alert('You Can Not input more than 100%');
        }

        $(".addamount").each(function() {
            var value = this.value;
            var basic = parseInt($('#basic').val());
            isNaN(value * basic / 100) || 0 == (value * basic / 100).length || (add += parseFloat(value * basic / 100))
        });
        $(".deducamount").each(function() {
            var value = this.value;
            var basic = parseInt($('#basic').val());
            isNaN(value * basic / 100) || 0 == (value * basic / 100).length || (deduct += parseFloat(value * basic / 100))
        });

    } else {

        $(".addamount").each(function() {
            var value = this.value;
            // alert(value);
            var basic = parseInt($('#basic').val());
            isNaN(value) || 0 == value.length || (add += parseFloat(value))
        });
        $(".deducamount").each(function() {
            var value = this.value;
            var basic = parseInt($('#basic').val());
            isNaN(value) || 0 == value.length || (deduct += parseFloat(value))
        });

    }


    document.getElementById('grsalary').value = (add + b - (deduct)).toFixed(2);
}