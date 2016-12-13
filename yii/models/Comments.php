<?php
/**
 *
 * User: vvpol
 * Date: 13.12.2016
 * Time: 23:11
 */

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $article_id
 * @property string $comment
 * @property string $author_name
 * @property string $author_email
 * @property string $date_comment
 */
class Comments extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'comment', 'date_comment'], 'required'],
            [['article_id', 'status'], 'integer'],
            [['comment'], 'string'],
            [['date_comment'], 'safe'],
            [['author_name', 'author_email'], 'string', 'max' => 50],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Articles::className(), 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'article_id' => Yii::t('app', 'Article ID'),
            'comment' => Yii::t('app', 'Comment'),
            'author_name' => Yii::t('app', 'Author Name'),
            'author_email' => Yii::t('app', 'Author Email'),
            'date_comment' => Yii::t('app', 'Date Comment'),
            'status' => Yii::t('app', '0 - не отмодерирован, 1 - отмодерирован, 2 - скрыт'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Articles::className(), ['id' => 'article_id']);
    }
}
