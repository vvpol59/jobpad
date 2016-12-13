/**
 *  * директива диалогового окна а-ля jQuery.draggable
 * Created by vvpol on 17.10.2016.
 */
(function(){
    "use strict";
    var app = angular.module('draggableApp', []);
    app.directive('ngUiDraggable', ['$document', function($document){
        return {
            restrict: 'A',
            link: function(scope, element, attrs){
                var startX,
                    startY,
                    initialMouseX,
                    initialMouseY,
                    rParams,
                    handler,
                    width,
                    height,
                    container,
                    selector,
                    zIndex,
                    containment = {},
                    params = {
                        handlerClass: false,
                        axis: false,
                        containment: false,
                        stopBroadcast: false
                    };

                /**
                 * Обработчик перемещения
                 * @param e
                 * @returns {boolean}
                 */
                function mousemove(e){
                    e.stopPropagation();
                    e.preventDefault();
                    var dx = e.clientX - initialMouseX,
                        dy = e.clientY - initialMouseY,
                        newY = startY + dy,
                        newX = startX + dx;
                    if (newX < 0){
                        newX = 0;
                    }
                    if (newY < 0){
                        newY = 0;
                    }
                    if (newX + width > containment.right){
                        newX = containment.right - width;
                    }
                    if (newY + height > containment.bottom){
                        newY = containment.bottom - height;
                    }
                    element.css({
                        top:  newY + 'px',
                        left: newX + 'px'
                    });
                    return false;
                }
                /**
                 * Инициализация перетаскивания по mousedown
                 * @param e
                 */
                function initDraggable(e){
                    e.stopPropagation();
                    e.preventDefault();
                    zIndex = element.css('z-index');
                    element.css('z-index', 1000);

                    startX = element.prop('offsetLeft');
                    startY = element.prop('offsetTop');
                    initialMouseX = e.clientX;
                    initialMouseY = e.clientY;
                    // определяемся с разменами контейнера и элемента
                    width = element.prop('offsetWidth');
                    height = element.prop('offsetHeight');
                    containment = {
                        top: 0,
                        left: 0
                    };
                    containment.right = container.prop('offsetWidth');
                    containment.bottom = container.prop('offsetHeight');
                    $document.on('mousemove', mousemove);
                    $document.one('mouseup', function() {
                        $document.off('mousemove');
                        element.css('z-index', zIndex);
                        // Если определёна передача события по окончанию
                        if (params.stopBroadcast){
                            scope.$emit(params.stopBroadcast, element);
                        }
                    });
                }
                // --------- Инициализация -------------------
                element.css({position: 'absolute'});
                rParams = attrs.ngUiDraggable ? JSON.parse(attrs.ngUiDraggable) : {};
                if (rParams['handler-class'] != undefined){
                    params.handlerClass = rParams['handler-class'];
                }
                if (rParams.containment != undefined){  // Задан контейнер
                    if (rParams.containment[0] == '.'){  // Определён класс
                        container = element.parent();
                        selector = rParams.containment.substr(1);
                        for (;true;){
                            if (container.hasClass(selector) || (container[0].tagName == 'body')){
                                break;
                            }
                            container = container.parent();
                        }
                    } else if (rParams.containment[0] == '#'){ // определён id
                        container = $document[0].getElementById(rParams.containment.substr(1));
                        if (!container){
                            container = $document.find('body');
                        } else {
                            container = angular.element(container);
                        }
                    } else if (rParams.containment == 'parent'){  // родитель
                        container = element.parent();
                    }
                    if (container){
                        params.containment = rParams.containment;
                    }
                } else {  // Контейнером назначаем body
                    container = $document.find('body');
                }
                if (rParams.axis != undefined){
                    params.axis = rParams.axis;
                }
                if (rParams['stop-broadcast'] != undefined){
                    params.stopBroadcast = rParams['stop-broadcast'];
                }
                handler = params.handlerClass ? angular.element(element[0].getElementsByClassName(params.handlerClass)[0]) : element;
                handler.on('mousedown', initDraggable);
            }
        }
    }]);

})();