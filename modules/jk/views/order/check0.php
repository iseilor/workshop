<?php

use app\modules\jk\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $order app\modules\jk\models\Order */
/* @var $stage app\modules\jk\models\OrderStage */
/* @var $user app\modules\user/models/User */

$this->title = 'Проверка заявки №' . $order->id;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$passportPath = Yii::$app->homeUrl . Yii::$app->params['module']['user']['passport']['path'] . $user->passport_file;
$snilsPath = Yii::$app->homeUrl . Yii::$app->params['module']['user']['snils']['path'] . $user->snils_file;

?>
<div class="card">
    <div class="card-body">

        <h1>Прикреплённые документы</h1>
        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
            <li>
                <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                <div class="mailbox-attachment-info">
                    <a href="<?=$passportPath?>" target="_blank" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> Паспорт.pdf</a>
                    <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1,245 KB</span>
                          <a href="<?=$passportPath?>" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                </div>
            </li>
            <li>
                <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                <div class="mailbox-attachment-info">
                    <a href="<?=$snilsPath?>" target="_blank" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> СНИЛС.pdf</a>
                    <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1,245 KB</span>
                          <a href="<?=$snilsPath?>" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                </div>
            </li>
            <li>
                <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>
                <div class="mailbox-attachment-info">
                    <a href="<?=$passportPath?>" target="_blank" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> КД.docx</a>
                    <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1,245 KB</span>
                          <a href="<?=$passportPath?>" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                </div>
            </li>

        </ul>

        <h1>Параметры заявки</h1>
        <?= DetailView::widget(
            [
                'model' => $order,
                'attributes' => [
                    'id',
                    'created_at:datetime',
                    'created_by',
                    'status_id',
                    'updated_at:datetime',
                    'updated_by',




                ],
            ]
        ) ?>
    </div>
    <div class="card-footer">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <?= $form->field($stage, 'comment')->textarea()->label('Комментарий куратора') ?>
            <?= Html::submitButton(Yii::t('app', '<i class="fas fa-check"></i> Проверено и согласовно'), ['class' => 'btn btn-success','name'=>'status_id','value'=>5]) ?>
            <?= Html::submitButton(Yii::t('app', '<i class="fas fa-undo"></i> Вернуть для исправления'), ['class' => 'btn btn-warning','name'=>'stage_id','value'=>3]) ?>
            <?= Html::submitButton(Yii::t('app', '<i class="fas fa-stop"></i> Отказать в помощи'),  ['class' => 'btn btn-danger','name'=>'stage_id','value'=>4]) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
