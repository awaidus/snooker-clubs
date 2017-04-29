
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('game-hall', require('./components/game/GameHall.vue'));
Vue.component('games-balance', require('./components/game/GamesBalance.vue'));
Vue.component('modal', require('./components/Modal.vue'));
Vue.component('games-list', require('./components/game/GameList.vue'));


const app = new Vue({
    el: '#app',
});


// $('[data-type="date"]').flatpickr();
//
// $('[data-type="datetime"]').flatpickr({
//
//     enableTime: true,
//
//
//     // clearIcon: '<i class="fa fa-remove clear-icon"></i>',
//     // clearText: 'Clear',
//     // triggerChangeEvent: true,
//     // close: true,
//     // theme: "light",
//
//     //defaultDate: new Date(),
//
//     // onOpen: function (selectedDates, dateStr, instance) {
//     //
//     //     console.log(this);
//     //
//     //     this.set('jumpToDate', new Date());
//     //
//     //     //this.setDefaults({defaultDate: new Date()});
//     //
//     //    // if (this.input.val() == '') this.config.defaultDate( new Date() );
//     //
//     // }
//
// });


$('[data-type="date"]').datetimepicker({
    format: 'DD-MM-YYYY',
    showTodayButton: true,
    showClear: true,
    showClose: true
});

$('[data-type="datetime"]').datetimepicker({

    format: 'DD-MM-YYYY LT',
    showTodayButton: true,
    showClear: true,
    showClose: true
});


var sAlert = $("#success-alert");
sAlert.alert();
sAlert.fadeTo(2000, 500).slideUp(500, function () {
    sAlert.slideUp(500);
});

