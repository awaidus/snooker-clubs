"use strict";

angular.module("angularApp").factory("GameService", function ($http) {

    var service = {};

    service.getAll = function (clubId) {
        return $http.get('/api/allGames/' + clubId);
    };


    return service;
});

angular.module("angularApp").controller("GameListCtrl",
    ["GameService", function (GameService) {

        var vm = this;
        vm.games = [];

        GameService.getAll(global.clubId).then(
            function (result) {

                vm.club = result.data;
                vm.games = vm.club.games;
                console.error(result.data);

            },
            function (result) {
                console.error(result);
                //toastr.error("Some error occurred. See log.");
            }
        );

    }]); // end GameListCtrl

