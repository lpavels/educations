<?php

namespace backend\components;


use common\models\AuthItem;
use common\models\User;
use Yii;


class userHelp extends User
{
    public static function getUserRole($role)
    {
        $roleId = AuthItem::findOne(['name' => $role])->id;

        if (User::findOne(Yii::$app->user->id)->auth_item_id === $roleId) $allow = true;
        else $allow = false;

        return $allow;
    }
}