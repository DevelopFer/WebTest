$(document).ready(function(){
    console.log("XD");
    var selects = $('.select2');
    $.each(selects,() => {
        $(this).select2();
    });
});