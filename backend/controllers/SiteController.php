<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\SignupForm;
use common\models\User;
use common\models\UsersLog;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','login','signup','welcome','email-confirm','confirm-email','forgot-password','reset-password','confirm-password'],
                        'allow' => true,
                        'roles' => ['?'], #гость
                    ],
                    [
                        'actions' => ['logout','error','index-auth','index'],
                        'allow' => true,
                        'roles' => ['@'], #авторизованный пользователь
                    ],
                ],
            ],
            //'verbs' => [
            //    'class' => VerbFilter::className(),
            //    'actions' => [
            //        'logout' => ['post'],
            //    ],
            //],
        ];
    }

    public function actions()
    {
        if (!Yii::$app->user->isGuest) return $this->actionIndexAuth();
        else return $this->actionIndexAuth();

        //return [
        //    'error' => [
        //        'class' => 'yii\web\ErrorAction',
        //    ],
        //];
    }

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest)
        {
            return $this->actionIndexAuth();
        }

        $this->layout = 'guest';
        return $this->render('index');
    }

    public function actionIndexAuth()
    {
        if (Yii::$app->user->isGuest)
        {
            return $this->actionIndex();
        }
        //$model = News::findAll();

        $this->layout = 'main';
        return $this->render('index-auth');
    }

    public function actionSignup() #страница регистрации
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

    public function actionWelcome() #страница добро пожаловать
    {
        $this->layout = 'window';

        return $this->render('welcome');
    }

    public function actionEmailConfirm($username, $token) //подтверждение почты
    {
        $user = User::findOne(['username' => $username, 'verification_token' => $token]);
        if (!$user)
        {
            Yii::$app->session->setFlash('warning', 'Произошла ошибка, ссылка недействительна');
            return $this->actionConfirmEmail();
        }

        $user->verification_token = null;
        $user->status = User::STATUS_ACTIVE;
        $user->auth_item_id = User::ROLE_DEFAULT;
        if (!$user->save())
        {
            Yii::$app->session->setFlash('error', 'Произошла ошибка');
            return $this->actionConfirmEmail();
        }

        $userLog = new UsersLog();
        $userLog->user_id=Yii::$app->user->id;
        $userLog->user=Yii::$app->user->id;
        $userLog->table='user';
        $userLog->primary_key=$user->id;
        $userLog->comment='Электронная почта подтверждена и назначена роль пользователя';
        $userLog->save();

        Yii::$app->session->setFlash('success', 'Электронная почта подтверждена');
        return $this->actionConfirmEmail();
    }

    public function actionLogin() #страница авторизации
    {
        $this->layout = 'window';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
            return $this->goBack();
        }
        elseif ($model->load(Yii::$app->request->post()) && !$model->login())
        {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
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
            elseif ($post['username'] == '' && $post['email'] == '')
            {
                Yii::$app->session->setFlash('error', 'Вы не ввели логин или электронную почту');
                return $this->redirect('forgot-password');
            }
            else throw new \Exception('Произошла ошибка.');

            if (!$user)
            {
                Yii::$app->session->setFlash('error', 'Пользователь не найден.');
                return $this->redirect('forgot-password');
            }

            $hideEmail = substr($user->email, 0, 3) . '******' . substr($user->email, -8, strpos($user->email, '@')); #скрытие полного адреса электронной почты

            $model->forgotPassword($user);

            return $this->actionConfirmPassword(1, $hideEmail);
        }

        return $this->render('forgot-password', [
            'model' => $model
        ]);
    }

    public function actionResetPassword($username, $token) //страница изменения пароля
    {
        $this->layout = 'window';

        $user = User::findOne(['username' => $username, 'password_reset_token' => $token]);
        if (!$user)
        {
            Yii::$app->session->setFlash('warning', 'Произошла ошибка, ссылка недействительна');
            return $this->actionConfirmPassword(2);
        }

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->resetPassword($user))
        {
            Yii::$app->session->setFlash('success', 'Пароль изменён.');
            return $this->actionConfirmPassword(3);
        }

        return $this->render('reset-password',
            ['model' => $model]);
    }

    public function actionConfirmPassword($status = 1, $hideEmail = false) //confirm password
    {
        $this->layout = 'window';

        if ($status == 1)
        {
            Yii::$app->session->setFlash('success2', 'На ' . $hideEmail . ' была отправлена интрукция по смене пароля.');
        }
        elseif ($status == 2)
        {
            Yii::$app->session->setFlash('warning', 'Ссылка недействительна.');
        }
        elseif ($status == 3)
        {
            Yii::$app->session->setFlash('success', 'Пароль изменён.');
        }
        else
        {
            Yii::$app->session->setFlash('error', 'Произошла ошибка.');
        }

        return $this->render('confirm-password', ['hideEmail' => $hideEmail]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
