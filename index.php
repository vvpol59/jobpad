<?php
/**
 * User: vvpol
 * Date: 28.09.2016
 * Time: 21:48
 */
?>
<!DOCTYPE html>
<html ng-app="loginApp" ng-init="init(1)">
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- link rel="stylesheet" type="text/css" href="ng-ui-dialog/ng-ui-dialog.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/job-pad.css" -->
    <script src="angular/angular-1.2.30.js"></script>
    <script src="js/login-ctrl.js"></script>
    <!-- script src="ng-ui-dialog/ng-ui-dialog.js"></script>
    <script src="js/ng-ui-draggable.js"></script>
    <script src="js/job-pad.js"></script>
    <script src="js/proj-list.js"></script>
    <script src="js/job-pad-services.js"></script -->
</head>
<body ng-controller="loginCtrl">
<div style="padding: 20px">
    e-mail: <input type="email" name="email">
    password: <input type="password" name="password">
    <button>Войти</button>
</div>
<div style="padding: 20px">
    <form name="authorise">
    <div>e-mail: <input type="email" ng-model="data.email"></div>
    <div>password: <input type="password" ng-model="data.password"></div>
    <div>password2: <input type="password" ng-model="data.password2"></div>
    <div><button ng-click="save(data, authorise)">Зарегистрироваться</button></div>
    </form>
</div>


</body>
</html>