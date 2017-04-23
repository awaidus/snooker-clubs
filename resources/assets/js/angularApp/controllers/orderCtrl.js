"use strict";

angular.module("angularApp").factory("OrderService", function ($http) {

    var service = {};

    service.getAll = function () {
        return $http.get('/orderList');
    };

    return service;
});

angular.module("angularApp").controller("OrderListCtrl",
    ["OrderService", function (OrderService) {

        var vm = this;

        OrderService.getAll().then(
            function (result) {
                vm.orders = result.data;
            },
            function (result) {
                console.error(result);
                //toastr.error("Some error occurred. See log.");
            }
        );

    }]); // end OrderListCtrl

