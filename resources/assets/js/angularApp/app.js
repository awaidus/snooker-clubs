'use strict';
let angularApp = angular.module("angularApp", [
    'ngAnimate'
    // 'ui.router',
    // 'ngRoute',
    // 'angular-loading-bar',
    //  'ui.bootstrap'
]);


// angularApp.config(function($interpolateProvider) {
//     $interpolateProvider.startSymbol('[[');
//     $interpolateProvider.endSymbol(']]');
// });

angularApp.filter('dateToISO', function () {
    return function (input) {
        input = new Date(input).toISOString();

        return input;

    };
});

export default angularApp;