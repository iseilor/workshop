<?php

use kartik\icons\Icon;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model app\modules\jk\models\Order */

Modal::begin([
    'title' => '<h4>' . Icon::show('paper-plane') . 'Отправить заявку</h4>',
    'toggleButton' => ['label' => Icon::show('paper-plane') . 'Отправить заявку', 'class' => 'btn btn-success'],
    'footer' => Html::a(Icon::show('paper-plane') . 'Отправить заявку', ['set-new-status', 'id' => $model->id, 'new-status-code' => 'MANAGER_WAIT'],
            ['class' => 'btn btn-success'])
        . Html::a('Отмена', '#', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']),
    'size' => Modal::SIZE_LARGE,
]); ?>
    <p>
        Перед отправкой заявки на участие в <?=Html::a(Icon::show('home').'Жилищной Программе',Url::to('/jk'))?>
        рекомендуем вам ещё раз проверить все указанные вами данные и прикреплённые документы.
        Дальнейшие изменения заявки без согласования с куратором по <?=Html::a(Icon::show('home').'Жилищной Программе',Url::to('/jk'))?>
        в вашем филиале будут невозможны. Ваша заявка
        после отправки автоматически пройдёт следующие этапы:
    </p>
    <ol>
        <li>Согласование заявки вашими непосредственными руководителями</li>
        <li>Проверка куратором <?=Html::a(Icon::show('home').'Жилищной Программы',Url::to('/jk'))?> в вашем филиале</li>
        <li>Передача заявки в Жилищную Комиссию МРФ Центр</li>
    </ol>
<p>
    На протяжении всех этапов движения заявки вы будите получать email-уведомления, также вы можете самостоятельно следить за статусом вашей заявки
    в <?=Html::a(Icon::show('briefcase').'личном кабинете',Url::to('/user/cabinet'))?> портала
</p>
<?php Modal::end();