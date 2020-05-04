<div class="row">
    <div class="col-md-4">
        <?php

        use yii\helpers\Html;
        use yii\jui\DatePicker;

        $snilsFile = '';
        if ($model->snils_file) {
            $snilsFile = 'СНИЛС: ' . Html::a(
                    Yii::$app->params['module']['user']['snils']['icon'] . ' Мой СНИЛС',
                    Yii::$app->homeUrl . Yii::$app->params['module']['user']['snils']['path'] . $model->snils_file,
                    ['target' => '_blank']
                );
        }
        ?>
        <?= $form->field($model, 'snils_file')->fileInput()->hint($snilsFile) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'snils_number')->textInput() ?>
        <?= $form->field($model, 'snils_date')->widget(
            DatePicker::class,
            [
                'language' => 'ru',
                'dateFormat' => 'dd.MM.yyyy',
                'options' => ['class' => 'form-control inputmask-date'],
                'clientOptions' => [
                    'changeMonth' => true,
                    'yearRange' => '1950:2020',
                    'changeYear' => true
                ],
            ]
        ) ?>
    </div>
</div>