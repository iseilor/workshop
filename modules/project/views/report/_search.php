<?php

use app\modules\project\models\Project;
use app\modules\project\models\TaskStatus;
use app\modules\user\models\User;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\jui\DatePicker;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\project\models\TaskSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'id' => 'task-search',
        'data-pjax' => 1,
    ],
]); ?>
    <div class="card card-primary">

        <!--<div class="card-header">
            <h3 class="card-title"><?= Icon::show('filter') ?>Фильтр для сводного отчёта</h3>
            <?= Yii::$app->params['card']['header']['tools'] ?>
        </div>-->

        <div class="card-body">
            <div class="form-row">
                <div class="col-md-2">
                    <?= $form->field($model, 'date_start')->widget(
                        DatePicker::class,
                        [
                            'language' => 'ru',
                            'dateFormat' => 'dd.MM.yyyy',
                            'options' => ['class' => 'form-control inputmask-date'],
                            'clientOptions' => [
                                'changeMonth' => true,
                                'autoclose' => true,
                                'yearRange' => '2020:2020',
                                'clearIncomplete' => true,
                                'changeYear' => true,
                            ],
                        ]
                    ) ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'date_end')->widget(
                        DatePicker::class,
                        [
                            'language' => 'ru',
                            'dateFormat' => 'dd.MM.yyyy',
                            'options' => ['class' => 'form-control inputmask-date'],
                            'clientOptions' => [
                                'changeMonth' => true,
                                'autoclose' => true,
                                'yearRange' => '2020:2020',
                                'clearIncomplete' => true,
                                'changeYear' => true,
                            ],
                        ]
                    ) ?>
                </div>
                <div class="col-md-2">
                    <?php
                    $items = ArrayHelper::map(Project::find()->all(), 'id', 'title');
                    $params = [
                        'prompt' => 'Все',
                        'class' => 'form-control select2',
                    ];
                    echo $form->field($model, 'project_id')->dropDownList($items, $params);
                    ?>
                </div>
                <div class="col-md-2">
                    <?php
                    $statuses = ArrayHelper::map(TaskStatus::find()->all(), 'id', 'title');
                    $params = [
                        'prompt' => 'Все',
                        'class' => 'form-control select2',
                    ];
                    echo $form->field($model, 'status_id')->dropDownList($statuses, $params);
                    ?>
                </div>
                <div class="col-md-2">
                    <div class="form-group" style="padding-top: 31px;">
                        <?= Html::submitButton(Icon::show('sync-alt') . Yii::t('app', 'Обновить'), ['class' => 'form-control btn btn-success btn-block']) ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" style="padding-top: 31px;">
                        <?= Html::a(Icon::show('ban') . 'Отмена', ['index'], ['class' => 'form-control btn btn-info btn-block']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>