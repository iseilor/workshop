<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\MessagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $message mess */

$this->title = Module::t('messages', 'Messages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4">

        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title"><?=Icon::show('hourglass')?>Ждут ответа</h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body p-0">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Иванов Иван Иванович <span class="float-right badge bg-primary">31</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Петров Петр Петрович <span class="float-right badge bg-info">5</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Completed Projects <span class="float-right badge bg-success">12</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Followers <span class="float-right badge bg-danger">842</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><?=Icon::show('check')?>Получили ответ</h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body p-0">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Projects <span class="float-right badge bg-primary">31</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Tasks <span class="float-right badge bg-info">5</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Completed Projects <span class="float-right badge bg-success">12</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Followers <span class="float-right badge bg-danger">842</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
    <div class="col-md-8">

        <div class="card card-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-primary">
                <div class="widget-user-image">
                    <?= Html::img($user->photoPath, ['class' => 'img-circle elevation-2']) ?>
                </div>
                <h3 class="widget-user-username"><?=$user->fio?></h3>
                <h5 class="widget-user-desc"><?=$user->position?></h5>
            </div>

        </div>


        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?=Icon::show('comments')?>Сообщения</h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body direct-chat-primary">
                <?php
                $searchModel = new \app\modules\jk\models\MessagesSearch();
                $dataProvider = $searchModel->search(['where' => 'user_id=' . Yii::$app->user->identity->getId(), 'order' => ['id' => SORT_DESC], 'limit' => 10]);



                Pjax::begin(['id' => 'pjax-messages']);
                echo ListView::widget(
                    [
                        'dataProvider' => $dataProvider,
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
                        'action' => Url::to(['/jk/messages/send']),
                        'fieldConfig' => ['options' => ['tag' => false]],
                    ]
                ); ?>
                <div class="input-group">
                    <?= $form->field($message, 'user_id')->hiddenInput(['value' => $user->id]); ?>
                    <?= $form->field($message, 'message', ['template' => '{input}']); ?>
                    <span class="input-group-append">
                        <?= Html::submitButton(Yii::$app->params['btn']['send']['icon'] . ' ' . Yii::t('app', 'Send'), ['class' => 'btn btn-primary', 'id' => 'btn-message-send']) ?>
                    </span>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

        </div>
    </div>
</div>

<?php
$js = <<<JS

        // Отравка сообщения
        $('#chat-form').on('beforeSubmit', function(){
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function (result) {
                    $('#chat-form').find('input').val('');
                    $("html, body").animate({ scrollTop: $(document).height() }, "slow");
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


