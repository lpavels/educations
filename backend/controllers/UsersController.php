<?php


namespace backend\controllers;

use common\models\AuthItem;
use common\models\UsersSearch;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class UsersController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['special-callback'],
                'rules' => [
                    //[
                    //    'actions' => ['special'],
                    //    'allow' => true,
                    //    'roles' => ['?'], #гость
                    //],
                    //[
                    //    'actions' => ['special'],
                    //    'allow' => true,
                    //    'roles' => ['@'], #авторизованный пользователь
                    //],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'matchCallback' => function(){return Yii::$app->userHelp->getUserRole('admin') == 1;}, #администратор
                    ],
                    //[
                    //    'actions' => ['special-callback'], #название функции
                    //    'allow' => true,
                    //    'matchCallback' => function ($rule, $action) {
                    //        return date('d-m') === '31-10'; #выполняется только 31 октября
                    //    }
                    //],
                ],
                'denyCallback' => function ($rule, $action) {
                    throw new \Error('У вас нет доступа к этой странице');
                }
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new UsersSearch();

        $search = Yii::$app->request->queryParams;

        $dataProvider = $model->search($search);

        $userRole_item = ArrayHelper::map(AuthItem::find()->all(), 'id', 'description');#получаем все существующие роли

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'userRole_item' => $userRole_item,
        ]);
    }

    public function actionIndex2()
    {
        $model = new UsersSearch();

        $search = Yii::$app->request->queryParams;

        $dataProvider = $model->search($search);

        $userRole_item = ArrayHelper::map(AuthItem::find()->all(), 'id', 'description');#получаем все существующие роли

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'userRole_item' => $userRole_item,
        ]);
    }

    //public function actionLogin($id){ #авторизация под другим пользователем (для админа)
    //    $model = User::findOne($id);
    //    Yii::$app->user->login($model);
    //    return $this->redirect(['site/index']);
    //}
}