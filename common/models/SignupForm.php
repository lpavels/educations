<?php

namespace common\models;

use Yii;
use yii\base\BaseObject;
use yii\base\Model;
use yii\db\Exception;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirm_password;
    public $check;


    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Имя пользователя обязательно для заполнения'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Имя пользователя уже занято'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message' => 'Электронная почта обязательна для заполнения'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Электронная почта уже используется'],

            ['password', 'trim'],
            ['password', 'required', 'message' => 'Пароль обязателен для заполнения'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['confirm_password', 'trim'],
            ['confirm_password', 'required', 'message' => 'Подтверждение пароля обязательно для заполнения'],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],

            ['check', 'compare', 'compareValue' => 1, 'message' => 'Необходимо согласие с пользовательским соглашением'],
        ];
    }

    public function signup()
    {
        if (!$this->validate())
        {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        return $user->save() && $this->sendConfirmEmail($user);
    }

    protected function sendConfirmEmail($user)
    {
        try {
            $message = Yii::$app->mailer->compose(
                    ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                    ['user' => $user])
                ->setTo($user->email)
                ->setFrom(Yii::$app->params['senderEmail'])
                ->setSubject('Подтвердите регистрацию на сайте')
                ->send();
            if (!$message){
                throw new \Swift_TransportException('Письмо недоставлено.');
            }

            Yii::$app->compModel->userLog($user->id,$user->id,'user',$user->id,'Регистрация пользователя');

            return true;
        } catch (\Swift_TransportException $error){
            User::findOne($user->id)->delete();
            Yii::$app->session->setFlash('error', 'Введена несуществующая электронная почта');

            return false;
        }
    }

    public function forgotPassword($user){

        $user->generatePasswordResetToken();
        return $user->save() && $this->sendConfirmResetPassword($user);
    }

    protected function sendConfirmResetPassword($user)
    {
        try {
            $message = Yii::$app->mailer->compose(
                    ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                    ['user' => $user])
                ->setTo($user->email)
                ->setFrom(Yii::$app->params['senderEmail'])
                ->setSubject('Изменение пароля')
                ->send();
            if (!$message){
                throw new \Swift_TransportException('Письмо недоставлено.');
            }

            return true;
        } catch (\Swift_TransportException $error){
            Yii::$app->session->setFlash('error', 'Ошибка отправки ссылки для сброса пароля на электронную почту');

            return false;
        }
    }

    public function resetPassword($user)
    {
        $user->setPassword($this->password);//изменение пароля
        $user->generateAuthKey(); //изменение auth_key для выхода со всех устройств
        $user->removePasswordResetToken();

        Yii::$app->compModel->userLog($user->id,$user->id,'user',$user->id,'Изменение пароля через раздел "Забыли пароль"');
        return $user->save(false);
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'confirm_password' => 'Подтвердите пароль',
            'check' => ''
            //'check' => 'Регистрируясь, вы соглашаетесь с "<a href="#"> Условиями использования</a>"',
        ];
    }
}
