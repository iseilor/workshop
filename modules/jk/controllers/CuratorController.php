<?php

namespace app\modules\jk\controllers;

use app\modules\chat\models\ChatSearch;
use app\modules\jk\models\Messages;
use app\modules\jk\models\MessagesSearch;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `jk` module
 */
class CuratorController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new Messages();
        return $this->render('index',[
            'model'=>$model
        ]);
    }

    // Отправка сообщений
    public function actionSend(){
        $model = new Messages();
        $model->load(Yii::$app->request->post());
        $model->user_id = 1;
        $model->save();
        return $this->actionList();
    }

    // Получение списка сообщений
    public function actionList(){
        $searchModel = new MessagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->renderPartial('messages', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}