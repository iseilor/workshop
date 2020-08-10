<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Icon::show('calculator') . Module::t('calculator', 'Calculator');
$this->params['breadcrumbs'][] = ['label' => Icon::show('home') . Module::t('module', 'JK'), 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <?= Html::tag('h3', $this->title, ['class' => 'card-title']) ?>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <?= Html::tag('p', Module::t('calculator', 'CALC_INFO')) ?>
                <?= Html::tag('h1', Module::t('calculator', 'CALC_QUESTION')) ?>
                <?= Html::a(
                    Icon::show('house-user') . Module::t('calculator', 'CALC_ANSWER_1'),
                    Url::to(['/jk/percent/create']),
                    ['class' => 'btn btn-success btn-lg btn-a']
                ) ?>
                <?= Html::a(
                    Icon::show('house-user') . Module::t('calculator', 'CALC_ANSWER_2'),
                    Url::to(['/jk/zaim/create']),
                    ['class' => 'btn btn-warning btn-lg btn-a']
                ) ?>
            </div>
        </div>
    </div>
</div>