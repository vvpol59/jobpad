<?php
/**
 * Created by PhpStorm.
 * User: vvpok
 * Date: 21.11.2016
 * Time: 10:04
 */

namespace app\controllers;
use Yii;
//use yii\filters\AccessControl;
use yii\web\Controller;
//use yii\filters\VerbFilter;
use app\models\LoginFrm;
use app\models\User;
use yii\web\View;
//use app\models\ContactForm;


class MainController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
/*
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
         //       'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
*/
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        //    'captcha' => [
        //        'class' => 'yii\captcha\CaptchaAction',
        //        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
        //    ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
      //  return 'test';

      //  $model = new LoginFrm();
      //  if ($model->load(Yii::$app->request->post()) && $model->login()) {
      //      return $this->goBack();
      //  }
        return $this->render('main', ['js' => [
            'angular/angular-1.2.30.js',
            'js/login-ctrl.js',
            'js/job-pad-services.js'
        ]]);
    }

    public function actionJsonrpc(){
        try {
            $request = json_decode(file_get_contents('php://input'), true);
            $params = $request['params'];
            $result = 'undefined';
            if ($request['method'] == 'register'){ // Регистрация пользователя
                $sql = 'insert into `users` (`email`, `name`, `password`, `role`) values(:email, :name, :password, :role)';
                $command = Yii::$app->db->createCommand($sql);
                $command->bindValues([
                    ':email' => $params['email'],
                    ':name' => $params['name'],
                    ':password' => password_hash($params['password'], PASSWORD_DEFAULT),
                    ':role' => 'adm'
                ]);
                $result = $command->execute();
            } elseif ($request['method'] == 'login'){ // авторизация

                Yii::$app->user->login('123');
/*
                Yii::$app->user->login([
                    'id' => '100',
                    'username' => 'admin',
                    'password' => 'admin',
                    'authKey' => 'test100key',
                    'accessToken' => '100-token',
                ]);
                */
                $sql = 'select * from `users` where `password` = :password and `email` = :email';
                $command = Yii::$app->db->createCommand($sql);
                $res = $command->bindValues([
                    ':password' => password_hash($params['password'], PASSWORD_DEFAULT),
                    ':email' => $params['email']
                ])->queryAll();
                if (sizeof($res != 1)){
                    throw new \Exception('Неверный пароль или e-mail');
                }
            }
            return json_encode([
                "jsonrpc" => "2.0",
                "result" => $result,
                "id" => "1",
                "d" => Yii::$app->user->isGuest
                ]);
        //    return file_get_contents('php://input');
        } catch (\Exception $e) {
            return json_encode([
                "jsonrpc" => "2.0",
                "error" => $e->getMessage(),
                "dump" => Yii::$app->user->isGuest,
                "id" => "1"
            ]);
        }
    }


    /**
     * Login action.
     *
     * @return string
     */

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginFrm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
/*
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
*/
    /**
     * Displays contact page.
     *
     * @return string
     */
/*
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
*/
    /**
     * Displays about page.
     *
     * @return string
     */
/*
    public function actionAbout()
    {
        return $this->render('about');
    }
*/
} 