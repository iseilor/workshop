<?php

use kartik\icons\Icon;
use yii\bootstrap4\Modal;
use yii\helpers\Html;

/* @var $model app\modules\jk\models\Order */

Modal::begin([
    'title' => '<h4>' . Icon::show('check') . 'Отправить заявку на проверку куратору</h4>',
    'toggleButton' => ['label' => Icon::show('check') . 'Отправить заявку на проверку куратору', 'class' => 'btn btn-success'],
    'footer' => Html::a(Icon::show('check') . 'Отправить заявку на проверку куратору', ['set-new-status', 'id' => $model->id,'new-status-code'=>'CURATOR_CHECK'], ['class' => 'btn btn-success'])
        . Html::a('Отмена', '#', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']),
    'size' => Modal::SIZE_LARGE,
]);
echo '<h2>Вы действительно хотите отправить заявку на проверку куратору в вашем филиале?</h2><hr/>';
echo '<small>После того, как вы отправите заявку на проверку куратору в вашем филиале, вы уже не сможете внести 
в неё больше никакие изменения (любые изменения: замужество, рождение детей, изменение процентной
ставки - всё это будет вноситься через специальную форму и через согласование с вашим куратором).
Также куратор может вернуть вашу заявку на исправление, если в ней будут какие-то ошибки.
После полной проверки куратор передаст заявку на согласование вашим руководителям. 
После полной цепочки согласования ваша заявка попадёт на жилищную комиссию. Всё это будет происходить в автоматическом
режиме без необходимости вашего участия, но вы будите получать email-уведомления, как только будет меняться статус вашей заявки.
Также вы можете самостоятельно следить за статусом вашей заявки через личный кабинет пользователя. 
</small>';
Modal::end();