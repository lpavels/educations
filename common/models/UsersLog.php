<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users_log".
 *
 * @property int $id
 * @property int $user_id Какой пользователь
 * @property int $user Какому пользователю
 * @property string $table Название таблицы
 * @property int $primary_key id записи в таблице
 * @property string $comment
 * @property string $created_at
 * @property string $created_ip
 *
 * @property User $user0
 * @property User $user1
 * @property User $user2
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
            [['user_id', 'user', 'table', 'primary_key', 'comment', 'created_ip'], 'required'],
            [['user_id', 'user', 'primary_key'], 'integer'],
            [['created_at'], 'safe'],
            [['table', 'comment'], 'string', 'max' => 255],
            [['created_ip'], 'string', 'max' => 15],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'table' => 'Table',
            'primary_key' => 'Primary Key',
            'comment' => 'Comment',
            'created_at' => 'Created At',
            'created_ip' => 'Created Ip',
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

    /**
     * Gets query for [[User1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser1()
    {
        return $this->hasOne(User::className(), ['id' => 'user']);
    }

    /**
     * Gets query for [[User2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser2()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
