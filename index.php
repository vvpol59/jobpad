<?php
/**
 * User: vvpol
 * Date: 28.09.2016
 * Time: 21:48
 */
?>
<!DOCTYPE html>
<html ng-app="jobpadApp">
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="ng-ui-dialog/ng-ui-dialog.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/job-pad.css">
    <script src="angular/angular-1.2.30.js"></script>
    <script src="ng-ui-dialog/ng-ui-dialog.js"></script>
    <script src="js/job-pad.js"></script>
    <script src="js/job-pad-services.js"></script>
</head>
<body ng-controller="jobPadController">
<div class="desk-top">
    <ul id="start-menu" ng-show="visibleStartMenu">
        <li ng-repeat="item in startMenu" class="start-menu-item">
            {{item.name}}
        </li>
    </ul>
    <div class="desk-top-content">
        <?php
        include 'tpl/proj-list.php';
        include 'tpl/proj-card.php';

        ?>
    </div>
    <div class="desk-top-task-bar">
        <div class="start-btn"><button ng-click="showStartMenu()">Start</button></div>
        <div class="task-bar"></div>
    </div>
</div>
</body>
</html>