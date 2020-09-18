<?php
/* @var $model app\modules\st\models\Guest */

use kartik\icons\Icon;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;


Modal::begin([
    'title' => '<h4>' . Icon::show('star') . $model->guest_fio . '</h4>',
    'toggleButton' => ['label' => Icon::show('info') . 'Информация', 'class' => 'btn btn-sm btn-primary float-right'],
    'footer' => Html::a(Icon::show('envelope') . 'Отправить ссылки на личный email', '#', ['class' => 'btn btn-success'])
        . Html::a(Icon::show('times') . 'Закрыть', '#', ['class' => 'btn btn-primary', 'data-dismiss' => 'modal']),
    'size' => Modal::SIZE_EXTRA_LARGE,
]);
?>
    <div class="row">
        <div class="col-3">
            <div class="text-center">
                <img src="<?= Url::home() ?>img/st/guest/<?= $model->guest_photo ?>" class="img-circle img-fluid">
            </div>
            <hr>
            <div>
                <small class="text-muted text-justify"><?= $model->annotation ?></small>
            </div>
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-12">
                    <?= $model->text ?>
                    <?php if ($model->registration_link): ?>
                        <div class="alert alert-info alert-dismissible">
                            Предварительная регистрация обязательна: <?= Html::a($model->registration_link, $model->registration_link,
                                ['target' => '_blank']) ?>
                        </div>
                    <?php endif; ?>
                    <p>
                        Для быстрого доступа к трансляции с вашего мобильного устройства вы можете использовать <strong>QR-коды</strong>,
                        представленные ниже.
                        Также вы можете отправить все ссылки на ваш <strong>персональный email</strong>, для этого нажмите кнопку
                        <span class="badge badge-success"><?= Icon::show('envelope') ?>Отправить ссылки на личный email</span>
                        (ваш персональный email должен быть заполнен в личном кабинете)
                    </p>
                </div>

                <?php if ($model->registration_link): ?>
                    <div class="col-3">
                        <a href="<?= $model->registration_link ?>" target="_blank"><?= Icon::show('autoprefixer', ['framework' => Icon::FAB]) ?>
                            Anketolog</a>
                        <?php if (file_exists(Yii::getAlias('@web') . Yii::$app->params['module']['st']['guest']['path'] . $model->id
                            . '/registration_link.png')
                        ): ?>
                            <img src="<?= Url::home() . Yii::$app->params['module']['st']['guest']['path'] . $model->id . '/registration_link.png' ?>"
                                 class="img-fluid" style="max-width: 150px;">
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($model->webinar_link): ?>
                    <div class="col-3">
                        <a href="<?= $model->webinar_link ?>" target="_blank"><?= Icon::show('globe') ?>Webinar</a>
                        <?php if (file_exists(Yii::getAlias('@web') . Yii::$app->params['module']['st']['guest']['path'] . $model->id
                            . '/webinar_link.png')
                        ): ?>
                            <img src="<?= Url::home() . Yii::$app->params['module']['st']['guest']['path'] . $model->id . '/webinar_link.png' ?>"
                                 class="img-fluid" style="max-width: 150px;">
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($model->youtube_link): ?>
                    <div class="col-3">
                        <a href="<?= $model->youtube_link ?>" target="_blank"><?= Icon::show('youtube', ['framework' => Icon::FAB]) ?>YouTube</a>
                        <?php if (file_exists(Yii::getAlias('@web') . Yii::$app->params['module']['st']['guest']['path'] . $model->id
                            . '/youtube_link.png')
                        ): ?>
                            <img src="<?= Url::home() . Yii::$app->params['module']['st']['guest']['path'] . $model->id . '/youtube_link.png' ?>"
                                 class="img-fluid" style="max-width: 150px;">
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($model->vk_link): ?>
                    <div class="col-3">
                        <a href="<?= $model->vk_link ?>" target="_blank"><?= Icon::show('vk', ['framework' => Icon::FAB]) ?>ВКонтакте</a>
                        <?php if (file_exists(Yii::getAlias('@web') . Yii::$app->params['module']['st']['guest']['path'] . $model->id
                            . '/vk_link.png')
                        ): ?>
                            <img src="<?= Url::home() . Yii::$app->params['module']['st']['guest']['path'] . $model->id . '/vk_link.png' ?>"
                                 class="img-fluid" style="max-width: 150px;">
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php
Modal::end();