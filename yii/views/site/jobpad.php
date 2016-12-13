<?php
/**
 *
 * User: vvpol
 * Date: 24.11.2016
 * Time: 23:13
 */
$this->registerJsFile('angular/angular-1.2.30.js',  ['position' => yii\web\View::POS_HEAD]);
$this->registerJsFile('js/ng-ui-draggable.js',  ['position' => yii\web\View::POS_HEAD]);
$this->registerJsFile('js/job-pad.js',  ['position' => yii\web\View::POS_HEAD]);
$this->registerJsFile('js/job-pad-services.js',  ['position' => yii\web\View::POS_HEAD]);
$this->registerJsFile('js/login-ctrl.js',  ['position' => yii\web\View::POS_HEAD]);
$this->registerJsFile('js/proj-list.js',  ['position' => yii\web\View::POS_HEAD]);
$this->registerCSSFile('css/reset.css', ['position' => yii\web\View::POS_HEAD]);
$this->registerCSSFile('css/job-pad.css', ['position' => yii\web\View::POS_HEAD]);
?>
<div class="desk-top">
    <div class="desk-top-content">
        <?= $layout ?>
        <!-- Список проектов ----->
        <div ng-ui-dialog class="dialog-body" data-uid="1"
             data-params='{"draggable": true, "resizable":true, "title": "Проекты", "close-btn": true}'>
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
        <div ng-ui-dialog class="dialog-body" data-uid="prj-card"
             data-params='{"modal":true, "resizable":false, "title": "Карточка проекта"}'>
            <div class="input-item">
                <label>Название</label>
                <input type="text" value="{{}}">
            </div>
            <div class="input-item">
                <label>Описание</label>
                <textarea>{{}}</textarea>
            </div>
            <div class="input-item">
                <label>Статус</label>
                <select>
                    <option ng-repeat="state in states" value="{{state.code}}">{{state.name}}</option>
                </select>

            </div>
            <div class="input-item">
                <label>Файлы</label>
                <ul>
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
    <div class="desk-top-task-bar">

    </div>
</div>
