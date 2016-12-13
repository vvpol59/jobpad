/**
 * Контроллер регистрации/авторизации
 * Created by vvpol on 18.11.2016.
 */
"use strict";

(function(){
    function controller($scope, $http, dataServices){

        $scope.loginData = {};
        $scope.regData = {};

        /**
         *  Обработчик кнопки "войти"
         * @param data
         * @param form
         */
        $scope.login = function (data, form){
            if(form.$valid){
                dataServices.rpc2('login', data, function(response){
                    if (response.user != undefined){ // Успешно
                        $scope.visibleLogin = false;
                        $scope.$emit('login-ok');
                    }
                });
            }
        };

        /**
         * Обработчик кнопки "Зарегистрироваться"
         * @param data
         * @param form
         */
        $scope.register = function (data, form){
            if(form.$valid){
                dataServices.rpc2('register', data, function(response){
                    if (response.error != undefined){ // Была ошибка
                        alert(response.error);
                    } else {
                        alert('Вы успешно зарегистрировались. Можно войти в систему');
                    }
                });
            }
        };

        /**
         * Обработка выхода из системы
         */
        $scope.$on('logout', function(){
            dataServices.rpc2('logout', [], function(response){
                if (response == 'ok'){
                    $scope.visibleLogin = true;
                }
            });
        });

        /**
         * После отработки всех скриптов
         */
        window.onload = function(){
            // Проверка на залогиненость
            dataServices.rpc2('getRole', {}, function(response){
                $scope.visibleLogin =  (response.user == undefined);
                // Если пользователь залогинен, сообщаем верхнему контроллеру
                if (response.user != undefined){
                    $scope.$emit('login-ok');
                }
            });
        };
    }

    window.angularApp.controller('loginCtrl', controller);

})();