<?php

use kartik\icons\Icon;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model app\modules\jk\models\Order */

Modal::begin([
    'title' => '<h4>' . Icon::show('paper-plane') . 'Повторно отправить заявку куратору</h4>',
    'toggleButton' => ['label' => Icon::show('paper-plane') . 'Повторно отправить заявку куратору', 'class' => 'btn btn-success'],
    'footer' => Html::a(Icon::show('paper-plane') . 'Отправить заявку', ['set-new-status', 'id' => $model->id, 'new-status-code' => 'CURATOR_CHECK'],
            ['class' => 'btn btn-success'])
        . Html::a('Отмена', '#', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']),
    'size' => Modal::SIZE_LARGE,
]); ?>
    <p>
        Вы действительно хотите повторно отправить заявку для проверки куратором в вашем филиале?
    </p>
<?php Modal::end();