<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


/**
 * This is the model class for table "jobpad_users".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $role
 * @property integer $deleted
 * @property string $reg_date
 * @property string last_visit
 * @property integer $status
 */
class Users extends ActiveRecord implements IdentityInterface
{
  //  public $email;
  //  public $password;
  //  public $password2;
 //   public $name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jobpad_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['email', 'name', 'password', 'password2'], 'required'],
    //        [['password2'], 'validateConfirmPsw', 'message' => 'Не совпадает подтверждение пароля'],
            ['password', 'compare', 'compareAttribute' => 'password2', 'on' => 'register'],
            [['name', 'email', 'password', 'role'], 'required'],
            [['email'], 'email'],
            [['deleted', 'status'], 'integer'],
            [['reg_date', 'last_visit'], 'safe'],
            [['name', 'email'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 64],
            [['role'], 'string', 'max' => 10],
            [['name', 'email', 'password', 'role'], 'safe']
        ];
    }

    public function scenarios() {
        return [
            'login' => ['email', 'password'],
            'register' => ['email', 'password', 'password2', 'name']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {

        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'role' => Yii::t('app', 'Role'),
            'deleted' => Yii::t('app', 'Deleted'),
            'reg_date' => Yii::t('app', 'Reg Date'),
            'last_visit' => Yii::t('app', 'Last visit date'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function login($params){
        $model = new Users(['scenario' => 'login']);
        $model['email'] = $params['email'];
        $model['password'] = $params['password'];
        if ($model->validate()){
            $user = Users::find()->where([
            'email' => $params['email'],
            'password' => md5($params['password'])
            ])->all();
            if (sizeOf($user) == 1){
                Yii::$app->user->login($user[0]);
            } else {
                return ['validateErr' => 'Неверный email или пароль:'];
            }
        } else {
            return ['error' => $model->getErrors()];
        }
        return ['user' => ['name' => $user[0]->name]];
    }

    public static function register($params){
        $model = new Users(['scenario' => 'register']);
        $model->email = $params['email'];
        $model->password = $params['password'];
        $model->password2 = $params['password2'];
        $model->name = $params['name'];
        if ($model->validate()){
            $sql = 'insert into `jobpad_users` (`email`, `name`, `password`, `role`) values(:email, :name, :password, :role)';
            $command = Yii::$app->db->createCommand($sql);
            $command->bindValues([
                ':email' => $params['email'],
                ':name' => $params['name'],
                ':password' => md5($params['password']),
                ':role' => 'adm'
            ]);
            $result = $command->execute();



            //   $model->password = md5($params['password']);
           // $model->save();

            return $result ? 'ok' : '';
        } else {
            return ['error' => $model->getErrors()];
        }
    }

    public static function findIdentity($id){
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){
      //  throw new NotSupportedException();//I don't implement this method because I don't have any access token column in my database
    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){
        return $this->authKey;//Here I return a value of my authKey column
    }

    public function validateAuthKey($authKey){
        return $this->authKey === $authKey;
    }
    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);
    }

    public function validatePassword($password){
        return true;  //$this->password === $password;
    }

    /**
     * @inheritdoc
     * @return JobpadUsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobpadUsersQuery(get_called_class());
    }


}