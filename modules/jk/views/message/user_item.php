<?php

use yii\helpers\Html;
use yii\helpers\Url;

$class = 'bg-danger';

// Цвет плашки со временем
if ($message->is_curator){
    $class='bg-success';
}else{
    $diff = time()-$message->created_at;
    $class='bg-info';
    if ($diff>60*60*24){
        $class='bg-warning';
    }
    if ($diff>60*60*48){
        $class='bg-danger';
    }
}

echo Html::a($message->user->fio . Html::tag('span',$message->createdDateTime,['class'=>'float-right badge '.$class]),
    Url::to(['','user'=>$message->user_id],true),
    ['class' => 'nav-link']);