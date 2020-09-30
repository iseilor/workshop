<?php
/* @var $model app\modules\kr\models\Curator */

use kartik\icons\Icon;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

Modal::begin([
    'title' => '<h4>' . Icon::show('check') . $model->title . '</h4>',
    'toggleButton' => ['label' => Icon::show('info') . 'Подробнее', 'class' => 'btn btn-primary btn-xs'],
    'footer' => Html::a(Icon::show('times') . 'Закрыть', '#', ['class' => 'btn btn-primary', 'data-dismiss' => 'modal']),
    'size' => Modal::SIZE_EXTRA_LARGE,
]);
?>
    <div class="row">
        <div class="col-4">
            <img src="<?= Url::home() . Yii::$app->params['module']['kr']['timetable']['path'] . $model->id . '/link.png' ?>"
                 class="img-fluid text-center" style="width: 200px; padding-left: 40px;">
            <hr/>
            <ul>
                <li><strong>Дата</strong>: <?= $model->date ?></li>
                <li><strong>Название</strong>: <?= $model->title ?></li>
                <li><strong>Ссылка</strong>: <?= Html::a($model->link .' '. Icon::show('external-link-alt'),
                        $model->link, ['target' => '_blank']) ?></li>
            </ul>

        </div>
        <div class="col-8"><?= $model->description ?></div>
    </div>
<?php Modal::end();