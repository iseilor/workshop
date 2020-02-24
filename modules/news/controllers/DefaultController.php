<?php

namespace app\modules\news\controllers;

use app\modules\news\models\NewsSearch;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `news` module
 */
class DefaultController extends Controller
{

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/news/list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
