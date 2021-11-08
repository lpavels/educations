<?php

namespace backend\controllers;

use common\models\ThemeTrainingProgram;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TrainingController implements the CRUD actions for ThemeTrainingProgram model.
 */
class TrainingController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['theme-program-index','theme-program-create','theme-program-update','theme-program-delete'],
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

    /**
     * Lists all ThemeTrainingProgram models.
     * @return mixed
     */
    public function actionThemeProgramIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ThemeTrainingProgram::find(),
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

        return $this->render('theme-program-index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new ThemeTrainingProgram model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionThemeProgramCreate()
    {
        $model = new ThemeTrainingProgram();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                Yii::$app->compModel->userLog(Yii::$app->user->id,Yii::$app->user->id,'theme_training_program',$model->id,'Добавление темы обучающей программы');
                return $this->redirect(['/training-theme-program']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('theme-program-create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ThemeTrainingProgram model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionThemeProgramUpdate($id)
    {
        $model = $this->findModelThemProgram($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            Yii::$app->compModel->userLog(Yii::$app->user->id,Yii::$app->user->id,'theme_training_program',$model->id,'Редактирование темы обучающей программы');
            return $this->redirect(['/training-theme-program']);
        }

        return $this->render('theme-program-update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ThemeTrainingProgram model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionThemeProgramDelete($id)
    {
        Yii::$app->compModel->userLog(Yii::$app->user->id,Yii::$app->user->id,'theme_training_program',$id,'Удаление темы обучающей программы');
        $this->findModelThemProgram($id)->delete();

        return $this->redirect(['/training-theme-program']);
    }

    /**
     * Finds the ThemeTrainingProgram model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ThemeTrainingProgram the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelThemProgram($id)
    {
        if (($model = ThemeTrainingProgram::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }



    /**
     * Displays a single ThemeTrainingProgram model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModelThemProgram($id),
        ]);
    }*/

}
