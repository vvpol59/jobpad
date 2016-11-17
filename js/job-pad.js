/**
 * Created by vvpol on 25.09.2016.
 */
'use strict';

var angularApp = angular.module('jobpadApp', ['dialogApp', 'draggableApp']);
(function(){
    /**
     * ---------- Контроллер -------------
     */
    window.angularApp.controller('jobPadController', function($scope, dataServices){
        var _this = this,
            $deskTopContent = angular.element(document.getElementsByClassName('desk-top-content')[0]),
            deskTopCols = parseInt($deskTopContent.prop('offsetWidth') / 64),
            deskTopRows = parseInt($deskTopContent.prop('offsetHeight') / 64),
            jobs = {},
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
            },
            fun = dataServices.fun;
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
        $scope.showStartMenu = function(visible){
            if (visible == undefined) visible = true;
            $scope.visibleStartMenu = visible;
        };
        $scope.init = function(v){
         //   $scope.toggleDialog(true, 1);
        };

        /**
         * Выбор в стартовом меню
         * @param params
         */
        $scope.mainMenuClick = function(params){
            $scope.showStartMenu(false);
            if(params.code == 'proj-list'){
                fun.projectList.show();
                projectList.show();
            } else if (params.code == 'employee-list') {
                employeeList.show();
            }
        };
        //function addLabel(data){
        //    $scope.labels.push({name: 'label next'});
        //}
        /**
         * Формирование списка занятых позиций для ярлыков
         * @param label
         * @param index
         * @returns {string}
         */
        $scope.position = function(label, index){
            label.id = index;
            return '';
        };

        // Расстановка ярлыков по местам
        function setLabels(){
            var lab, pos, col, row,
                labels = document.getElementsByTagName('body')[0].getElementsByClassName('desk-top-label');
            for (var i = 0; i < labels.length; i++){
                lab = angular.element(labels[i]);
                pos = $scope.labels[lab.attr('data-id')].pos;
                row = parseInt(pos / deskTopCols);
                col = pos % deskTopCols;
                lab.css({top: (row * 64) + 'px', left: (col * 64) + 'px'});
            }
        }
        window.onload = function(){
            // После полной отработки всех скриптов
            document.addEventListener('click', function(){
                $scope.showStartMenu(false);
                $scope.$apply();
            }, true);
            setLabels();
            $scope.$apply(function() {
            });
        };
        $scope.$on('label-drag-end', labelDragEnd);
        /**
         * Конец перетаскивания ярлыка. корректируем положение
         * @param e
         * @param label
         */
        function labelDragEnd(e, label){
            var isBusy = false,
                index = label.attr('data-id'),
                col = parseInt(label.prop('offsetLeft') / 64), // колонка верхнего левого угла
                row = parseInt(label.prop('offsetTop') / 64), // строка --//--
                newPos = deskTopCols * row + col;  // Новая позиция
            // Проверка занятости позиции
            for (var i = 0; i < $scope.labels.length; i++){
                isBusy = ($scope.labels[i].pos == newPos);
                if (isBusy){
                    break;
                }
            }
            if (isBusy){ // Позиция занята. возвращаем назад
                row = parseInt($scope.labels[index].pos / deskTopCols);
                col = $scope.labels[index].pos % deskTopCols;
                label.css({top: (row * 64) + 'px', left: (col * 64) + 'px'});
            } else {
                label.css({top: (row * 64) + 'px', left: (col * 64) + 'px'});
                $scope.labels[index].pos = newPos;
            }


         //   console.log(label);
        }
        console.log(this);
    });
    /**
     * Директива ярлыка
     */
    window.angularApp.directive('label', function(){
        function exec(){
            console.log(this);
        }
        return function(scope, label, attr){
            label.on('dblclick', exec);  //function(){
           //     alert(label);
           // });
            console.log('label', label);
        }

    })

})();
