<?php
/**
 * Список сотрудников
 * User: vvpol
 * Date: 19.10.2016
 * Time: 7:40
 */
?>
<div ng-show="employeeVisible" ng-ui-dialog class="dialog-body" data-uid="employee-list"
     data-params='{"draggable": true, "resizable":true, "title": "Сотрудники", "close-btn": true, "modal": false}'>
    <table>
        <tr>
            <td>
                <table class="table-data">
                    <tr class="table-data-header">
                        <td>№</td>
                        <td>ФИО</td>
                        <td>e-mail</td>
                    </tr>
                    <tr class="data-row" ng-repeat="employee in employees">
                        <td>{{$index}}</td>
                        <td>{{employee.name}}</td>
                        <td>{{employee.email}}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <button ng-click="addProject()">test</button>
</div>
