<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "auth_item".
 *
 * @property int $id
 * @property string $name Название роли
 * @property string $description Описание роли
 * @property int $status Статус роли (0-неактивна/1-активна)
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property NewsAccess[] $newsAccesses
 * @property User[] $users
 */
class AuthItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[NewsAccesses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewsAccesses()
    {
        return $this->hasMany(NewsAccess::className(), ['auth_item_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['auth_item_id' => 'id']);
    }
}
