<?php

/* @var $this yii\web\View */

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $model app\modules\jk\models\Percent */
/* @var $mins app\modules\jk\models\Min */

$this->title = "<i class='fas fa-user'></i> Куратор Жилищной Программы";
$this->params['breadcrumbs'][] = ['label' => '<i class="nav-icon fas fa-home"></i> Жилищная программа', 'url' => ['/jk']];
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

                    <p class="text-muted text-center">Куратор по жилищной программе МРФ "Центр"</p>

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
            <div class="card card-primary d-none">
                <div class="card-header">
                    <h3 class="card-title">Полезная информация</h3>
                </div>
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
                        <?php




                        Pjax::begin(['id' => 'pjax-messages']);
                        echo ListView::widget(
                            [
                                'dataProvider' => $messageDataProvider,
                                'itemView' => 'message',
                                'layout' => '{items}',
                                'options' => [
                                    'tag' => false,
                                ],
                                'itemOptions' => [
                                    'tag' => false,
                                ],
                            ]
                        );
                        Pjax::end();
                        ?>
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

        // Отправка сообщения
        $('#chat-form').on('beforeSubmit', function(){
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function (result) {
                    $('#chat-form').find('input').val('');
                    //$("html, body").animate({ scrollTop: $(document).height() }, "slow");
                     $.pjax.reload({
                        container: '#pjax-messages',
                        async: true,
                        timeout: false
                     }).done(function() {
                        
                     });
                },
                error: function () {
                    alert('Ошибка')
                }
            });
            return false;
        });

        // Обновление списка сообщений
        /*setInterval(function(){
             $.pjax.reload({
                container: '#pjax-messages',
                async: true,
                timeout: false
             }).done(function() {
                
             });
        }, 1000);*/
JS;
$this->registerJs($js);
?>