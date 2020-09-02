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


<div class="card card-solid card-secondary  ">
    <div class="card-header with-border">
        <h3 class="card-title">Обработка персональных данных работника</h3>
    </div>
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

<?php if($spose->type == 1): ?>
    <div class="card card-solid card-secondary  ">
        <div class="card-header with-border">
            <h3 class="card-title">Обработка персональных данных супруге(у)</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <hr/>
            <blockquote>
                <p>
                    Заполните все поля формы по вашей(ему) супруге(у). Проверьте введённые данные и нажмите кнопку
                    <?=Html::tag('span',Icon::show('save').'Сохранить',['class'=>"badge bg-success"])?>.
                    После этого повторно откройте форму регистрации данных по супруге(у) и скачайте автоматически
                    сформированный бланк, который нужно будет распечатать, подписать и прикрепить в поле ниже<br/>
                    <?= Html::a(Icon::show('file-pdf') . 'Согласие на обработку персональных данных по супруге(у)',
                        Url::to(['/user/spouse/' . $spose->id . '/pd'])) ?>
                </p>
            </blockquote>
                <?= $form->field($spose, 'personal_data_file_form', [
                    'template' => getFileInputTemplate($spose->personal_data_file,  $spose->attributeLabels()['personal_data_file'].'.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (is_array($usermd->children) && count($usermd->children) > 0):?>
    <div class="card card-solid card-secondary  ">
        <div class="card-header with-border">
            <h3 class="card-title">Обработка персональных данных детей</h3>
        </div>
        <div class="card-body">
            <?php foreach($usermd->children as $child): ?>
                <div  class="row">
                    <div class="col-md-12">
                        <hr/>
                        <h3><?= $child->fio ?></h3>
                            <blockquote>
                                <p>
                                    Заполните все поля формы по вашему ребёнку выше. Проверьте введённые данные и сохраните их.
                                    После этого повторно откройте форму регистрации данных по ребёнку и скачайте автоматически
                                    сформированный блан, который нужно будет распечатать, подписать и прикрепить в поле ниже<br/>
                                    <?= Html::a(Icon::show('file-pdf') . 'Согласие на обработку персональных данных по ребёнку',
                                        Url::to(['/user/child/' . $child->id . '/pd'])) ?><br/>
                                </p>
                            </blockquote>
                            <?= $form->field($child, 'file_personal_form['.$child->id.']', [
                                'template' => getFileInputTemplate($child->file_personal, $child->attributeLabels()['file_personal']. '.pdf'),
                            ])->fileInput(['class' => 'custom-file-input']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>




<div class="card card-solid card-secondary  ">
    <div class="card-body">
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2">
                <?php
                    if ($model->id) {
                        echo Html::submitButton(
                            Icon::show('save') . 'Сохранить заявку',
                            [
                                'class' => 'btn btn-success float-right',
                                'id' => 'btn-save',
                                'value' => 1,
                                'name' => 'save',
                            ]
                        );
                    }
                ?>
            </div>
        </div>
    </div>
</div>
