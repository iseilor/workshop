<?php

namespace app\modules\news\controllers;

use app\modules\news\models\News;
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
        return $this->render('/news/post', [
            'model' => News::findOne($id),
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);

        return $this->render('/news/list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
