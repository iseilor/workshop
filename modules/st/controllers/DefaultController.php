<?php

namespace app\modules\st\controllers;

use app\modules\st\models\GuestSearch;
use Da\QrCode\Contracts\ErrorCorrectionLevelInterface;
use Da\QrCode\QrCode;
use Yii;
use yii\helpers\FileHelper;
use yii\web\Controller;

/**
 * Default controller for the `st` module
 */
class DefaultController extends Controller
{

    /**
     * Renders the index view for the module
     *
     * @return string
     * @throws \Da\QrCode\Exception\InvalidPathException
     */
    public function actionIndex()
    {

        $searchModel = new GuestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->setSort(['defaultOrder' => ['date' => SORT_DESC]]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
}
