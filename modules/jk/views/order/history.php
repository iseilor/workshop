<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Order */
/* @var $stages yii\data\ActiveDataProvider */

$this->title = Icon::show('history') . ' Хронология заявки #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-md-12">
        <div class="timeline">

            <div class="time-label">
                <span class="bg-green"><?= Yii::$app->formatter->asDate($model->created_at) ?></span>
            </div>
            <?= ListView::widget(
                [
                    'dataProvider' => $stages,
                    'itemView' => 'history_item',
                    'layout' => "{items}",
                    'options' => [
                        'tag' => false,
                        'class' => ''
                    ],
                    'itemOptions' => [
                        'tag' => 'div',
                        'class' => '',
                    ],
                ]
            ); ?>
            <div class="time-label">
                <span class="bg-green"><?= Yii::$app->formatter->asDate($model->created_at) ?></span>
            </div>
            <div>
                <i class="fas fa-clock bg-gray"></i>
            </div>
        </div>
    </div>
</div>