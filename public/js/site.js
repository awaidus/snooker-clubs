$('[data-type="date"]').flatpickr();

$('[data-type="datetime"]').flatpickr({

    enableTime: true,

    // clearIcon: '<i class="fa fa-remove clear-icon"></i>',
    // clearText: 'Clear',
    // triggerChangeEvent: true,
    // close: true,
    // theme: "light",

    //defaultDate: new Date(),

    // onOpen: function (selectedDates, dateStr, instance) {
    //
    //     console.log(this);
    //
    //     this.set('jumpToDate', new Date());
    //
    //     //this.setDefaults({defaultDate: new Date()});
    //
    //    // if (this.input.val() == '') this.config.defaultDate( new Date() );
    //
    // }

});


var sAlert = $("#success-alert");
sAlert.alert();
sAlert.fadeTo(2000, 500).slideUp(500, function () {
    sAlert.slideUp(500);
});
