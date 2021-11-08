<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blocked_users".
 *
 * @property int $id
 * @property int $user_id Кто за-/разблокировал
 * @property int $user Кто за-/разблокирован
 * @property string $reason Причина раз-/блокировки
 * @property string $comment Комментарий для администрации
 * @property int $status 0 - разблокирован, 1 - заблокирован
 * @property string $created_at
 *
 * @property User $user0
 * @property User $user1
 */
class BlockedUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blocked_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'user', 'reason', 'comment', 'status'], 'required'],
            [['user_id', 'user', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['reason', 'comment'], 'string', 'max' => 255],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user' => 'id']],
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
            'reason' => 'Reason',
            'comment' => 'Comment',
            'status' => 'Status',
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
        return $this->hasOne(User::className(), ['id' => 'user']);
    }

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
