/**
 * Created by vvpol on 25.09.2016.
 */
'use strict';

/*
angular.module('jobpadApp', ['dialogApp']).controller('jobPadController', function($scope){
    console.log('controller');
    $scope.showDialog1 = true;
    function toggleDialog(show, uidDialog){
        var trigger = new CustomEvent("show-dialog", {
            detail: {
                uidDialog: uidDialog,
                $scope: $scope,
                show: show
            }
        });
        document.dispatchEvent(trigger);
    }
    // Показать диалог с uidDialog
    $scope.showDialog = function(uidDialog) {
        toggleDialog(true, uidDialog)
    };
    // Скрыть диалог с uidDialog
    $scope.closeDialog = function(uidDialog){
        toggleDialog(false, uidDialog)
    }

});
function __jobPadController($scope){
    console.log('controller');
    $scope.showDialog1 = true;
    function toggleDialog(show, uidDialog){
        var trigger = new CustomEvent("show-dialog", {
            detail: {
                uidDialog: uidDialog,
                $scope: $scope,
                show: show
            }
        });
        document.dispatchEvent(trigger);
    }
    // Показать диалог с uidDialog
    $scope.showDialog = function(uidDialog) {
        toggleDialog(true, uidDialog)
    };
    // Скрыть диалог с uidDialog
    $scope.closeDialog = function(uidDialog){
        toggleDialog(false, uidDialog)
    }

}

*/
var angularApp = angular.module('jobpadApp', ['dialogApp']);
(function(){
   // var angularApp = angular.module('jobpadApp', ['dialogApp']);
    /**
     * ---------- Контроллер -------------
     */
    window.angularApp.controller('jobPadController', function($scope, dataServices){
        console.log('controller');
        $scope.projects = dataServices.projects;
        $scope.jobs = dataServices.jobs;
        $scope.showDialog1 = true;
        /**
         * Управление видимостью диалога
         * @param show
         * @param uidDialog
         */
        function toggleDialog(show, uidDialog){
            var trigger = new CustomEvent("show-dialog", {
                detail: {
                    uidDialog: uidDialog,
                    $scope: $scope,
                    show: show
                }
            });
            document.dispatchEvent(trigger);
        }
        // Показать диалог с uidDialog
        $scope.showDialog = function(uidDialog) {
            toggleDialog(true, uidDialog)
        };
        // Скрыть диалог с uidDialog
        $scope.closeDialog = function(uidDialog){
            toggleDialog(false, uidDialog)
        };

        $scope.addProject = function(){
            $scope.projects.push({name: 'ещё строка', begin: '1.1.16', status: 'closed'})
        }
    });

})();