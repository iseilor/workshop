<?php

namespace app\modules\st\controllers;

use app\modules\st\models\GuestSearch;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `st` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GuestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
}
