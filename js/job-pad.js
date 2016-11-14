/**
 * Created by vvpol on 25.09.2016.
 */
'use strict';

var angularApp = angular.module('jobpadApp', ['dialogApp']);
(function(){
    /**
     * ---------- Контроллер -------------
     */
    window.angularApp.controller('jobPadController', function($scope, dataServices){
        var jobs = {},
            windows = {},
            /**
             * Управление списком проектов
             * @type {{show: Function}}
             */
            projectList = {
                show: function(){
                    $scope.toggleDialog(true, 'proj-list');
                }
            },
            employeeList = {
                show: function(){
                    $scope.toggleDialog(true, 'employee-list');
                }
            };
        $scope.projects = dataServices.projects;
        $scope.jobs = dataServices.jobs;
        $scope.startMenu = dataServices.startMenu;
        $scope.labels = dataServices.labels;
        $scope.dialogsVisible = {};

        /**
         * Открыть диалог
         * @param uidDialog
         * @param data
         */
        $scope.openDialog = function(uidDialog, data){

        };
        /**
         * Управление видимостью диалога
         * @param show
         * @param uidDialog
         */
        $scope.toggleDialog = function(show, uidDialog){
            $scope.dialogsVisible[uidDialog] = show;
        };
        $scope.showStartMenu = function(){
            $scope.visibleStartMenu = true;
        };
        $scope.init = function(v){
         //   $scope.toggleDialog(true, 1);
        };

        $scope.mainMenuClick = function(params){
            if(params.code == 'proj-list'){
                projectList.show();
            } else if (params.code == 'employee-list') {
                employeeList.show();
            }
        };
        //function addLabel(data){
        //    $scope.labels.push({name: 'label next'});
        //}
        window.onload = function(){
            // После полной отработки всех скриптов
            $scope.$apply(function() {
            //    $scope.toggleDialog(true, 1);
            });
        };
    });
    /**
     * Директива ярлыка
     */
    window.angularApp.directive('label', function(){
        function exec(){
            console.log(this);
        }
        console.log('dir');
        return function(scope, label, attr){
            label.on('dblclick', exec);  //function(){
           //     alert(label);
           // });
            console.log('label', label);
        }

    })

})();
