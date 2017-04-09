"use strict";

angular.module("angularApp").factory("GameService", function ($http) {

    var service = {};

    service.getAll = function () {
        return $http.get('/api/allGames');
    };


    return service;
});

angular.module("angularApp").controller("GameListCtrl",
    ["GameService", function (GameService) {

        var vm = this;
        vm.players = [];

        GameService.getAll().then(
            function (result) {
                console.error(result.data);

                vm.games = result.data;
            },
            function (result) {
                console.error(result);
                //toastr.error("Some error occurred. See log.");
            }
        );

    }]); // end GameListCtrl

