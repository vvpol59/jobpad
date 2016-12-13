/**
 * Контроллер регистрации/авторизации
 * Created by vvpol on 18.11.2016.
 */
"use strict";
var angularApp = angular.module('vvpolApp', []);

(function(){
    function controller($scope, $http, dataServices){

        function loginOk(data){
            console.log(data);
        }

   //     $scope.response={};
        $scope.save = function (data, form){
            if(form.$valid){
                dataServices.rpc2('login', data, loginOk);
            }
        };

        $scope.reg = function(data, form){
            if(form.$valid){
                dataServices.rpc2('register', data, loginOk);
            }

        }

    }

    function services(){

    }

   // angular.module('vvpolApp', [])
    window.angularApp
        .controller('loginCtrl', controller);
//        .factory('dataServices', services);


})();