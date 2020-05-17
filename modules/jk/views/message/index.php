<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $message mess */
/* @var  $messagesUser \app\modules\jk\models\Message */
/* @var  $messagesCurator \app\modules\jk\models\Message */

$this->title = Icon::show('comments').Module::t('message', 'Messages');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row">
        <div class="col-md-4">

            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title"><?= Icon::show('hourglass') ?>Ждут ответа</h3>
                    <?= Yii::$app->params['card']['header']['tools'] ?>
                </div>
                <div class="card-body p-0">
                    <?= Html::ul($messagesUser, [
                        'class' => 'nav flex-column',
                        'item' => function ($item, $index) {
                            return Html::tag(
                                'li',
                                $this->render('user_item', ['message' => $item]),
                                ['class' => 'nav-item']
                            );
                        },
                    ]) ?>
                </div>
            </div>

            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><?= Icon::show('check') ?>Получили ответ</h3>
                    <?= Yii::$app->params['card']['header']['tools'] ?>
                </div>
                <div class="card-body p-0">
                    <?= Html::ul($messagesCurator, [
                        'class' => 'nav flex-column',
                        'item' => function ($item, $index) {
                            return Html::tag(
                                'li',
                                $this->render('user_item', ['message' => $item]),
                                ['class' => 'nav-item']
                            );
                        },
                    ]) ?>
                </div>
            </div>

        </div>
        <div class="col-md-8">

            <?php if (isset($user) && $user): ?>
                <div class="card card-widget widget-user-2">
                    <div class="widget-user-header bg-primary">
                        <div class="widget-user-image">
                            <?= Html::img($user->photoPath, ['class' => 'img-circle elevation-2']) ?>
                        </div>
                        <h3 class="widget-user-username"><?= $user->fio ?></h3>
                        <h5 class="widget-user-desc"><?= $user->position ?></h5>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?= Icon::show('comments') ?>Сообщения</h3>
                        <?= Yii::$app->params['card']['header']['tools'] ?>
                    </div>
                    <div class="card-body direct-chat-primary">
                        <?php

                        Pjax::begin(['id' => 'pjax-messages']);
                        echo ListView::widget(
                            [
                                'dataProvider' => $messagesDataProvider,
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
                    <div class="card-footer">


                        <?php $form = ActiveForm::begin(
                            [
                                'id' => 'chat-form',
                                'action' => Url::toRoute(['/jk/message/send']),
                                'fieldConfig' => ['options' => ['tag' => false]],
                            ]
                        ); ?>
                        <div class="input-group">
                            <?= $form->field($message, 'user_id', ['options' => ['class' => 'd-none']])->hiddenInput(['value' => $user->id])->label(false); ?>
                            <?= $form->field($message, 'message', ['template' => '{input}']); ?>
                            <span class="input-group-append">
                                <?= Html::submitbutton(Icon::show('paper-plane') . 'Отправить ', ['class' => 'btn btn-primary', 'id' => 'btn-message-send']) ?>
                            </span>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>

                </div>
            <?php else:?>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-info"></i> Сообщения</h5>
                    Для того, чтобы открыть конкретную переписку с пользователем, необходимо его выбрать в списке слева
                </div>
                <div class="card">
                    <div class="card-body">
                        Классификация сообщения по времени отправки:
                        <ul>
                            <li><span class="badge badge-success">Получен ответ куратора</span></li>
                            <li><span class="badge badge-info">Ответ куратора не получен, прошло не более 24 часов</span></li>
                            <li><span class="badge badge-warning">Ответ куратора не получен, прошло не более 48 часов</span></li>
                            <li><span class="badge badge-danger">Ответ куратора не получен, прошло более 48 часов</span></li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
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
                    $('#message-message').val('');
                    //$("html, body").animate({ scrollTop: $(document).height() }, "slow");
                    $.pjax.reload({
                    container: '#pjax-messages',
                    async: true,
                    timeout: false
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
             });
        }, 1000);*/
JS;
$this->registerJs($js);
?>