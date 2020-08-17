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
        <div class="row">
            <div class="col-4">
                <?= $form->field($model, 'is_participate')->dropDownList($model->getParticipateList(), ['prompt' => 'Выберите ...']); ?>
            </div>
            <div class="col-4">
                <?=
                $form->field($model, 'is_poor')->checkbox(
                    ["template" => "<div class='checkbox'>\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{hint}\n{error}\n</div>"]
                )
                ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'file_social_protection_form', [
                    'options' => ['class' => (!$model->is_poor) ? 'd-none':''],
                    'template' => getFileInputTemplate($model->file_social_protection, $model->attributeLabels()['file_social_protection'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
            <?= $form->field($usermd, 'tab_number')->widget(MaskedInput::class, [
                'mask' => '999999[9]',
                'clientOptions' => [
                    'clearIncomplete' => true
                ]
            ]) ?>
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
                <?= $form->field($passport, 'passport_series')->widget(MaskedInput::class, [
                    'mask' => '9999',
                    'clientOptions' => [
                        'clearIncomplete' => true,
                    ],
                ]) ?>
           </div>
            <div class="col-4">
                <?= $form->field($passport, 'passport_date')->widget(
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
            </div>
            <div class="col-4">
                <?= $form->field($passport, 'passport_code')->widget(MaskedInput::class, [
                    'mask' => '999-999',
                    'clientOptions' => [
                        'clearIncomplete' => true,
                    ],
                ]) ?>
            </div>
        </div>


        <div class="row">
            <div class="col-4">
                <?= $form->field($passport, 'passport_number')->widget(MaskedInput::class, [
                    'mask' => '999999',
                    'clientOptions' => [
                        'clearIncomplete' => true,
                    ],
                ]) ?>
            </div>
            <div class="col-4">
                <?= $form->field($passport, 'passport_department')->textarea() ?>
            </div>
            <div class="col-4">
                <?= $form->field($passport, 'passport_file', [
                    'template' => getFileInputTemplate($passport->passport_file, $passport->attributeLabels()['passport_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <?= $form->field($passport, 'passport_registration')->textarea()->hint($passport->attributeHints()['passport_registration']); ?>
            </div>
            <div class="col-4">
                <?= $form->field($passport, 'is_temporary_registered')->checkbox(
                    ["template" => "<div class='checkbox'>\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{hint}\n{error}\n</div>"]
                ) ?>
            </div>
            <div class="col-4">
                <?= $form->field($passport, 'temporary_registration_file', [
                    'options' => ['class' => (!$passport->is_temporary_registered) ? 'd-none':''],
                    'template' => getFileInputTemplate($passport->temporary_registration_file, $passport->attributeLabels()['temporary_registration_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <?= $form->field($passport, 'ejd_file', [
                    'template' => getFileInputTemplate($passport->ejd_file, $passport->attributeLabels()['ejd_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>
            <div class="col-4">
            </div>
            <div class="col-4">
            </div>
        </div>
    </div>
</div>


<div class="card card-solid card-secondary">
    <div class="card-header with-border">
        <h3 class="card-title"><?=  \app\modules\jk\Module::t('order', 'Accommodations') ?></h3>
    </div><!-- /.box-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <?= $form->field($model, 'family_address')->textarea([
                    'readonly' => $model->family_address == $passport->passport_registration,
                    'data-passport-address-fact' => $passport->passport_registration,
                ])
                    ->hint($user->attributeHints()['address_fact'] . '<br/>' .
                        Html::checkbox('passport_address_registration',
                            $model->family_address == $passport->passport_registration,
                            ['label' => 'Совпадает с адресом регистрации сотрудника', 'id' => 'order_family_address'])
                    ); ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'jp_type')->dropDownList($model->getJPTypeList(), ['prompt' => 'Выберите ...']); ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'resident_own_type')->dropDownList($model->getResidentOwnTypeList(), ['prompt' => 'Выберите ...']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <?= $form->field($model, 'jp_room_count')->textInput() ?>
                <?= $form->field($model, 'resident_type')->dropDownList(Order::getResidentTypeList(),  ['prompt' => 'Выберите']); ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'jp_area')->textInput() ?>
                <?= $form->field($model, 'file_rent_form', [
                    'template' => getFileInputTemplate($model->file_rent, $model->attributeLabels()['file_rent'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'resident_count')->textInput(); ?>
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
                                ['class' => 'mailbox-attachment-name']) ?>
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
    
    // Поле с Справка из соц.защите показываем, когда включена галочка
    $('#order-is_poor').on('click', function() {
        $('.field-order-file_social_protection_form').toggleClass('d-none');
    });
    
    // Поле с Документ о временной регистрации, когда включена галочка
    $('#passport-is_temporary_registered').on('click', function() {
        $('.field-passport-temporary_registration_file').toggleClass('d-none');
    });
    
    // Адрес фактического проживание супруги совпадает с адресом фактичекого проживания сотрудника
    $('#order_family_address').on('click', function() {
        if($(this).prop("checked")) {
            $('#order-family_address').prop( "readonly", true );
            $('#order-family_address').val($('#passport-passport_registration').val());
        }else{
            $('#order-family_address').prop( "readonly", false );
       }
    });
    
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);

