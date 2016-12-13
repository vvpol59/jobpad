<?php
/**
 * Список проектов
 * User: vvpol
 * Date: 28.09.2016
 * Time: 22:04
 */
?>
<div ng-controller="projListController">
    <div id="proj-list" ng-ui-draggable='{"handler-class": "ng-ui-dialog-handler","containment":".desk-top-content"}' class="dialog-body" data-code="proj-list" data-id="0" style="display: none">
        <div class="ng-ui-dialog-handler win-label">
            <div class="dialog-menu" ng-click="createProj()">
                <!-- ul class="drop-down-menu dialog-menu">
                    <li>Создать проект</li>
                    <li>Удалить проект</li>
                    <li>Карточка проекта</li>
                </ul -->
            </div>
            <div class="dialog-title dialog-draggable">Проекты</div>
            <div class="dialog-close-btn" ng-click="closeWin(projListWin)"></div>
            <div class="dialog-minimize-btn" ng-click="toggleWin(projListWin)"></div>
        </div>
        <table>
            <tr>
                <td style="height: 200px;background-color: #ffffff;}">
                    <table class="table-data">
                        <tr class="table-data-header">
                            <td style="width: 64px">№</td>
                            <td style="width: 200px">Проект</td>
                            <td style="width: 100px">Дата начала</td>
                            <td style="width: 64px">Статус</td>
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
                </td>
            </tr>
        </table>
    </div>

    <div ng-repeat="card in projCards" ng-ui-draggable='{"handler-class": "ng-ui-dialog-handler","containment":".desk-top-content"}' class="dialog-body proj-card" data-code="proj-card" style="width:400px;"data-id="{{card.id}}">
        <div class="ng-ui-dialog-handler win-label">
            <div class="dialog-menu">
                <!-- ul class="drop-down-menu dialog-menu">
                    <li>Создать проект</li>
                    <li>Удалить проект</li>
                    <li>Карточка проекта</li>
                </ul -->
            </div>
    <div class="dialog-title dialog-draggable">{{card.title}}</div>
    <div class="dialog-close-btn" ng-click="closeWin(card)"></div>
    <div class="dialog-minimize-btn" ng-click="toggleWin(card)"></div>
</div>
<div class="dialog-frame">
            <div class="input-item">
                <label>Название</label>
                <input ng-model="card.name" type="text" value="{{card.name}}">
            </div>
            <div class="input-item">
                <label>Описание</label>
                <textarea>{{caed.descr}}</textarea>
            </div>
            <div class="input-item">
                <label>Статус</label>
                <select>
                    <option ng-repeat="state in states" value="{{state.code}}">{{state.name}}</option>
                </select>
            </div>
            <button ng-click="saveProjCard(card)">Сохранить</button>
        </div>

        <div class="dialog-frame">
            <label><span>Файлы</span><button>+</button></label>
            <ul class="dialog-list">
                <li>
                    Файл 1
                </li>
                <li>
                    Файл 2
                </li>
            </ul>
        </div>
    </div>
</div>