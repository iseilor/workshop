<?php

use app\modules\jk\assets\JkAdminAsset;
use app\modules\jk\models\Message;
use app\modules\jk\models\Order;
use app\modules\jk\models\OrderStop;
use app\modules\jk\models\Percent;
use app\modules\jk\models\Status;
use app\modules\jk\models\Zaim;
use app\modules\jk\Module;
use app\modules\nsi\models\Color;
use kartik\icons\Icon;
use yii\console\widgets\Table;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;


/**
 * @var $this yii\web\View
 */

$this->title = Icon::show('tools') . 'Админка ЖП';
$this->params['breadcrumbs'][] = ['label' => Icon::show('home') . Module::t('module', 'JK'), 'url' => ['/jk']];
$this->params['breadcrumbs'][] = $this->title;

JkAdminAsset::register($this);

// Калькуляторы на компенсации процентов
$percentsCount = Percent::find()->access()->count();                                         // Всего
$percentY = Percent::find()->access()->andWhere('compensation_count>0')->count();     // Положительных
$percentN = Percent::find()->access()->andWhere('compensation_count=0')->count();     // Отрицательных

// Калькулятор займа
$zaimsCount = Zaim::find()->access()->count();                                         // Всего
$zaimY = Zaim::find()->access()->andWhere('compensation_count>0')->count();     // Положительных
$zaimN = Zaim::find()->access()->andWhere('compensation_count=0')->count();     // Отрицательных

// Заявки, сгрупированные по статусам
$ordersGroupStatus = Order::find()->access()
    ->select(['COUNT(*) AS cnt', 'status_id'])
    ->groupBy(['status_id'])
    ->all();
$ordersGroupStatus = ArrayHelper::map($ordersGroupStatus, 'status_id', 'cnt');
$statuses = ArrayHelper::map(Status::find()->where(['id' => array_keys($ordersGroupStatus)])->all(), 'id', 'title');
$statusColors = ArrayHelper::map(Status::find()->where(['id' => array_keys($ordersGroupStatus)])->all(), 'id', 'color');
foreach ($statusColors as $key => &$value) {
    $value = Color::getColorValues()[$value];
}

// Отказы
$orderCount = Order::find()->access()->count();
$orderStopCount = OrderStop::find()->access()->count();

// Отказы сгруппированные по статусам заявки
$ordersStopGroupStatus = OrderStop::find()
    ->select(['COUNT(*) AS cnt', 'jk_stop.status_id'])
    ->leftJoin('jk_stop', 'jk_stop.id = jk_order_stop.stop_id')
    ->groupBy(['jk_stop.status_id'])
    ->asarray()->all();
$ordersStopGroupStatus = ArrayHelper::map($ordersStopGroupStatus, 'status_id', 'cnt');


