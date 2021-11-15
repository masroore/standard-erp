var currentDate = new Date();

$('.dropify').dropify({
    messages: { 'default': 'Click to Upload Picture/Logo', 'replace': 'Upload or Drag n Drop' }
});

var f1 = flatpickr(document.getElementById('date'), {
    defaultDate: currentDate,
});



function deleteItemRow() {
    deleteItem = document.querySelectorAll('.delete-item');
    for (var i = 0; i < deleteItem.length; i++) {
        deleteItem[i].addEventListener('click', function() {
            this.parentElement.parentNode.parentNode.parentNode.remove();
        })
    }
}

function selectableDropdown(getElement, myCallback) {
    var getDropdownElement = getElement;
    for (var i = 0; i < getDropdownElement.length; i++) {
        getDropdownElement[i].addEventListener('click', function() {
            console.log(this)
            console.log(this.parentElement.parentNode.querySelector('.dropdown-toggle > .selectable-text'));
            console.log(this.parentElement);

            var dataValue = this.getAttribute('data-value');
            var dataImage = this.getAttribute('data-img-value');

            if (dataValue === null && dataImage === null) {
                console.warn('No attributes are defined. Kindly define one attribute atleast')
            }

            if (dataValue != '' && dataValue != null) {
                this.parentElement.parentNode.querySelector('.dropdown-toggle > .selectable-text').innerText = dataValue;
            }

            if (dataImage != '' && dataImage != null) {
                this.parentElement.parentNode.querySelector('.dropdown-toggle > img').setAttribute('src', dataImage);
            }

            var dropdownValues = { dropdownValue: dataValue, dropdownImage: dataImage };
            myCallback(dropdownValues);
        })
    }
}

function getTaxValue(value) {
    if (value.dropdownValue == 'Deducted') {
        console.log('I am percentage')
        document.querySelector('.tax-rate-deducted').style.display = 'block';
        document.querySelector('.tax-rate-per-item').style.display = 'none';
        document.querySelector('.tax-rate-on-total').style.display = 'none';
    } else if (value.dropdownValue == 'Per Item') {
        console.log('I am Flat Amount')
        document.querySelector('.tax-rate-deducted').style.display = 'none';
        document.querySelector('.tax-rate-per-item').style.display = 'block';
        document.querySelector('.tax-rate-on-total').style.display = 'none';
    } else if (value.dropdownValue == 'On Total') {
        console.log('I am Flat Amount')
        document.querySelector('.tax-rate-deducted').style.display = 'none';
        document.querySelector('.tax-rate-per-item').style.display = 'none';
        document.querySelector('.tax-rate-on-total').style.display = 'block';
    } else if (value.dropdownValue == 'None') {
        console.log('I am None')
        document.querySelector('.tax-rate-deducted').style.display = 'none';
        document.querySelector('.tax-rate-per-item').style.display = 'none';
        document.querySelector('.tax-rate-on-total').style.display = 'none';
    }
}

function getDiscountValue(value) {
    if (value.dropdownValue == 'Percent') {
        console.log('I am percentage')
        document.querySelector('.discount-percent').style.display = 'block';
        document.querySelector('.discount-amount').style.display = 'none';
    } else if (value.dropdownValue == 'Flat Amount') {
        console.log('I am Flat Amount')
        document.querySelector('.discount-amount').style.display = 'block';
        document.querySelector('.discount-percent').style.display = 'none';
    } else if (value.dropdownValue == 'None') {
        console.log('I am None')
        document.querySelector('.discount-percent').style.display = 'none';
        document.querySelector('.discount-amount').style.display = 'none';
    }
}

document.getElementsByClassName('additem')[0].addEventListener('click', function() {
    console.log('dfdf')

    getTableElement = document.querySelector('.item-table');
    currentIndex = getTableElement.rows.length;

    $html = ` <tr>
    <td class="delete-item-row">
        <ul class="table-controls">
            <li><a href="javascript:void(0);" class="delete-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li>
        </ul>
    </td>
    <td class="description">

        <input type="text" id="search" class=" form-control form-control-sm" placeholder="Item Description" autocomplete="off">
            <div id="content-search">

            </div>
         <textarea class="form-control" placeholder="Additional Details"></textarea></td>


    <td class="text-right " style="width:220px;"><input type="text"  id="qty"  class="form-control form-control-sm" placeholder="Quantity"></td>
    <td class="description ">
        <select class="form-control form-control-sm " id="tax" name="tax" >
           <option >select tax</option>
            @foreach ($taxes as $tax)
            <option value="{{ $tax->rate }}" >{{$tax->name . '('.$tax->rate .'%)'}}</option>
            @endforeach

          </select>



    </td>
    <td class="description">
        <div class="input-group mb-3">
            <input type="text" id="disc" class="form-control form-control-sm" placeholder="discoind">
            <div class="input-group-prepend form-controlsm">
                <div class="input-group-text" style="padding: 0;">
                  <select class="form-control form-control-sm" id="disc_type" name="disc_type" style="height: 100%;border: 0;width: 100%;padding: 0;">
                      <option>%</option>
                      <option>num</option>

                    </select>
                  </div>
              </div>
        </div>

       </td>
    <input type="hidden" id="sale_price" class="form-control form-control-sm" placeholder="">

    <td class="text-right description">
        <span class="editable-amount"><span class="currency">$</span> <span class="amount" id="amount"></span>
        <hr>
        <div>
            <button class="btn btn-warning  mb-2 mr-2 rounded-circle" id="calculat">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </button>
        </div>

    </td>

</tr>`;

    $(".item-table tbody").append($html);
    $('.basic').select2();
    deleteItemRow();


})

deleteItemRow();
selectableDropdown(document.querySelectorAll('.invoice-select .dropdown-item'));
selectableDropdown(document.querySelectorAll('.invoice-tax-select .dropdown-item'), getTaxValue);
selectableDropdown(document.querySelectorAll('.invoice-discount-select .dropdown-item'), getDiscountValue);