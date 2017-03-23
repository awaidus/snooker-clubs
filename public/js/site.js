
$('[data-type="datetime"]').flatpickr({
    enableTime: true
});


$('[data-type="date"]').flatpickr();


var sAlert = $("#success-alert");
sAlert.alert();
sAlert.fadeTo(2000, 500).slideUp(500, function(){
    sAlert.slideUp(500);
});