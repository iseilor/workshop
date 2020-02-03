<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Zaim */
/* @var $min app\modules\jk\models\Min */

$this->title = Yii::t(
    'app',
    'Калькулятор займа'
);

$icon = '<i class="fas fa-calculator nav-icon"></i>';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zaims'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?= $this->render(
    '_form',
    [
        'model' => $model,
        'mins' => $mins
    ]
) ?>