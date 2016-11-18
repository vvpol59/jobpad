/**
 * Контроллер списка проектов
 * Created by vvpol on 17.11.2016.
 */
'use strict';
(function(){
    var  controller = function($scope, dataServices){
        var listOpened = false;

        /**
         * минимизация списка проектов
         */
        function minimizeList(){
            $scope.visibleProjList = !$scope.visibleProjList;
            $scope.$emit('win-minimized', {code: 'proj-list'});
        }

        function closeList(){
            $scope.visibleProjList = false;
            if (listOpened){
                $scope.$emit('win-closed', {code: 'proj-list'});
                listOpened = false;
            }
        }

        $scope.projects = dataServices.projects;
        $scope.minimizeList = minimizeList;
        $scope.closeList = closeList;
        // Обработка команд родительского контроллера
        $scope.$on('proj-list', function(e, params){
            if (params.mode == 'open'){  // Открыть список
                $scope.visibleProjList = true;
                if (!listOpened){ // Список не был открыт
                    $scope.$emit('win-opened', {id: 0, code: 'proj-list', name: 'Список проектов'});
                    listOpened = true;
                }
            } else if (params.mode == 'close'){ // Закрыть список
                closeList();
            } else if (params.mode == 'minmax'){ // Минимизировать окно списка
                minimizeList();
            }


        })
    };
    window.angularApp.controller('projListController', controller);

})();