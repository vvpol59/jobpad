<?php
/**
 * Форма регистрации/авторизации
 * User: vvpol
 * Date: 25.11.2016
 * Time: 13:04
 */
?>
<div ng-controller="loginCtrl" ng-show="visibleLogin">
    <div style="position: fixed;top: 0;bottom: 0;height: 100%;width: 100%;z-index: 100;background-color: #808080;opacity: 0.5">
        <a href="../">Выход</a>
    </div>
    <div ng-ui-draggable='{"handler-class": "ng-ui-dialog-handler","containment":".desk-top-content"}' class="dialog-body" style="z-index: 1000;box-shadow: 8px 8px 8px rgb(80, 80, 80);border-radius: 5px;">
        <div class="ng-ui-dialog-handler">
            <div class="dialog-title dialog-draggable">
                <div ng-hide="registerMode">Авторизация</div>
                <div ng-show="registerMode">Регистрация</div>
            </div>
        </div>
        <div>
            <div style="padding: 20px" ng-hide="registerMode">
                <form name="loginFrm">
                    <div>
                        email: <input ng-model="loginData.email" type="text" req-uired="true" value="admin">
                    </div>
                    <div>
                        Пароль: <input ng-model="loginData.password" type="password" requ-ired="true">
                    </div>
                    <div>
                        <button type="submit" ng-click="login(loginData, loginFrm)">Войти</button>
                    </div>
                </form>
            </div>
            <div style="padding: 20px" ng-show="registerMode">
                <form name="registerFrm">
                    <div>
                        Имя: <input ng-model="regData.name" type="text" req-uired="true">
                    </div>
                    <div>
                        email: <input ng-model="regData.email" type="text" req-uired="true">
                    </div>
                    <div>
                        Пароль: <input ng-model="regData.password" type="password" requ-ired="true">
                    </div>
                    <div>
                        Повтор пароля: <input ng-model="regData.password2" type="password" requ-ired="true">
                    </div>
                    <div>
                        <button type="submit" ng-click="register(regData, registerFrm)">Зарегистрироваться</button>
                    </div>
                </form>
            </div>
            <div>
                <input type="radio" name="login-mode" value="login" checked ng-click="registerMode=false"> Вход
                <input type="radio" name="login-mode" value="register" ng-click="registerMode=true"> Регистрация
            </div>

        </div>
    </div>
</div>
