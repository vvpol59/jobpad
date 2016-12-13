<?php
/**
 *
 * User: vvpol
 * Date: 13.12.2016
 * Time: 23:56
 */
namespace app\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property integer $id
 * @property string $title
 * @property string $created
 * @property string $content
 * @property integer $status
 *
 * @property Comments[] $comments
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'created', 'content'], 'required'],
            [['id', 'status'], 'integer'],
            [['created'], 'safe'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'created' => Yii::t('app', 'Created'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', '0 - редактируется, 1 - доступен, 2 - удалён'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['article_id' => 'id']);
    }
}