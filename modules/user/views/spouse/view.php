<?php

use app\modules\user\models\Spouse;
use app\modules\user\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Spouse */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => Module::t('spouse', 'Spouses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>

            <div class="card-body">
                <p>
                    <?= Html::a(Icon::show('edit') . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Icon::show('trash') . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>

                <?php
                    $attr = [
                        [
                            'attribute' => 'type',
                            'value' => Spouse::getTypeList()[$model->type],
                        ],
                        'fio',
                        viewFieldFile($model, 'marriage_file', ['/jk/order/' . $model->id . '/acs-ctrl?model=spouse&field=marriage_file']),
                        'passport_registration',
                        'passport_series',
                        'passport_number',
                        'passport_date:date',
                        'passport_department',
                        viewFieldFile($model, 'passport_file', ['/jk/order/' . $model->id . '/acs-ctrl?model=spouse&field=passport_file']),

                    ];
                    if (isset($model->passport_code) && $model->passport_code != '') {
                        $attr[] = [
                            'attribute' => 'passport_code',
                            'value' => $model->passport_code
                        ];
                    }
                    if (isset($model->registration_file)) {
                        $attr[] = viewFieldFile($model, 'registration_file', ['/jk/order/' . $model->id . '/acs-ctrl?model=spouse&field=registration_file']);
                    }
                    if (isset($model->edj_file)) {
                        $attr[] = viewFieldFile($model, 'edj_file', ['/jk/order/' . $model->id . '/acs-ctrl?model=spouse&field=edj_file']);
                    }
                    $attr[] = [
                        'attribute' => 'is_work',
                        'value' => (isset($model->is_work) && $model->is_work) ? '????' : '??????',
                    ];
                    if (isset($model->is_work) && $model->is_work) {
                        if (isset($model->is_rtk) && $model->is_rtk) {
                                $attr[] = [
                                    'attribute' => 'is_rtk',
                                    'value' => '????'
                                ];
                            }
                        if (isset($model->is_do) && $model->is_do) {
                            $attr[] = [
                                'attribute' => 'is_do',
                                'value' => (isset($model->is_do) && $model->is_do) ? '????' : '??????',
                            ];
                        }
                    } else {
                        array_push($attr,
                            viewFieldFile($model, 'work_file', ['/jk/order/' . $model->id . '/acs-ctrl?model=spouse&field=work_file']),
                            viewFieldFile($model, 'unemployment_file', ['/jk/order/' . $model->id . '/acs-ctrl?model=spouse&field=unemployment_file']),
                            viewFieldFile($model, 'explanatory_note_file', ['/jk/order/' . $model->id . '/acs-ctrl?model=spouse&field=explanatory_note_file'])
                        );
                    }
                ?>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => $attr
                ]) ?>
            </div>
        </div>
    </div>
</div>
