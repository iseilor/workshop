<?php

use app\modules\video\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\video\models\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('youtube', ['framework' => Icon::FAB]) . Module::t('module', 'Video Instruction');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <a href="http://hr.center.rt.ru/news/1">
                    <img class="img-fluid pad" src="/files/news/1/1_thumb_20200225184914.jpg" alt="Корпоративная жилищная программа 2020 года">
                    <h5 style="min-height: 72px;">Создание и редактирование заявки для участия в Жилищной Программе</h5>
                </a>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <a href="http://hr.center.rt.ru/news/1">
                    <img class="img-fluid pad" src="/files/news/1/1_thumb_20200225184914.jpg" alt="Корпоративная жилищная программа 2020 года">
                    <h5 style="min-height: 72px;">Согласование заявки всеми вышестоящими руководителями</h5>
                </a>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <a href="http://hr.center.rt.ru/news/1">
                    <img class="img-fluid pad" src="/files/news/1/1_thumb_20200225184914.jpg" alt="Корпоративная жилищная программа 2020 года">
                    <h5 style="min-height: 72px;">Проверка и согласование заявки куратором Жилищной Программы</h5>
                </a>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <a href="http://hr.center.rt.ru/news/1">
                    <img class="img-fluid pad" src="/files/news/1/1_thumb_20200225184914.jpg" alt="Корпоративная жилищная программа 2020 года">
                    <h5 style="min-height: 72px;">Промо-ролик возможностей портала по приёму заявок по Жилищной Программы</h5>
                </a>
            </div>
        </div>
    </div>
</div>
