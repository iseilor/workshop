<?php

use kartik\icons\Icon;
use yii\bootstrap4\Modal;
use yii\helpers\Html;

/* @var $model app\modules\jk\models\Order */

Modal::begin([
    'title' => '<h4>' . Icon::show('paper-plane') . 'Отправить заявку</h4>',
    'toggleButton' => ['label' => Icon::show('paper-plane') . 'Отправить заявку', 'class' => 'btn btn-success'],
    'footer' => Html::a(Icon::show('paper-plane') . 'Отправить заявку', ['set-new-status', 'id' => $model->id, 'new-status-code' => 'MANAGER_WAIT'],
            ['class' => 'btn btn-success'])
        . Html::a('Отмена', '#', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']),
    'size' => Modal::SIZE_LARGE,
]); ?>
    <ol>
        <li>Согласование заявки вашими непосредственными руководителями</li>
        <li>Проверка куратором Жилищной Программы в вашем филиале</li>
        <li>Передача заявки в Жилищную Комиссию МРФ Центр</li>
    </ol>
<?php Modal::end();