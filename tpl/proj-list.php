<?php
/**
 * Список проектов
 * User: vvpol
 * Date: 28.09.2016
 * Time: 22:04
 */
?>
<div ng-ui-dialog class="dialog-body" data-uid="proj-list"
     data-params='{"draggable": true, "resizable":true, "title": "Проекты", "close-btn": true, "modal": false}'>
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
