<?php


use kartik\datetime\DateTimePicker;
use kartik\icons\Icon;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\st\models\Guest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?= $this->title ?></h3>
        <?= Yii::$app->params['card']['header']['tools'] ?>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">
        <div class="row">

            <div class="col-4">
                <img src="<?= Url::home() . Yii::$app->params['module']['st']['guest']['path'] . $model->id . '/' . $model->guest_photo ?>"
                     class="img-circle img-fluid" style="max-width: 150px;">
                <?= $form->field($model, 'guest_photo_form')->fileInput()
                    ->hint('Для фотографий используйте квадратные изображения размером не менее 300х300px') ?>
                <?= $form->field($model, 'guest_fio')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'birth_date')->widget(
                    DatePicker::class,
                    [
                        'language' => 'ru',
                        'dateFormat' => 'dd.MM.yyyy',
                        'options' => ['class' => 'form-control inputmask-date'],
                        'clientOptions' => [
                            'changeMonth' => true,
                            'autoclose' => true,
                            'yearRange' => '1950:2020',
                            'clearIncomplete' => true,
                            'changeYear' => true,
                        ],
                    ]
                ) ?>
                <?= $form->field($model, 'birth_place')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-4">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'guest_category')->dropDownList(ArrayHelper::map(\app\modules\st\models\Category::find()->all(), 'id',
                    'title')); ?>
                <?= $form->field($model, 'registration_link')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'webinar_link')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'youtube_link')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'vk_link')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'date')->widget(DateTimePicker::class, [
                    'name' => 'date',
                    'type' => DateTimePicker::TYPE_INPUT,
                    'convertFormat' => true,
                    'options' => [
                        'value' => date('d.m.Y H:i', $model->date),
                    ],
                    'pluginOptions' => [
                        'format' => 'dd.MM.yyyy hh:i',
                        'autoclose' => true,
                        'weekStart' => 1, //неделя начинается с понедельника
                        'startDate' => '01.01.2019 00:00', //самая ранняя возможная дата
                        'todayBtn' => true, //снизу кнопка "сегодня"
                    ],
                ]); ?>
                <?= $form->field($model, 'video')->textInput(['maxlength' => true])
                    ->hint('Видео-файлы могут быть загружены только с помощью администраторов портала, оставляйте это поле пока незаполненым') ?>
                <?= $form->field($model, 'annotation')->widget(
                    Widget::class,
                    [
                        'settings' => [
                            'lang' => 'ru',
                            'minHeight' => 200,
                            'plugins' => [
                                'clips',
                                'fullscreen',
                            ],
                        ],
                    ]
                ); ?>
            </div>
            <div class="col-12">

                <?= $form->field($model, 'text')->widget(
                    Widget::class,
                    [
                        'settings' => [
                            'lang' => 'ru',
                            'minHeight' => 200,
                            'plugins' => [
                                'clips',
                                'fullscreen',
                            ],
                        ],
                    ]
                ); ?>
            </div>


        </div>

    </div>
    <div class="card-footer">
        <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
