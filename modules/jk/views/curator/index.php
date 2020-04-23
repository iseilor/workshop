<?php

/* @var $this yii\web\View */

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $model app\modules\jk\models\Percent */
/* @var $mins app\modules\jk\models\Min */

$this->title = "<i class='fas fa-user'></i> Куратор Жилищной Кампании";
$this->params['breadcrumbs'][] = ['label' => '<i class="nav-icon fas fa-home"></i> Жилищная компания', 'url' => ['/jk']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="<?= Url::home() ?>img/main/team/8.jpg" alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">Горшкова Лада Александрова</h3>

                    <p class="text-muted text-center">Куратор по жилищной кампании МРФ "Центр"</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Телефон</b> <a class="float-right">8 (800) 200-20-20</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">l_gorshkova@center.rt.ru</a>
                        </li>
                        <li class="list-group-item">
                            <b>Адрес</b> <a class="float-right">Comcity</a>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-block"><b>Показать телефон/email</b></a>
                </div>

            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Полезная информация</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Education</strong>

                    <p class="text-muted">
                        B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                    <p class="text-muted">Malibu, California</p>

                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                    <p class="text-muted">
                        <span class="tag tag-danger">UI Design</span>
                        <span class="tag tag-success">Coding</span>
                        <span class="tag tag-info">Javascript</span>
                        <span class="tag tag-warning">PHP</span>
                        <span class="tag tag-primary">Node.js</span>
                    </p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                    <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-9 h-100">
            <div class="card card-primary h-100">
                <div class="card-header">
                    <h3 class="card-title"><?= Icon::show('comments') ?>Сообщения куратору жилищной кампании в вашем филиале</h3>
                    <?= Yii::$app->params['card']['header']['tools'] ?>
                </div>
                <div class="card-body card-primary cardutline direct-chat direct-chat-primary">
                    <div class="direct-chat-messages h-100" id="messages">
                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left">Alexander Pierce</span>
                                <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                            </div>

                            <img class="direct-chat-img" src="<?= Url::home() ?>img/main/team/8.jpg" alt="Message User Image">
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
                                <span class="direct-chat-name float-right">Sarah Bullock</span>
                                <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                            </div>
                            <!-- /.direct-chat-infos -->
                            <img class="direct-chat-img" src="<?= Url::home() ?>img/main/team/8.jpg" alt="Message User Image">
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
                            'action' => Url::toRoute(['/jk/curator/send']),
                            'fieldConfig' => ['options' => ['tag' => false]],
                        ]
                    ); ?>
                    <div class="input-group">
                        <?= $form->field($model, 'message', ['template' => '{input}{error}']); ?>
                        <span class="input-group-append">
                        <?= Html::submitButton(Icon::show('paper-plane') . 'Отправить', ['class' => 'btn btn-primary', 'id' => 'btn-message-send']) ?>
                    </span>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>


<?php
$js = <<<JS
        $('form').on('beforeSubmit', function(){
        var data = $(this).serialize();
        $.ajax({
            url: this.action,
            type: 'POST',
            data: data,
            success: function(res){
                $('#messages').html(res);
            },
            error: function(){
                alert('Error!');
            }
        });
        return false;
        });
JS;
$this->registerJs($js);
?>