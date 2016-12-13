/**
 * Контроллер списка проектов, карточки проекта
 * Created by vvpol on 17.11.2016.
 */
'use strict';
(function(){
    var  controller = function($scope, dataServices){

        var projListWin = {
                $win: angular.element(document.getElementById('proj-list')),
                close: function(item){
                    projListWin.opened = false;
                    projListWin.$win.css({display: 'none'});
                    return true;
                },
                id: 0,
                code: 'proj-list',
                opened: false,
                title: 'Проекты'
            },
            idNewProj = 0;  // id новых карточек проекта
        $scope.projListWin = projListWin;

        /**
         * Закрыть окно карточки проекта
         * @param item
         */
        function closeWin(item){
            var index = $scope.lib.findWin(item.$win, $scope.projCards);
            $scope.projCards.splice(index, 1);
          //  item.$win.css({display: 'none'});
            return true;
        }

        /**
         * Создать проект
         */
        $scope.createProj = function(){
            var len = $scope.projCards.push({
                name: 'Новый проект',
                descr: '',
                title: 'Добавление проекта',
                close: closeWin,
                code: 'proj-card',
                id: --idNewProj
            });
            // Получаем ссылку на новый объект
            setTimeout(function(){
                var cards = document.getElementsByClassName('proj-card'),
                    i, $card;
                for (i = 0; i < cards.length; i++){
                    $card = angular.element(cards[i]);
                    if ($card.attr('data-id') == idNewProj){
                        $scope.projCards[len - 1].$win = $card;
                        break;
                    }
                }
                // Сообщаем вышестоящему контроллеру
                $card.data('vis', true);
                $scope.$emit('win-opened', $scope.projCards[len - 1]);
            }, 100);
        };

        $scope.saveProjCard = function(card){
         //   console.log(card);
        };

        $scope.projCards = [];  // Список открытых карточек проекта
        $scope.projects = [];  //Список проектов для отображения
        // Обработка команд родительского контроллера
        $scope.$on('proj-list', function(e, params){
            if (params.mode == 'open'){  // Открыть список проектов
                if (!projListWin.opened){  // Не открыт
                    projListWin.$win.css({display: 'block'});
                    projListWin.$win.data('vis', true);
                    projListWin.opened = true;
                    $scope.$emit('win-opened', projListWin);
                }
            }
        });
    };
    window.angularApp.controller('projListController', controller);

})();