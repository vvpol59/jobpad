/**
 * Created by vvpol on 25.09.2016.
 */
'use strict';

var angularApp = angular.module('jobpadApp', ['dialogApp', 'draggableApp']);
(function(){
    /**
     * ---------- Контроллер -------------
     */
var controller = function($scope, dataServices){
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
            };
        $scope.jobs = dataServices.jobs;
        $scope.startMenu = dataServices.startMenu;
        $scope.labels = dataServices.labels;
        $scope.dialogsVisible = {};
        $scope.visibleProjList = false;
        $scope.tasks = [];
        $scope.winClose = winClose;
        $scope.winMinimize = winMinimize;
        /**
         * Управление видимостью стартового меню
         * @param visible
         */
        $scope.showStartMenu = function(visible){
            if (visible == undefined) visible = true;
            $scope.visibleStartMenu = visible;
        };
      //  $scope.init = function(v){
            //   $scope.toggleDialog(true, 1);
      //  };

        /**
         * Выбор в стартовом меню
         * @param params
         */
        $scope.mainMenuClick = function(params){
            $scope.$broadcast(params.code, {mode: 'open'});
        };

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
        }

        /**
         * Закрыть окно
         * @param code
         * @param id
         */
        function winClose(code, id){
            $scope.$broadcast(code, {id: id, mode: 'close'});
        }

        function winMinimize(code, id){
            $scope.$broadcast(code, {id: id, mode: 'minmax'});
        }

        /**
         * Обработка открытия окна
         * @param e
         * @param params
         */
        function winOpened(e, params){
            $scope.tasks.push({name: params.name, code: params.code, id: params.id});
        }

        /**
         * Обработка минимизации окна
         * @param e
         * @param params
         */
        function winMinimized(e, params){

        }

        /**
         * Обработка закрытия окна
         * Удаляет кнопку из таскбара
         * @param e
         * @param params
         */
        function winClosed(e, params){
            for (var i = 0; i < $scope.tasks.length; i++){
                if ($scope.tasks[i].code == params.code){
                    $scope.tasks.splice(i, 1);
                    break;
                }
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
        $scope.$on('win-opened', winOpened);
        $scope.$on('win-minimised', winMinimized);
        $scope.$on('win-closed', winClosed);
    };

    window.angularApp.controller('jobPadController', controller);
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
