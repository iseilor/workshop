<?php

use app\modules\pulsar\assets\PulsarAsset;
use app\modules\pulsar\Module;
use app\modules\user\models\User;
use kartik\icons\Icon;
use yii\console\widgets\Table;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $users User */
/* @var $usersVoted User */
/* @var $usersNotVoted Array */
/* @var $healthData Array */
/* @var $moodData Array */
/* @var $jobData Array */
/* @var $healthAverage Float */
/* @var $moodAverage Float */
/* @var $jobAverage Float */

$this->title = Icon::show('chart-bar') . Module::t('module', 'Pulsars Statistics');
$this->params['breadcrumbs'][] = [
    'label' => Icon::show('heartbeat') . Module::t('module', 'Pulsars'),
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;

PulsarAsset::register($this);

$canvas_style = 'min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;';
?>

    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?= Icon::show('calendar-check') ?>Сегодня</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <h5>Проголосовали: <span class="badge badge-info"><?= round((count($usersVoted) / count($users)) * 100) . '%' ?></span></h5>
                        <canvas id="voted" style="<?= $canvas_style ?>"></canvas>
                    </div>
                    <hr/>
                    <div>
                        <h5>Не проголосовали: <span class="badge badge-danger"><?=count($usersNotVoted)?></span></h5>
                        <?php
                        echo Html::ol($usersNotVoted, [
                            'item' => function ($item, $index) {
                                return Html::tag(
                                    'li',
                                    '<small title="id:'.$item['id'].'">'.$item['fio'].'</small>'
                                );
                            },
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?= Icon::show('heart') ?>Здоровье</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <h5>Текущий показатель: <span class="badge badge-info"><?=$healthAverage?></span>
                        </h5>
                        <canvas id="health_today" style="<?= $canvas_style ?>"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?= Icon::show('smile') ?>Настроение</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <h5>Текущий показатель: <span class="badge badge-info"><?=$moodAverage?></span>
                        </h5>
                        <canvas id="mood_today" style="<?= $canvas_style ?>"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><?= Icon::show('desktop') ?>Работа</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <h5>Текущий показатель: <span class="badge badge-info"><?=$jobAverage?></span>
                        </h5>
                        <canvas id="job_today" style="<?= $canvas_style ?>"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
// Передаём параметры в JS
$this->registerJsVar('usersCount', count($users), yii\web\View::POS_HEAD);
$this->registerJsVar('usersVotedCount', count($usersVoted), yii\web\View::POS_HEAD);
$this->registerJsVar('usersNotVotedCount', count($usersNotVoted), yii\web\View::POS_HEAD);

$this->registerJsVar('healthData', $healthData, yii\web\View::POS_HEAD);
$this->registerJsVar('moodData', $moodData, yii\web\View::POS_HEAD);
$this->registerJsVar('jobData', $jobData, yii\web\View::POS_HEAD);
?>