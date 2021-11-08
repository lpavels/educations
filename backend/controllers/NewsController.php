<?php

namespace backend\controllers;

use common\models\NewsCategory;
use common\models\News;
use common\models\ThemeTrainingProgram;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class NewsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['news-index','news-create','news-update','news-delete','category-index','category-create','category-update','category-delete'],
                        'allow' => true,
                        'matchCallback' => function(){return Yii::$app->compModel->checkUserRole('admin') == 1;}, #администратор
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    Yii::$app->session->setFlash('error', 'У вас нет доступа к данной странице');
                    $this->goHome();
                }
            ],
        ];
    }

    public function actionNewsIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('news-index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNewsCreate()
    {
        $model = new News();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                Yii::$app->compModel->userLog(Yii::$app->user->id,Yii::$app->user->id,'news',$model->id,'Добавление новости');
                Yii::$app->session->setFlash('success', 'Новость добавлена.');
                return $this->redirect(['/news-index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('news-create', [
            'model' => $model,
        ]);
    }

    public function actionNewsUpdate($id)
    {
        $model = $this->findModelNews($id);
        $modelThemeProgram = new ThemeTrainingProgram();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            Yii::$app->compModel->userLog(Yii::$app->user->id,Yii::$app->user->id,'news',$model->id,'Редактирование новости');
            return $this->redirect(['/news']);
        }

        return $this->render('news-update', [
            'model' => $model,
            'modelThemeProgram' => $modelThemeProgram,
        ]);
    }

    public function actionNewsDelete($id)
    {
        Yii::$app->compModel->userLog(Yii::$app->user->id,Yii::$app->user->id,'news',$id,'Удаление новости');
        $this->findModelNews($id)->delete();

        return $this->redirect(['/news']);
    }

    /**
     * Lists all NewsCategory models.
     * @return mixed
     */
    public function actionCategoryIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => NewsCategory::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('news-category-index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NewsCategory model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/

    /**
     * Creates a new NewsCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCategoryCreate()
    {
        $model = new NewsCategory();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                Yii::$app->compModel->userLog(Yii::$app->user->id,Yii::$app->user->id,'news_category',$model->id,'Добавление новостной категории');
                return $this->redirect(['/news-category']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('news-category-create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NewsCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCategoryUpdate($id)
    {
        $model = $this->findModelCategory($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            Yii::$app->compModel->userLog(Yii::$app->user->id,Yii::$app->user->id,'news_category',$model->id,'Редактирование новостной категории');
            return $this->redirect(['/news-category']);
        }

        return $this->render('news-category-update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NewsCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCategoryDelete($id)
    {
        Yii::$app->compModel->userLog(Yii::$app->user->id,Yii::$app->user->id,'news_category',$id,'Удаление новостной категории');
        $this->findModelCategory($id)->delete();

        return $this->redirect(['/news-category']);
    }

    /**
     * Finds the NewsCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return NewsCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelCategory($id)
    {
        if (($model = NewsCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelNews($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
