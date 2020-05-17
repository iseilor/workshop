<?php

use yii\helpers\Html;
use yii\helpers\Url;

$class = 'bg-danger';

if ($message->is_curator){
    $class='bg-success';
}
echo Html::a($message->user->fio . Html::tag('span',$message->createdDateTime,['class'=>'float-right badge '.$class]),
    Url::to(['','user'=>$message->user_id],true),
    ['class' => 'nav-link']);