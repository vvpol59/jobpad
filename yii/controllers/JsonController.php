<?php
/**
 * Обработчик json запросов
 * User: vvpol
 * Date: 25.11.2016
 * Time: 22:35
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;


class JsonController extends Controller {
    public function actionIndex(){
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
            } elseif ($request['method'] = 'getEnvData'){  // Загрузка окружения пользователя
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

} 