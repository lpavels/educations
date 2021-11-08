<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required', 'message' => 'Поле обязательно для заполнения'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword', 'message' => 'Поле обязательно для заполнения'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user){
                $this->addError($attribute, 'Неверный логин или пароль.');
            } elseif ($user == User::STATUS_INACTIVE){
                Yii::$app->session->setFlash('error', 'Подтвердите электронную почту');
                $this->addError($attribute, 'Подтвердите электронную почту');
            } elseif ($user == User::STATUS_BLOCKED){
                $reason = BlockedUsers::findOne(['user_id'=>$user->id,'status'=>1])->orderBy(['id'=>SORT_DESC])->reason;
                Yii::$app->session->setFlash('error', 'Аккаунт заблокирован за ' .$reason);
                $this->addError($attribute, 'Аккаунт заблокирован');
            } elseif ($user == User::STATUS_DELETED){
                Yii::$app->session->setFlash('error', 'Пользователь отозвал согласие на обработку персональных данных.');
                $this->addError($attribute, 'Аккаунт заблокирован.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
