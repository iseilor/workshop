<?php
/* @var $model app\modules\kr\models\Curator */
use kartik\icons\Icon;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

Modal::begin([
    'title' => '<h4>' . Icon::show('user-graduate') . $model->fio . '</h4>',
    'toggleButton' => ['label' => Icon::show('info') . 'Подробнее', 'class' => 'btn btn-primary'],
    'footer' => Html::a(Icon::show('times').'Закрыть', '#', ['class' => 'btn btn-primary', 'data-dismiss' => 'modal']),
    'size' => Modal::SIZE_LARGE,
]);
echo '<div class="row">
                        <div class="col-4"><img src="' . Url::home() . Yii::$app->params['module']['kr']['curator']['path'] . $model->img . '" class="img-circle img-fluid"></div>
                        <div class="col-8">' . $model->description . '</div>
                </div>';
Modal::end();