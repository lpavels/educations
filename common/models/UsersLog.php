<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users_log".
 *
 * @property int $id
 * @property int $user_id
 * @property int $user
 * @property string $table
 * @property int $primary_key
 * @property string $comment
 * @property string $created_at
 *
 * @property User $user0
 */
class UsersLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'user', 'table', 'primary_key', 'comment', 'created_at'], 'required'],
            [['user_id', 'user', 'primary_key'], 'integer'],
            [['created_at'], 'safe'],
            [['table', 'comment'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'user' => 'User',
            'table' => 'Table',
            'primary_key' => 'Primary Key',
            'comment' => 'Comment',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
