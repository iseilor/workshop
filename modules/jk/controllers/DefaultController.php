<?php

namespace app\modules\jk\controllers;

use yii\web\Controller;

/**
 * Default controller for the `jk` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCalc(){
        return $this->render('calc');
    }
}