<?php
/**
 * Карточка проекта
 * User: vvpol
 * Date: 28.09.2016
 * Time: 22:08
 */
?>
<div ng-ui-dialog class="dialog-body" data-uid="prj-card" style="width:400px"
     data-params='{"modal":true, "resizable":false, "title": "Карточка проекта"}'>
    <div class="dialog-frame">
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
        <button>Сохранить</button>
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
