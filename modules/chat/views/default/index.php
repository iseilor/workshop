<?php

use app\modules\chat\models\Chat;
use app\modules\chat\models\ChatSearch;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;
use yii\widgets\Pjax;

$this->title = Icon::show('comments').'Чат';
$this->params['breadcrumbs'][] = $this->title;

//ChatAsset::register($this);
?>


    <div class="row h-100">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?=Icon::show('comments');?> Чаты</h3>
                    <?= Yii::$app->params['card']['header']['tools'] ?>
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
                                <span class="badge bg-danger float-right">10</span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user"></i> Петров Пётр Сергеевич
                                <span class="badge bg-warning float-right">4</span>
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
        <div class="col-md-9 h-100">
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title"><?=Icon::show('comments');?>Чат</h3>
                    <?= Yii::$app->params['card']['header']['tools'] ?>
                </div>
                <div class="card-body card-prirary cardutline direct-chat direct-chat-primary">

                    <div class="direct-chat-messages" id="chat-list" style="height: 100%;">
                        <?php
                        $searchModel = new ChatSearch();
                        $dataProvider = $searchModel->search(['order' => ['id' => SORT_DESC], 'limit' => 5]);

                        $dataProvider = new ActiveDataProvider([
                            'query' =>Chat::find()->orderBy(['created_at'=>SORT_DESC]),
                            'totalCount' => 10,
                            'pagination' => [
                                'pageSize' =>10,
                            ],
                        ]);
                        $messages = array_reverse($dataProvider->getModels());
                        Pjax::begin(['id'=>'pjax-messages']);
                        foreach ($messages as $message) {
                            echo $this->render('message', ['model' => $message]) ;
                        }
                        Pjax::end();
                        ?>

                    </div>

                </div>
                <div class="card-footer" style="display: block;">
                    <?php $form = ActiveForm::begin(
                        [
                            'id' => 'chat-form',
                            'action' => Url::toRoute(['/chat/chat/send']),
                            'fieldConfig' => ['options' => ['tag' => false]],
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

<?php
$script = <<< JS
$(document).ready(function() {
    
    // Отправка сообщения
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
         }).done(function() {
            //toastr["success"]("Информация по кандидату успешно обновлена", "Успех");
         });
    }, 1000);*/
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);