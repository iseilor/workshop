<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Order */
/* @var $userChildDataProvider \yii\data\ActiveDataProvider */

$this->title = Yii::t(
    'app',
    'Update Order: {name}',
    [
        'name' => $model->id,
    ]
);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>


<?= $this->render(
    '_form',
    [
        'model' => $model,
        'userChildDataProvider'=>$userChildDataProvider
    ]
) ?>
