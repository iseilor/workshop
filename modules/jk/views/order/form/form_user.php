<?php

use app\modules\user\models\User;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;
use app\modules\jk\models\Order;

$user = User::findOne(Yii::$app->user->identity->id);
?>

<div class="card card-solid card-secondary">
    <div class="card-header with-border">
        <h3 class="card-title">Данные работника</h3>
    </div><!-- /.box-header -->
    <div class="card-body">

        <div class="row">
            <?php Pjax::begin(['id' => 'user-info']);
            echo DetailView::widget([
                'model' => $user,
                'attributes' => [
                    'tab_number',
                    'fio',
                    [
                        'label' => $user->attributeLabels()['gender'],
                        'value' => User::getGenderName($user->gender),
                    ],
                    'birth_date:date',
                    'position',
                    'work_department_full',
                    'work_address',
                    'experience',
                ],
            ]);
            Pjax::end();
            ?>
        </div>



        <div class="row">
            <div class="col-4">
                <?= $form->field($usermd, 'work_is_young')->checkbox(
                    ["template" => "<div class='checkbox'>\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{hint}\n{error}\n</div>"]
                ) ?>
            </div>
            <div class="col-4">
                <?= $form->field($usermd, 'work_is_transferred')->checkbox(
                    ["template" => "<div class='checkbox'>\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{hint}\n{error}\n</div>"]
                ) ?>
            </div>
            <div class="col-4">
                <?= $form->field($usermd, 'work_transferred_file', [
                    'options' => ['class' => (!$usermd->work_is_transferred) ? 'd-none':''],
                    'template' => getFileInputTemplate($usermd->work_transferred_file, $usermd->attributeLabels()['work_transferred_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>
        </div>
    </div>
</div>

<div class="card card-solid card-secondary">
    <div class="card-header with-border">
        <h3 class="card-title">Паспортные данные</h3>
    </div><!-- /.box-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <?= $form->field($usermd, 'passport_series')->widget(MaskedInput::class, [
                    'mask' => '9999',
                    'clientOptions' => [
                        'clearIncomplete' => true,
                    ],
                ]) ?>

                <?= $form->field($usermd, 'passport_number')->widget(MaskedInput::class, [
                    'mask' => '999999',
                    'clientOptions' => [
                        'clearIncomplete' => true,
                    ],
                ]) ?>

                <?= $form->field($usermd, 'passport_registration')->textarea()->hint($usermd->attributeHints()['passport_registration']); ?>
            </div>

            <div class="col-4">
                <?= $form->field($usermd, 'passport_date')->widget(
                    DatePicker::class,
                    [
                        'language' => 'ru',
                        'dateFormat' => 'dd.MM.yyyy',
                        'options' => ['class' => 'form-control inputmask-date'],
                        'clientOptions' => [
                            'changeMonth' => true,
                            'yearRange' => '1950:2020',
                            'changeYear' => true,
                        ],
                    ]
                ) ?>
                <?= $form->field($usermd, 'passport_department')->textarea() ?>
            </div>

            <div class="col-4">
                <?= $form->field($usermd, 'passport_code')->widget(MaskedInput::class, [
                    'mask' => '999-999',
                    'clientOptions' => [
                        'clearIncomplete' => true,
                    ],
                ]) ?>
                <?= $form->field($usermd, 'passport_file', [
                    'template' => getFileInputTemplate($usermd->passport_file, $usermd->attributeLabels()['passport_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>

        </div>
    </div>
</div>


<div class="card card-solid card-secondary">
    <div class="card-header with-border">
        <h3 class="card-title">Жилое помещение</h3>
    </div><!-- /.box-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <?= $form->field($model, 'jp_type')->dropDownList($model->getJPTypeList(), ['prompt' => 'Выберите ...']); ?>
                <?= $form->field($model, 'jp_own')->dropDownList($model->getJPOwnList(), ['prompt' => 'Выберите ...']); ?>
                <?= $form->field($model, 'file_rent_form', [
                    'template' => getFileInputTemplate($model->file_rent, $model->attributeLabels()['file_rent'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'jp_area')->textInput() ?>
                <?= $form->field($model, 'jp_room_count')->textInput() ?>
                <?= $form->field($model, 'family_address')->textarea(); ?>

            </div>
            <div class="col-4">
                <?= $form->field($model, 'resident_count')->textInput(); ?>
                <?=$form->field($model, 'resident_type')->dropDownList(Order::getResidentTypeList(),  ['prompt' => 'Выберите']); ?>
                <?= $form->field($model, 'file_social_contract_form', [
                    'template' => getFileInputTemplate($model->file_social_contract, $model->attributeLabels()['file_social_contract'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>

        </div>
    </div>
</div>


    <div class="card card-solid card-secondary  ">
    <div class="card-header with-border">
        <h3 class="card-title">Обработка персональных данных сотрудника</h3>
    </div><!-- /.box-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                    <li style="width: 100%;">
                        <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                        <div class="mailbox-attachment-info">
                            <?= Html::a(Icon::show('paperclip') . 'ПД. ' . Yii::$app->user->identity->fio . '.pdf',
                                Url::to(['/user/user/' . Yii::$app->user->identity->id . '/pd'], true),
                                ['class' => 'mailbox-attachment-name','target'=>'_blank']) ?>
                            <span class="mailbox-attachment-size clearfix mt-1">
                              <span>1,245 KB</span>
                               <?= Html::a(Icon::show('cloud-download-alt'),
                                Url::to("pd-agreement"), ['class' => 'btn btn-default btn-sm float-right '.
                                       ($model->file_agree_personal_data ? "" : " hide") ]) ?>
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-9">
                <p>Вам необходимо скачать и подписать согласие на обработку ваших персональных данных.<br/>
                    Далее подписанный документ необходимо прикрепить в поле ниже.<br/>
                    Если вы видите какие-то неверные данные, то вам необходимо
                    обновить их в личном кабинете, затем повторно вернуться к созданию заявки.
                </p>
                <?= $form->field($model, 'file_agree_personal_data_form', [
                    'template' => getFileInputTemplate($model->file_agree_personal_data, $model->attributeLabels()['file_agree_personal_data_form'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>

            </div>
        </div>
    </div>
</div>

<!--    <p>-->
<!--        --><?= ""//Html::a(Icon::show('edit') . 'Редактировать профиль',
//            ['/user/profile/update'],
//            ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
<!--        --><?= ""//Html::button(Icon::show('sync-alt') . 'Обновить информацию',
//            ['class' => 'btn btn-primary', 'id' => 'btn-update']) ?>
<!--    </p>-->

<?php
$script = <<< JS
$(document).ready(function() {
    $('#btn-update').click(function(){
         $('#btn-update').find('i').addClass('fa-spin');
        $.pjax.reload({
            container: '#user-info',
            async: true,
            timeout: false
        }).done(function() {
          $('#btn-update').find('i').removeClass('fa-spin');
          toastr["success"]("Информация по кандидату успешно обновлена", "Успех");
        });
    });
    
    // Поле с заявлением о переводе показываем, когда включена галочка
    $('#user-work_is_transferred').on('click', function() {
        $('.field-user-work_transferred_file').toggleClass('d-none');
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);

