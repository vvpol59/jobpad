<?php

namespace app\controllers;

use app\models\Users;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;


class SiteController extends Controller
{
  //  public $layout;
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'], // Принимать и post и get
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Главная страница
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Задачник
     * @return string
     */
    public function actionJobpad()
    {
        $user = new Users();
        $user->load([
            'frm' => [
                'name' => 'newUser',
                'email' => 'www2@www.ww',
                'password' =>  password_hash('123', PASSWORD_DEFAULT),
                'role' => 'adm'
            ]
        ], 'frm');
   //     $user->save();

        $this->layout = 'jobpad';
        return $this->render('jobpad');
    }

    public function actionSamogon(){
        $this->layout = 'samogon-l';
        return $this->render('samogon', ['p1' => 'xxx1', 'p2' => 'xxx2']);
    }

    /**
     * Показ статьи с комментариями
     * @param string $article
     * @param string $par
     * @return string
     */
    public function actionShow($article = 'p1 none', $par = 'p2 none'){
        $this->layout = 'samogon-l';

        return $this->render('article', ['p1' => $article, 'p2' => $par]);

    }

    /**
     * Обработка запроса на логин
     * @return string|\yii\web\Response
     */
    public function actionLogin(){
        if (!Yii::$app->user->isGuest) {  // уже залогинен. На дефаултную
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Разлогинивание
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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

    public function actionAbout()
    {
        return $this->render('about');
    }
*/
    /**
     * Обработчик json запросов
     * @return string
     */
/*
    public function actionJsonrpc(){
        try {
            $request = json_decode(file_get_contents('php://input'), true);
            $params = $request['params'];
           //#####################################################
            if ($request['method'] == 'register'){ // Регистрация пользователя
                if (Yii::$app->user->isGuest){
                    $result = (new Users())->register($params);
                } else {
                    throw new \Exception('Пользователь уже авторизован');
                }
            //######################################################
            } elseif ($request['method'] == 'login') { // авторизация
                if (Yii::$app->user->isGuest){
                    $result = (new Users())->login($params);
                } else {
                    throw new \Exception('Пользователь уже авторизован');
                }
            //######################################################
            } elseif ($request['method'] == 'getRole') {  // Проверить на авторизацию
                if (Yii::$app->user->isGuest) {
                    $result = 'no';
                } else {
                    $result = ['user' => [
                        'name' => Yii::$app->user->identity['name'],
                        'role' => Yii::$app->user->identity['role']
                    ]];
                }
            //############################################################
            } elseif ($request['method'] == 'logout') {  // Выход из системы
                Yii::$app->user->logout();
                $result = 'ok';
            //##############################################################
            } elseif ($request['method'] = 'getEnvData'){  // Загрузка окружения пользователяф
                if (Yii::$app->user->isGuest){
                    throw new \Exception('Пользователь не авторизован');
                }
                $role = Yii::$app->user->identity->role;
                if ($role == 'adm'){
                    $result = [
                        'menu' => [
                            ['name' => 'Сотрудники', 'code' => 'employee-list'],
                            ['name' => 'Проекты', 'code' => 'proj-list']
                        ]
                    ];
                }
            } else {
                throw new \Exception('Неизвестный метод ' . $request['method']);
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
*/
}
