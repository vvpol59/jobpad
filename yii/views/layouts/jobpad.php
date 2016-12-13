<?php
/**
 *
 * User: vvpol
 * Date: 25.11.2016
 * Time: 0:25
 */

use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="jobpadApp">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>jobpad</title>
    <?php $this->head() ?>
</head>
<body ng-controller="jobPadController">
<?php $this->beginBody() ?>

<div class="desk-top">
    <div class="desk-top-content">&nbsp;
        <div ng-ui-draggable='{"stop-broadcast":"label-drag-end","containment":"parent"}' class="desk-top-label" ng-repeat="label in labels" data-id="{{$index}}">
            <div class="icon"></div>
            <div>{{label.name}}</div>
        </div>
        <?php
        include 'tpl/proj-list.php';  // Список проектов и карточка проекта
     //   include 'tpl/proj-card.php';
     //   include 'tpl/employee-list.php';
        include 'tpl/login-form.php';
        ?>
        <ul id="start-menu" ng-show="visibleStartMenu">
            <li ng-repeat="item in startMenu" class="start-menu-item" ng-click="mainMenuClick(item)">
                {{item.name}}
            </li>
            <li class="start-menu-item" ng-click="logout()">Выход</li>
        </ul>
    </div>
    <div class="desk-top-task-bar">
        <div class="start-btn"><button ng-click="showStartMenu()">Start</button></div>
        <div class="task-bar">
            <div class="task-button" ng-repeat="task in tasks">
                <div ng-click="toggleWin(task)" data-code="{{task.code}}" data-id="{{task.id}}" class="task-name">{{task.title}}</div>
                <div ng-click="closeWin(task)" class="task-close"></div>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
