<?php

use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $model app\modules\bot\models\Bot */

?>

<?= Html::a(Icon::show($model->icon).$model->title_link, '#',
    [
        'class' => 'btn btn-primary btn-xs btn-bot',
        'data-id' => $model->id,
    ]) ?>