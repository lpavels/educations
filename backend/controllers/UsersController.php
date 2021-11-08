<?php


namespace backend\controllers;

use common\models\AuthItem;
use common\models\BlockedUsers;
use common\models\User;
use common\models\UsersLog;
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
                'rules' => [
                    [
                        'actions' => ['index','modal-user','modal-log'],
                        'allow' => true,
                        'matchCallback' => function(){return Yii::$app->compModel->checkUserRole('admin') == 1;}, #администратор
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
                    Yii::$app->session->setFlash('error', 'У вас нет доступа к данной странице');
                    $this->goHome();
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

    public function actionModalUser($user_id,$username,$action) #Модальное окно на странице управления пользователями (блокировка/разблокировка/удаление)
    {
        $this->layout = false;

        $model = new BlockedUsers();
        $action_ar=[
            'Удаление пользователя: ',
            'Блокировка пользователя: ',
            'Разблокировка пользователя: ',
        ];

        if (Yii::$app->request->post()['apply']){
            $post = Yii::$app->request->post()['BlockedUsers'];

            $me_id = Yii::$app->user->id;
            if ($user_id==$me_id){
                Yii::$app->session->setFlash('error', 'Ошибка. Невозможно внести изменения в свой аккаунт');
                return $this->redirect('/users');
            }
            if ($post['reason']==''|| $post['comment']==''){
                Yii::$app->session->setFlash('error', 'Ошибка. Не заполнена причина или комментарий');
                return $this->redirect('/users');
            }

            if ($action==0){
                $model = User::findOne($user_id);
                if ($model->status==0){
                    Yii::$app->session->setFlash('error', 'Ошибка. Пользователю уже присвоен данный статус');
                    return $this->redirect('/users');
                }
                elseif ($model->status==9){
                    Yii::$app->session->setFlash('error', 'Ошибка. Невозможно присвоить данный статус неподтвержденному пользователю');
                    return $this->redirect('/users');
                }
                $model->deleteUser();

                Yii::$app->compModel->blockedUser($model->id,$post['reason'],$post['comment'],$post['status']);
                Yii::$app->compModel->userLog($me_id,$model->id,'user',$model->id,'Удаление пользователя');
                return $this->redirect('/users');
            }elseif ($action==1){
                $model = User::findOne($user_id);
                if ($model->status==0 || $model->status==5){
                    Yii::$app->session->setFlash('error', 'Ошибка. Пользователю уже присвоен данный статус');
                    return $this->redirect('/users');
                }
                elseif ($model->status==9){
                    Yii::$app->session->setFlash('error', 'Ошибка. Невозможно присвоить данный статус неподтвержденному пользователю');
                    return $this->redirect('/users');
                }
                $model->blockUser();

                Yii::$app->compModel->blockedUser($model->id,$post['reason'],$post['comment'],$post['status']);
                Yii::$app->compModel->userLog($me_id,$model->id,'user',$model->id,'Блокировка пользователя');
                return $this->redirect('/users');
            }elseif ($action==2){
                $model = User::findOne($user_id);
                if ($model->status==10){
                    Yii::$app->session->setFlash('error', 'Ошибка. Пользователю уже присвоен данный статус');
                    return $this->redirect('/users');
                }
                elseif ($model->status==9){
                    Yii::$app->session->setFlash('error', 'Ошибка. Невозможно присвоить данный статус неподтвержденному пользователю');
                    return $this->redirect('/users');
                }
                $model->unblockUser();

                Yii::$app->compModel->blockedUser($model->id,$post['reason'],$post['comment'],$post['status']);
                Yii::$app->compModel->userLog($me_id,$model->id,'user',$model->id,'Разлокировка пользователя');
                return $this->redirect('/users');
            }
        }

        return $this->render('modal-action',[
            'model'=>$model,
            'user_id'=>$user_id,
            'username'=>$username,
            'action_id'=>$action,
            'action'=>$action_ar[$action]
        ]);
    }

    public function actionModalLog($user_id,$username) #Модальное окно на странице управления пользователями (лог пользователя)
    {
        $this->layout = false;

        $logs = UsersLog::find()
            ->select(['user.username','users_log.table','users_log.comment','users_log.created_at','users_log.created_ip'])
            ->leftJoin('user','user.id = users_log.user_id')
            ->where(['user'=>$user_id])
            ->asArray()
            ->all(); #действия с пользователем

        return $this->render('modal-log',[
            'user_id'=>$user_id,
            'username'=>$username,
            'logs'=>$logs,
        ]);
    }


    //public function actionLogin($id){ #авторизация под другим пользователем (для админа)
    //    $model = User::findOne($id);
    //    Yii::$app->user->login($model);
    //    return $this->redirect(['site/index']);
    //}
}