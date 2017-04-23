"use strict";


angular.module("angularApp").factory("TodoService", function ($http) {

    var service = {};

    service.getAll = function () {
        return $http.get('/todoList');
    };

    service.remainingCount = 0;

    return service;
});

angular.module("angularApp").controller("TodoListCtrl",
    ["TodoService", "$log", function (TodoService, $log) {

        var vm = this;
        vm.todos = [];

        TodoService.getAll().then(
            function (result) {
                vm.todos = result.data;

            },
            function (result) {
                console.error(result);
                //toastr.error("Some error occurred. See log.");
            }
        );

        vm.remaining = function () {
            var count = 0;
            angular.forEach(vm.todos, function (todo) {
                count += todo.completed ? 1 : 0;
            });
            TodoService.remainingCount = count;
            return TodoService.remainingCount;
        };


    }]); // end TodoListCtrl
