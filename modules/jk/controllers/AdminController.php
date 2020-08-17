<?php

namespace app\modules\jk\controllers;

use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `jk` module
 */
class AdminController extends Controller
{

    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


}