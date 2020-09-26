<?php
/* @var $model app\modules\st\models\Guest */

use kartik\icons\Icon;
use yii\bootstrap4\Modal;
use yii\helpers\Html;

Modal::begin([
    'title' => '<h4>' . Icon::show('user-graduate') . $model->guest_fio . '</h4>',
    'toggleButton' => ['label' => Icon::show('video') . 'Запись', 'class' => 'btn btn-sm bg-purple'],
    'footer' => Html::a(Icon::show('times') . 'Закрыть', '#', ['class' => 'btn btn-primary', 'data-dismiss' => 'modal']),
    'size' => Modal::SIZE_LARGE,
]);
echo '<div class="row">
    <div class="col-12">
        <video preload="none" controls="controls" src="' . Yii::$app->homeUrl . Yii::$app->params['module']['st']['guest']['path'] . $model->id . '/' . $model->video
    . '" width="100%">
    </div>
</div>';
Modal::end();