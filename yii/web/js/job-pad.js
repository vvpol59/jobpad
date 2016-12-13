/**
 * Created by vvpol on 25.09.2016.
 *
 */
'use strict';

var angularApp = angular.module('jobpadApp', [/*'dialogApp',*/ 'draggableApp']);
(function(){
    /**
     * ---------- Контроллер -------------
     */
var controller = function($scope, dataServices){
        var $deskTopContent = angular.element(document.getElementsByClassName('desk-top-content')[0]),
        // Размерность десктопов (колонок, строк)
            deskTopCols = parseInt($deskTopContent.prop('offsetWidth') / 64),
            deskTopRows = parseInt($deskTopContent.prop('offsetHeight') / 64),
            winStack = [];  // Стек окон
        $scope.dialogsVisible = {};
        $scope.visibleProjList = false;
        $scope.tasks = [];
        $scope.closeWin = closeWin;  // Закрытие окна из таск-бара
        $scope.toggleWin = toggleWin;  // Клик по кнопке таск-бара

        $scope.onCloseWin = onCloseWin;  // Сообщение о закрытии окна
        $scope.lib = {};
        /**
         * Поиск родительского объекта по его классу
         * @param $elem
         * @param selector
         * @returns {*}
         */
        $scope.lib.parentOnClass = function($elem, selector){
            var container = $elem.parent();
            for (;true;){
                if (container.hasClass(selector) || (container[0].tagName == 'body')){
                    break;
                }
                container = container.parent();
            }
            return container;
        };

        $scope.lib.findWin = function ($win, list){
            for (var i=0; i < $scope.tasks.length; i++){
                if (list[i].$win == $win){
                    return i;
                }
            }
        }


        /**
         * Управление видимостью стартового меню
         * @param visible
         */
        $scope.showStartMenu = function(visible){
            if (visible == undefined) visible = true;
            $scope.visibleStartMenu = visible;
        };

        $scope.logout = function(){
            $scope.$broadcast('logout', {});
        };

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

        function safeApply() {
            var phase = $scope.$root.$$phase;
            if(phase != '$apply' && phase != '$digest') {
                $scope.$apply();
            }
        }


        /**
         * Обработчик закрытия окна
         * @param $win
         */
        function onCloseWin($win){
            // Удаляем кнопку из таск-бара
            var taskIndex = findWin($win, $scope.tasks, $win.attr('data-code'), $win.attr('data-id'));
            $scope.tasks.splice(taskIndex, 1);
            safeApply();
            // Удаляем из стека
            taskIndex = findWin($win, winStack);
            winStack.splice(taskIndex, 1);
            setWinLayers(); // Переназначаем активное и уровни слоёв
        }

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
         * Поиск окна в таск-баре по коду и id
         * @param code
         * @param id
         * @returns {*}
         */
        function findWin($win, list, code, id){
            for (var i=0; i < $scope.tasks.length; i++){
                if (list[i].$win == $win){
                    return i;
                }
            }
        }

        /**
         * Закрыть окно
         * @param item
         */
        function closeWin(item){
            var isActive = findByClass(item.$win, 'win-label').hasClass('win-active'), // Признак активности окна
                taskIndex = findWin(item.$win, $scope.tasks),  // Индекс в таск-бвре
                stackIndex = findWin(item.$win, winStack); // Индекс в стеке
            if (typeof(item.close) == 'function'){
                if (!item.close(item)){
                    return;
                }
            }
            $scope.tasks.splice(taskIndex, 1); // Удаляем из таск-бара
            winStack.splice(stackIndex, 1); // Удаляем из стека
            if (isActive){  // Если окно активное - назначаем новое
                setWinLayers();
            }
        }

        /**
         * Переключение окна свернуть/развернуть
         * @param item
         */
        function toggleWin(item){
            var visible = item.$win.data('vis'),
                index = $scope.lib.findWin(item.$win, winStack),
                obj;
            item.$win.css({display: visible ? 'none' : 'block'});
            item.$win.data('vis', !visible);
            // Если окно открылось - делаем его активным
            if (!visible){  // Окно развернулось
                obj = winStack.splice(index, 1);
                winStack.push(obj[0]);
                setWinLayers();
            } else {  // Окно свёрнуто
                // Если окно активное, ставим его на предпоследнее место
                if (item.$win.hasClass('win-active')){
                    if (winStack.length > 1){
                        obj = winStack.splice(winStack.length -2, 1);
                        winStack.push(obj[0]);
                        setWinLayers();
                    }
                }
            }
        }

        function findByClass($element, cls){
            return angular.element($element[0].getElementsByClassName(cls));
        }

        /**
         * Переустановка слоёв окон. Верхнее делаем активным
         */
        function setWinLayers(){
            var i, $win;
            if (winStack.length > 0){ // Есть окна
                for (i = 0; i < winStack.length; i++){
                    winStack[i].$win.css({'z-index': 10 + i});
                    // Снимаем признак активности
                    angular.element(winStack[i].$win[0].getElementsByClassName('win-label')[0]).removeClass('win-active');
                }
                // Активное - верхнее
                angular.element(winStack[winStack.length - 1].$win[0].getElementsByClassName('win-label')[0]).addClass('win-active');
            }
        }

        function setActiveWin($win){
            // Ищем окно в стеке окон
            for (var i = 0; i < winStack.length; i++){
                if (winStack[i].$win == $win){ //
                    var item = winStack.splice(i, 1);
                    winStack.push(item[0]); // Помещаем в верхушку стека
                    setWinLayers();
                    break;
                }
            }
        }

        /**
         * Обработка открытия окна
         * @param e
         * @param params
         */
        function winOpened(e, params){
            // Добавляем в нижнюю панель
            $scope.tasks.push(params);
            safeApply();
            // прописываем в стек окон
            var index = winStack.push(params);
            setWinLayers();   // Переопределяем слои
            // Ставим обработчик на мышку для активизации окна
            var $win = angular.element(e.target);
            setActiveWin($win);
            $win.on('mousedown', function(e){
            });
        }

        /**
         * Загрузка окружения
         */
        function setEnvData(response, retCode){
            if (response.menu != undefined){
                $scope.startMenu = response.menu;
            }
        }

        /**
         * Обработка минимизации окна
         * @param e
         * @param params
         */
 //       function winMinimized(e, params){
//        }

        /**
         * Обработка закрытия окна
         * Удаляет кнопку из таскбара
         * @param e
         * @param params
         */
        function winClosed(e, params){
            //var $win = angulsr.element(e.index;
            // Удаление кнопки из таскбара
            var index = findWin(params.$win, $scope.tasks);
            $scope.tasks.splice(index, 1);
            // Удаление окна из стека
            index = findWin(params.$win, winStack);
            winStack.splice(index, 1);
            // Если закрывается активное окно - устанавливаем новое активное.
            if (findByClass(params.$win, 'win-label').hasClass('win-active')){
                setWinLayers();
            }
        }

        window.onload = function(){
            // После полной отработки всех скриптов
            document.addEventListener('click', function(){
                $scope.showStartMenu(false);
                safeApply();
            }, true);
            setLabels();
            safeApply();
        };
        $scope.$on('label-drag-end', labelDragEnd);
        $scope.$on('win-opened', winOpened);
     //   $scope.$on('win-minimised', winMinimized);
     //   $scope.$on('win-closed', winClosed);
        $scope.$on('login-ok', function(){  // Пользователь авторизован. Загрузка окружения
            dataServices.rpc2('getEnvData', {}, setEnvData);
        });
    };

    window.angularApp.controller('jobPadController', controller);
    /**
     * Директива ярлыка
     */
    window.angularApp.directive('label', function(){
        function exec(){
//            console.log(this);
        }
        return function(scope, label, attr){
            label.on('dblclick', exec);  //function(){
           //     alert(label);
           // });
//            console.log('label', label);
        }

    })

})();