// Сообщения, ожидающие ответа от куратора
/*
$messagesGroup = Message::find()
    ->select(['max(id) as max','user_id','count(*) as cnt'])
    ->groupBy(['user_id'])
    ->all()->asarray();
$userLastMessage = ArrayHelper::map($messagesGroup, 'user_id', 'max');
$messagesUser = Message::find()->select('*')->WHERE(['in', 'id', $userLastMessage]) ->andWhere(['is_curator'=>false])->count();
$messagesUserBadge = '';
if ($messagesUser>0){
    $messagesUserBadge = Html::tag('span',$messagesUser,['class'=>'badge bg-danger']);
}*/
?>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">

            <?= Html::a('<div class="info-box mb-3">
            <span class="info-box-icon bg-primary elevation-1">' . Icon::show('percent') . '</span>
            <div class="info-box-content">
                <span class="info-box-text">Проценты</span>
                <span class="info-box-number">' . $percentsCount . '</span>
            </div>
        </div>', Url::to(['/jk/percent'], true));
            ?>
            <div class="card">
                <div class="card-body">
                    <div class="chart">
                        <h6>Проценты</h6>
                        <canvas id="percents"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <?= Html::a('<div class="info-box mb-3">
            <span class="info-box-icon bg-primary elevation-1">' . Icon::show('wallet') . '</span>
            <div class="info-box-content">
                <span class="info-box-text">Займы</span>
                <span class="info-box-number">' . $zaimsCount . '</span>
            </div>
        </div>', Url::to(['/jk/zaim'], true));
            ?>
            <div class="card">
                <div class="card-body">
                    <div class="chart">
                        <h6>Займы</h6>
                        <canvas id="zaims"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <?= Html::a('<div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1">' . Icon::show('ruble-sign') . '</span>
            <div class="info-box-content">
                <span class="info-box-text">Заявки</span>
                <span class="info-box-number">' . $orderCount . '</span>
            </div>
        </div>', Url::to(['/jk/order'], true));
            ?>
            <div class="card">
                <div class="card-body">
                    <div class="chart">
                        <h6>Заявки</h6>
                        <canvas id="orders"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <?= Html::a('<div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1">' . Icon::show('stop') . '</span>
            <div class="info-box-content">
                <span class="info-box-text">Отмена сотрудником</span>
                <span class="info-box-number">' . $orderStopCount . '</span>
            </div>
        </div>', Url::to(['/jk/order-stop'], true));
            ?>
            <div class="card">
                <div class="card-body">
                    <div class="chart">
                        <h6>Отмена сотрудником</h6>
                        <canvas id="voted"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Отказы сотрудников, сгруппированные по статусам -->
        <div class="col-12 col-sm-6 col-md-3 d-none">
            <div class="card">
                <div class="card-body">
                    <div class="chart">
                        <h6>Отказы сотрудников, сгруппированные по статусам</h6>
                        <canvas id="stopGroupStatus"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= Icon::show('home') ?>Жилищная программа 2021</h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php $dataProvider = new ActiveDataProvider([
                        'query' => \app\modules\jk\models\Rf::find(),
                        'pagination' => [
                            'pageSize' => 20,
                        ],
                    ]);
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            [
                                'attribute' => 'title',
                                'label' => 'РФ / МРФ'
                            ],
                            [
                                'attribute' => 'orderCount',
                                'label' => 'Кол-во заявок'
                            ],
                        ]

                    ]); ?>
                </div>
            </div>
            <div class="card-footer">
                Данные актуальны на <?= date('d.m.Y h:i:s') ?>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= Icon::show('tools') ?>Панель администратора</h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h3><?= Icon::show('database') ?>Данные</h3>
                        <?php echo $this->render('index_data'); ?>

                    </div>
                    <div class="col-md-6">
                        <h3><?= Icon::show('book') ?>Справочники</h3>
                        <?php echo $this->render('index_dir'); ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <span class="text-danger"><?= Icon::show('exclamation') ?> Будьте очень внимательны при работе с административной панелью</span>
            </div>
        </div>
    </section>

<?php
// Проценты
$this->registerJsVar('percentY', $percentY, yii\web\View::POS_HEAD);
$this->registerJsVar('percentN', $percentN, yii\web\View::POS_HEAD);

// Займа
$this->registerJsVar('zaimY', $zaimY, yii\web\View::POS_HEAD);
$this->registerJsVar('zaimN', $zaimN, yii\web\View::POS_HEAD);

// Заявки, сгруппированные по статусам
$this->registerJsVar('ordersGroupStatus', $ordersGroupStatus, yii\web\View::POS_HEAD);
$this->registerJsVar('statuses', $statuses, yii\web\View::POS_HEAD);
$this->registerJsVar('statusColors', $statusColors, yii\web\View::POS_HEAD);
// Отказы
$this->registerJsVar('orderCount', $orderCount, yii\web\View::POS_HEAD);
$this->registerJsVar('orderStopCount', $orderStopCount, yii\web\View::POS_HEAD);

// Отказы, сгруппированные по статусам
$this->registerJsVar('ordersStopGroupStatus', $ordersStopGroupStatus, yii\web\View::POS_HEAD);