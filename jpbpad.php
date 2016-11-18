<?php
/**
 * User: vvpol
 * Date: 18.11.2016
 * Time: 8:52
 */
?>
<!DOCTYPE html>
<html ng-app="jobpadApp" ng-init="init(1)">
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="ng-ui-dialog/ng-ui-dialog.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/job-pad.css">
    <script src="angular/angular-1.2.30.js"></script>
    <script src="ng-ui-dialog/ng-ui-dialog.js"></script>
    <script src="js/ng-ui-draggable.js"></script>
    <script src="js/job-pad.js"></script>
    <script src="js/proj-list.js"></script>
    <script src="js/job-pad-services.js"></script>
    <style>
        .desk-top-label {
    display: inline-block;
    height: 64px;
            width: 64px;
            background-color: #99d9ea;
        }
        .desk-top-label .icon   {
    height: 48px;
            width: 48px;
            background-color: bisque;
        }

    </style>
</head>
<body ng-controller="jobPadController" ng-init="init(2)">
<div class="desk-top">
    <div class="desk-top-content">&nbsp;
        <div ng-ui-draggable='{"stop-broadcast":"label-drag-end","containment":"parent"}' class="desk-top-label" ng-repeat="label in labels" data-id="{{$index}}">
            <div class="icon"></div>
            <div>{{label.name}}</div>
        </div>
        <?php
        include 'tpl/proj-list2.php';
        include 'tpl/proj-card.php';
        include 'tpl/employee-list.php';

        ?>
<ul id="start-menu" ng-show="visibleStartMenu">
    <li ng-repeat="item in startMenu" class="start-menu-item" ng-click="mainMenuClick(item)">
        {{item.name}}
    </li>
</ul>
</div>
<div class="desk-top-task-bar">
    <div class="start-btn"><button ng-click="showStartMenu()">Start</button></div>
    <div class="task-bar">
        <div class="task-button" ng-repeat="task in tasks">
            <div ng-click="winMinimize(task.code,task.id)" data-code="{{task.code}}" data-id="{{task.id}}" class="task-name">{{task.name}}</div>
            <div ng-click="winClose(task.code,task.id)" class="task-close"></div>
        </div>
    </div>
</div>
</div>
</body>
</html>