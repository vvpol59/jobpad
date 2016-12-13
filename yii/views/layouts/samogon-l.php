<?php
/**
 *
 * User: vvpol
 * Date: 13.12.2016
 * Time: 5:03
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div style="padding: 8px">
        <a href="/">Home</a> |
        <a href="/samogon/braga/par2">Брага</a> |
        <a href="equipment">Оборудование</a> |
    </div>

    <div class="container">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div style="color:red">|<!-- ?= Yii::$app->user->isGuest ? -->|</div>
    <!-- div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div -->
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
