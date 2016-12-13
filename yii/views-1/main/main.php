<?php
/**
 *
 * User: vvpol
 * Date: 21.11.2016
 * Time: 10:13
 */
//use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;

$this->title = 'Мой сайт';
if (isset($js)){
    for ($i = 0; $i < sizeof($js); $i++){
        $this->registerJsFile($js[$i],  ['position' => yii\web\View::POS_HEAD]);    }
}

?>
<!--

<?php print_r(Yii::$app->user->identity); ?>

-->
<div style="color:red"><?= Yii::$app->user->isGuest ?></div>
<div ng-controller="loginCtrl" style="padding-top: 64px">
    <div style="padding: 20px">
        <form name="login">
            <div>
                email: <input ng-model="log.username" type="text" required="true" value="admin">
            </div>
            <div>
                password: <input ng-model="log.password" type="password" required="true">
            </div>
            <div>
                <button type="submit" ng-click="save(log, login)">Войти</button>
            </div>
        </form>

        <form name="register">
            <div>
                Имя: <input ng-model="data.name" type="text" required="true">
            </div>
            <div>
                email: <input ng-model="data.email" type="email" required="true">
            </div>
            <div>
                Пароль: <input ng-model="data.password" type="password" required="true">
            </div>
            <div>
                Повтор пароля: <input ng-model="data.password2" type="password" required="true">
            </div>
            <div>
                <button type="submit" ng-click="reg(data, register)">Регистрация</button>
            </div>
        </form>



        <!-- ?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\"></div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]); ?>
        < = $form->field($model, 'email')->textInput() ?>
        < = $form->field($model, 'password')->passwordInput() ?>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                < = Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        < ?php ActiveForm::end(); ? -->

    </div>
    <!-- div style="padding: 20px">
        <!-- ?php $form = ActiveForm::begin([
            'id' => 'authorise',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]); ? -->
        <!-- div><button ng-click="save(data, authorise)">Зарегистрироваться</button></div -->
        <!-- ?php ActiveForm::end(); ? -->
    <!-- /div -->
</div>
