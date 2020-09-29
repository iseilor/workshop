<?php

use kartik\icons\Icon;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model app\modules\jk\models\Order */

Modal::begin([
    'title' => '<h4>' . Icon::show('paper-plane') . 'Отправить заявку</h4>',
    'toggleButton' => ['label' => Icon::show('paper-plane') . 'Отправить заявку', 'class' => 'btn btn-success'],
    'footer' => Html::a(Icon::show('paper-plane') . 'Отправить заявку', ['set-new-status', 'id' => $model->id, 'new-status-code' => 'DOC'],
            ['class' => 'btn btn-success'])
        . Html::a('Отмена', '#', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']),
    'size' => Modal::SIZE_LARGE,
]); ?>
    <p>
        Проверьте пожалуйста, что вы приложили все документы, которые запросил куратор жилищной программы.<br/>
        Вы действительно хотите отправить заявку куратору?
    </p>
<?php Modal::end();