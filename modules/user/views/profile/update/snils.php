<div class="row">
    <div class="row-12">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-info"></i> Информация</h5>
            Данные поля не обязательны для заполнения при работе с большинством услуг на портале. Но их
            нужно будет заполнить, например, если вы подаёте заявку для участия в жилищной кампании
        </div>
    </div>
    <div class="col-md-4">
        <?php

        use yii\helpers\Html;
        use yii\jui\DatePicker;
        use yii\widgets\MaskedInput;

        $snilsFile = '';
        if ($model->snils_file) {
            $snilsFile = 'СНИЛС: ' . Html::a(
                    Yii::$app->params['module']['user']['snils']['icon'] . ' Мой СНИЛС',
                    Yii::$app->homeUrl . Yii::$app->params['module']['user']['snils']['path'] . $model->snils_file,
                    ['target' => '_blank']
                );
        }
        ?>
        <?= $form->field($model, 'snils_file', [
            'template' => getFileInputTemplate($model->snils_file, $model->attributeLabels()['snils_file'] . '.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>

        
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'snils_number')->widget(MaskedInput::class, [
            'mask' => '999-999-999-99',
            'clientOptions' => [
                'clearIncomplete' => true,
            ],
        ]) ?>
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