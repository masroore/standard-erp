// Flatpickr

var f1 = flatpickr(document.getElementById('basicFlatpickr'));
var b1 = flatpickr(document.getElementsByClassName('basicDate'));
var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
});
var f3 = flatpickr(document.getElementById('rangeCalendarFlatpickr'), {
    mode: "range",
});
var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    defaultDate: "13:45"
});

var f5 = flatpickr(document.getElementById('basicFlatpickr1'));
var f6 = flatpickr(document.getElementById('basicFlatpickr2'));

