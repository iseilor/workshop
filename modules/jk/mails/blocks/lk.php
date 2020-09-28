<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<p>
    Также Вы можете самостоятельно следить за статусами ваших заявок в
    <?= Html::a('личном кабинете', Url::base(true).Url::to('/user/cabinet')) ?>.
</p>