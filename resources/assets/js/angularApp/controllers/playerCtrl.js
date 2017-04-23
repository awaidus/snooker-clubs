"use strict";

angular.module("angularApp").factory("PlayerService", function ($http) {

    var service = {};

    service.getAll = function () {
        return $http.get('/api/allPlayers');
    };

    service.destroy = function (id) {
        return $http.get('/api/destroyPlayer/' + id);
    };

    service.restore = function (id) {
        return $http.get('/api/restorePlayer/' + id);
    };

    return service;
});

angular.module("angularApp").controller("PlayerListCtrl",
    ["PlayerService", function (PlayerService) {

        var vm = this;
        vm.players = [];

        PlayerService.getAll().then(
            function (result) {

                vm.players = result.data;
            },
            function (result) {
                console.error(result);
                //toastr.error("Some error occurred. See log.");
            }
        );

        vm.destroyPlayer = function (id) {
            PlayerService.destroy(id).then(
                function (result) {
                    console.log(result.data);
                    PlayerService.getAll().then(
                        function (result) {

                            vm.players = result.data;
                        },
                        function (result) {
                            console.error(result);
                            //toastr.error("Some error occurred. See log.");
                        }
                    );
                },
                function (result) {
                    console.error(result);
                    //toastr.error("Some error occurred. See log.");
                }
            );
        };

        vm.getTransactionSum = function (items) {

            if (items.length == 0) {
                return 0;

            } else {

                return items
                    .map(function (x) {
                        return x.amount;
                    })
                    .reduce(function (a, b) {
                        return a + b;
                    });
            }
        };


    }]); // end PlayerListCtrl

