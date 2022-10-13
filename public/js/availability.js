$( function() {
    $( "#date" ).datepicker({
        dateFormat: "yy-mm-dd",
        autoclose: true,
        changeMonth: true,
        changeYear: true,
        minDate: '0D',
        });
    } );
    $("#date").keypress(function (e) {
        return false;
    });
    $("#date").keydown(function (e) {
        return false;
    });

// let enabledays = ["2022-10-13", "2022-10-15"];
//         function enableTheseDays(date){
//                 let sdate = $.datepicker.formatDate( 'yy-mm-dd', date)
//                 if($.inArray(sdate, enabledays) != -1){
//                     return [true];
//                 }else{
//                     return [false];
//                 }
//         }
//         $( function() {
//             $("#date").datepicker({
//                 dateFormat: "yy-mm-dd",
//                 beforeShowDay:enableTheseDays
//             })
// })
// function error_handling(att_name, errormessage){
//     if(!errormessage){
//         $("#" + att_name)
//             .removeClass('is-invalid')
//             .text('')
//         $("." + att_name).text('')
//     }
//     else{
//         $("#" + att_name)
//         .addClass('is-invalid')
//         $("." + att_name).text(errormessage)
//     }
// }
//   $( function() {
//             $( "#date" ).datepicker({
//                 dateFormat: "yy-mm-dd",
//                 autoclose: true,
//                 changeMonth: true,
//                 changeYear: true,
//                 minDate: '1D',
//                 });
//             } );
//             $("#date").keypress(function (e) {
//                 return false;
//             });
//             $("#date").keydown(function (e) {
//                 return false;
//             });
// $(".submitdate").on('submit', function(e){
//     e.preventDefault();
//     let btn = document.getElementById('submitdata');
//     btn.innerHTML = "Loading...";
//     $.ajax({
//         url:'/date',
//         method:'POST',
//         data:new FormData(this),
//         processData:false,
//         dataType:'json',
//         contentType:false,
//         success:function(data){
//             if(data.status == 400){
//                 error_handling('date', data.messages.date)
//                 error_handling('starttime', data.messages.starttime)
//                 error_handling('endtime', data.messages.endtime)
//                 btn.innerHTML = "Submit";
//             }
//             else if(data.status == 204){
//                 error_handling('starttime', data.messages)
//                 error_handling('endtime', '')
//                 error_handling('date', '')
//             }
//             else if(data.status == 206){
//                 error_handling('starttime', '')
//                 error_handling('endtime', '')
//                 error_handling('date',  data.messages)
//             }
//             else{
//                 $(".alert-show").show();
//                 $(".alert-messages").text('Success');
//                 let url = data.location;
//                 setInterval(function () {  
//                     location = url;
//                 }, 2000);  
//             }
//             btn.innerHTML = "Submit";
//         }
//     });
// });