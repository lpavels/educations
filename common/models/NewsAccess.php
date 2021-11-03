<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news_access".
 *
 * @property int $id
 * @property int $news_id
 * @property int $auth_item_id
 * @property string $created_at
 *
 * @property AuthItem $authItem
 * @property News $news
 */
class NewsAccess extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news_access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['news_id', 'auth_item_id'], 'required'],
            [['news_id', 'auth_item_id'], 'integer'],
            [['created_at'], 'safe'],
            [['auth_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => AuthItem::className(), 'targetAttribute' => ['auth_item_id' => 'id']],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'news_id' => 'News ID',
            'auth_item_id' => 'Auth Item ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[AuthItem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItem()
    {
        return $this->hasOne(AuthItem::className(), ['id' => 'auth_item_id']);
    }

    /**
     * Gets query for [[News]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['id' => 'news_id']);
    }
}
