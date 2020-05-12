<?php

namespace app\modules\jk\controllers;

use app\modules\jk\models\Messages;
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
        $model->user_id = Yii::$app->user->identity->id;
        $model->is_curator = false;
        $model->save();
        return false;
    }


}