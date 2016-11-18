/**
 * Контроллер регистрации/авторизации
 * Created by vvpok on 18.11.2016.
 */
"use strict";
(function(){
    function controller($scope, $http, dataServices){
        $scope.response={};
        $scope.save = function (answer, answerForm){
            if(answerForm.$valid){
                $http.post("rpc2.php", answer).success(function (answ) {
                    $scope.response=answ;
                });
            }
        };
    }

    function services(){

    }

    angular.module('loginApp', [])
        .controller('loginCtrl', controller)
        .factory('dataServices', services);


})();