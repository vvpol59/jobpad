<?php
/**
 * Список проектов
 * User: vvpol
 * Date: 28.09.2016
 * Time: 22:04
 */
?>
<div ng-controller="projListController">
    <div ng-show="visibleProjList" ng-ui-draggable='{"handler-class": "ng-ui-dialog-handler","containment":".desk-top-content"}' class="dialog-body" data-uid="proj-list">
        <div class="ng-ui-dialog-handler">
            <div class="dialog-title dialog-draggable">Проекты</div>
            <div class="dialog-close-btn" ng-click="closeList()"></div>
            <div class="dialog-minimize-btn" ng-click="minimizeList()"></div>
        </div>
        <table>
            <tr>
                <td>
                    <table class="table-data">
                        <tr class="table-data-header">
                            <td>№</td>
                            <td>Проект</td>
                            <td>Дата начала</td>
                            <td>Статус</td>
                        </tr>
                        <tr class="data-row" ng-repeat="project in projects">
                            <td>{{$index}}</td>
                            <td>{{project.name}}</td>
                            <td>{{project.begin}}</td>
                            <td>{{project.status}}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <div>
                        <table class="table-data">
                            <tr class="table-data-header">
                                <td colspan="2">Задачи</td>
                            </tr>
                            <tr class="table-data-header">
                                <td>Наименование</td>
                                <td>Статус</td>
                            </tr>
                            <tr ng-repeat="job in jobs">
                                <td>{{job.name}}</td>
                                <td>{{job.status}}</td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        Исполнители
                    </div>
                </td>
            </tr>
        </table>
        <button ng-click="addProject()">test</button>
    </div>
</div>