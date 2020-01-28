<?php

use app\modules\chat\assets\ChatAsset;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Create Chat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

ChatAsset::register($this);
?>


<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="far fa-comments"></i> Чаты</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item active">
                        <a href="#" class="nav-link">
                            <i class="fas fa-inbox"></i> Главный
                            <span class="badge bg-primary float-right">12</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users"></i> Коллеги</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item active">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user"></i> Иванов Иван Иванович
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user"></i> Петров Пётр Сергеевич
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="#" class="nav-link">
                            <i class="fas fa-user"></i> Сидоров Сидор Витальевич
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fab fa-buromobelexperte"></i> Модули
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item active">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-home"></i> Куратор Жилищной Кампании
                            <span class="badge bg-primary float-right">1</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-9">
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title">Сообщения</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body card-prirary cardutline direct-chat direct-chat-primary">
                <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left">Alexander Pierce</span>
                            <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="/img/user1-128x128.jpg" alt="Message User Image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            Is this template really for free? That's unbelievable!
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-right">Вы</span>
                            <span class="direct-chat-timestamp float-left">02.02.2020 14:00</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="/img/user3-128x128.jpg" alt="Message User Image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            You better believe it!
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
                </div>
            </div>
            <div class="card-footer" style="display: block;">
                <?php $form = ActiveForm::begin(
                    [
                        'id' => 'chat-form',
                        'action' => Url::toRoute(['/chat/chat/send']),
                        'fieldConfig' => ['options' => ['tag' => false]]
                    ]
                ); ?>
                <div class="input-group">
                    <?= $form->field($model, 'message', ['template' => '{input}']); ?>
                    <span class="input-group-append">
                        <?= Html::submitButton(Yii::$app->params['btn']['send']['icon'] . ' ' . Yii::t('app', 'Send'), ['class' => 'btn btn-primary', 'id' => 'btn-message-send']) ?>
                    </span>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>



