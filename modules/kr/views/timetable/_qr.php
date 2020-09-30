<?php
/* @var $model app\modules\kr\models\Curator */

use kartik\icons\Icon;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

Modal::begin([
    'title' => '<h6>' . Icon::show('check') . $model->title . '</h6>',
    'toggleButton' => ['label' => Icon::show('info') . 'Показать QR-код', 'class' => 'btn btn-primary btn-xs'],
    'footer' => Html::a(Icon::show('times') . 'Закрыть', '#', ['class' => 'btn btn-primary', 'data-dismiss' => 'modal']),
    'size' => Modal::SIZE_SMALL,
]);
?>
    <div class="row">
        <div class="col-12">
            <img src="<?= Url::home() . Yii::$app->params['module']['kr']['timetable']['path'] . $model->id . '/link.png' ?>"
                 class="img-fluid text-center">
        </div>
    </div>
<?php Modal::end();