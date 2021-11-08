<?php


namespace common\models;

use common\models\AuthItem;
use common\models\User;
use Yii;

class componentModel
{
    public static function checkUserRole($role) #Проверка указанной роли для доступа к actions
    {
        $roleId = AuthItem::findOne(['name' => $role])->id;

        if(Yii::$app->user->isGuest) $allow = false;
        elseif (User::findOne(Yii::$app->user->id)->auth_item_id === $roleId) $allow = true;
        else $allow = false;

        return $allow;
    }

    public static function getUserRole() #Роль авторизованного пользователя (description)
    {
        return AuthItem::findOne(Yii::$app->user->identity->auth_item_id)->description;
    }

    public function get_ip() #Получение ip адреса авторизованного пользователя
    {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = @$_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif (filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else $ip = $remote;

        return $ip;
    }

    public function blockedUser($user,$reason,$comment,$status) #Блокировка/разблокировка пользователя (0 - разблокирован, 1 - заблокирован)
    {
        $blockedUser = new BlockedUsers();
        $blockedUser->user_id=Yii::$app->user->id;
        $blockedUser->user=$user;
        $blockedUser->reason=$reason;
        $blockedUser->comment=$comment;
        $blockedUser->status=$status;
        $blockedUser->save();
    }

    public function userLog($user_id,$user,$table,$primary_key,$comment) #Сохранение действия пользователя
    {
        $userLog = new UsersLog();
        $userLog->user_id=$user_id;
        $userLog->user=$user;
        $userLog->table=$table;
        $userLog->primary_key=$primary_key;
        $userLog->comment=$comment;
        $userLog->created_ip=$this->get_ip();
        $userLog->save();
    }



    public function getStatus($id=null) #Статус отображения (поле "Статус")
    {
        $status = [
            ''=>'Выберите значение',
            '0'=>'Не выводится',
            '1'=>'Выводится',
        ];

        if (isset($id))
        {
            $status = $status[$id];
        }

        return $status;
    }
}