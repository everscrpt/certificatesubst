$ = window.jQuery;

var url = new URL(window.location.href);
var param = url.searchParams.get("dateBetween");

if (param != null) {
  var dateArr = param.split(" - ");
  var start = window.moment(dateArr[0],'DD/MM/YYYY');
  var end = window.moment(dateArr[1],'DD/MM/YYYY');
}
else{
  var start = window.moment().subtract(29, 'days');
  var end = window.moment();
}

$('#dateRangeStart').datepicker({
  format: "dd/mm/yyyy"
});

$('#dateRangeEnd').datepicker({
  format: "dd/mm/yyyy"
});

// function cb(start, end) {
//   $('#dateRangeSelector').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
// }

// $('.dateRangeSelector').daterangepicker({
//     startDate: start,
//     endDate: end,
//     ranges: {
//         'Today': [moment(), moment()],
//         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
//         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//         'This Month': [moment().startOf('month'), moment().endOf('month')],
//         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
//     }
// },cb);

// cb(start, end);

// $('.dateRangeSelector').on('apply.daterangepicker', function(ev, picker) {
//     $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
// });



