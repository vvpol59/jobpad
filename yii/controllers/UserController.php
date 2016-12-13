<?php
/**
 * Created by PhpStorm.
 * User: vvpok
 * Date: 12.12.2016
 * Time: 18:19
 */

namespace app\controllers;
use yii\rest\ActiveController;
//use app\models\User;

class UserController extends ActiveController {
    public $modelClass = 'app\models\User';

    public function behaviors()
    {
        return
            \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
                'corsFilter' => [
                    'class' => \yii\filters\Cors::className(),
                ],
            ]);
    }

  /*
    public function actionView($id)
    {

        $model=$this->findModel($id);

        $this->setHeader(200);
        echo json_encode(array('status'=>1,'data'=>array_filter($model->attributes)),JSON_PRETTY_PRINT);

    }
    // function to find the requested record/model
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        } else {

            $this->setHeader(400);
            echo json_encode(array('status'=>0,'error_code'=>400,'message'=>'Bad request'),JSON_PRETTY_PRINT);
            exit;
        }
    }
*/
} 