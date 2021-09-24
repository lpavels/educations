<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blocked_users".
 *
 * @property int $id
 * @property int $user_id Кто за-/разблокирован
 * @property string $reason Причина раз-/блокировки
 * @property string $comment Комментарий для администрации
 * @property int $status 0 - разблокирован, 1 - заблокирован
 * @property string $created_at
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
            [['user_id', 'reason', 'comment', 'status'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['reason', 'comment'], 'string', 'max' => 255],
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
            'reason' => 'Reason',
            'comment' => 'Comment',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
