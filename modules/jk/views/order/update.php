<?php

use app\modules\jk\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Order */
/* @var $userChildDataProvider \yii\data\ActiveDataProvider */

$this->title = Yii::t(
    'app',
    'Изменить заявку №{name}',
    [
        'name' => $model->id,
    ]
);
$this->params['breadcrumbs'][] = ['label' => Module::t('order', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>


<?= $this->render(
    'form/form',
    [
        'model' => $model,
        //'userChildDataProvider' => $userChildDataProvider,
    ]
) ?>
