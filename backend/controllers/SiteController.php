<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\SignupForm;
use common\models\User;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Yii;
use yii\base\Model;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

class SiteController extends Controller
{
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','signup','welcome','index'],
                        'allow' => true,
                        'roles' => ['?'], # гость
                    ],
                    [
                        'actions' => ['logout','error','index-auth'],
                        'allow' => true,
                        'roles' => ['@'], #авторизованный пользователь
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }*/

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'blank';
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = 'window';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            return $this->goBack();
        }
        elseif (Yii::$app->request->post())
        {
            Yii::$app->session->setFlash('error', 'Логин или пароль неверны');
        }
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        $this->layout = 'window';

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup())
        {
            return $this->actionWelcome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionWelcome()
    {
        $this->layout = 'window';

        return $this->render('welcome');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionEmailConfirm($username, $token) //подтверждение почты
    {
        $user = User::findOne(['username' => $username, 'email_confirm_token' => $token]);
        if (!$user)
        {
            Yii::$app->session->setFlash('warning', 'Произошла ошибка, ссылка недействительна');
            return $this->actionConfirmEmail();
        }

        $user->email_confirm_token = null;
        $user->status = User::STATUS_ACTIVE;
        if (!$user->save())
        {
            Yii::$app->session->setFlash('error', 'Произошла ошибка');
            return $this->actionConfirmEmail();
        }

        Yii::$app->session->setFlash('success', 'Электронная почта подтверждена');
        return $this->actionConfirmEmail();
    }

    public function actionConfirmEmail() //confirm email
    {
        $this->layout = 'window';
        return $this->render('confirm-email');
    }

    public function actionForgotPassword() //страница "забыли пароль?"
    {
        $this->layout = 'window';

        $model = new SignupForm();

        if ($post = Yii::$app->request->post()['SignupForm'])
        {
            if ($post['username'] != '' && $post['email'] != '')
            {
                $user = User::findOne(['username' => $post['username'], 'email' => $post['email']]);
            }
            elseif ($post['username'] != '')
            {
                $user = User::findOne(['username' => $post['username']]);
            }
            elseif ($post['email'] != '')
            {
                $user = User::findOne(['email' => $post['email']]);
            }
            else throw new \Exception('Произошла ошибка.');

            if (!$user) Yii::$app->session->setFlash('error', 'Пользователь не найден. Введите логин или электронную почту.');
            $hideEmail = substr($user->email, 0, 3) . '******' . substr($user->email, -8, strpos($user->email, '@')); #скрытие полного адреса электронной почты

            $model->forgotPassword($user);
            Yii::$app->session->setFlash('success2', 'На ' . $hideEmail . ' была отправлена интрукция по смене пароля.');

            return $this->actionConfirmPassword();
        }

        return $this->render('forgot-password', [
            'model' => $model
        ]);
    }

    public function actionResetPassword($username, $token) //страница изменения пароля
    {
        $this->layout='window';

        $user = User::findOne(['username' => $username, 'password_reset_token' => $token]);
        if (!$user)
        {
            Yii::$app->session->setFlash('warning', 'Произошла ошибка, ссылка недействительна');
            return $this->actionConfirmPassword();
        }

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->resetPassword($user))
        {
            Yii::$app->session->setFlash('success', 'Пароль изменён.');
            return $this->actionConfirmPassword();
        }

        return $this->render('reset-password',
            ['model'=>$model]);

    }

    public function actionConfirmPassword() //confirm password
    {
        $this->layout = 'window';
        return $this->render('confirm-password');
    }
}
