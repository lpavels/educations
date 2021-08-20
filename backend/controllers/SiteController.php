<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\SignupForm;
use Yii;
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
                        'actions' => ['login','signup','index'],
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
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        elseif (Yii::$app->request->post()){
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
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            return $this->goHome();
        }
        elseif (Yii::$app->request->post()){
            print_r(Yii::$app->request->post());
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


}
