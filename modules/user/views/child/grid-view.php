<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\user\models\Child;
use app\modules\user\Module;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>
    <p>
        <?= Html::a(Icon::show('plus') . Module::t('child', 'Create Child'),
            ['/user/child/create'],
            ['class' => 'btn btn-success', 'target' => '_blank']) ?>
        <?= Html::button(Icon::show('sync-alt') . 'Обновить информацию',
            ['class' => 'btn btn-primary', 'id' => 'btn-child-grid-view-update']) ?>
    </p>
<?php
Pjax::begin(['id' => 'child-grid-view']);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => LinkColumn::class,
            'attribute' => 'id',
            'controller' => '/user/child/view',
        ],
        [
            'class' => LinkColumn::class,
            'attribute' => 'fio',
            'controller' => '/user/child/view',
        ],
        [
            'attribute' => 'gender',
            'content' => function ($data) {
                return Child::getGenderList()[$data->gender];
            },
        ],
        'date:date',
        'age',
        [
            'attribute' => 'is_invalid',
            'content' => function ($data) {
                return (isset($data->is_invalid) && $data->is_invalid) ? '<span class="badge badge-danger">Да</span>' : 'Нет';
            },
        ],
        [
            'attribute' => 'is_study',
            'content' => function ($data) {
                return (isset($data->is_study) && $data->is_study) ? '<span class="badge badge-info">Да</span>' : 'Нет';
            },
        ],
        [
            'class' => ActionColumn::class,
            'controller' => '/user/child',
            'gridViewId' => 'child-grid-view',
            'buttonOptions' => ['target' => '_blank'],
        ],
    ],
]);
Pjax::end();

$script = <<< JS
$(document).ready(function() {
    $('#btn-child-grid-view-update').click(function(){
         $('#btn-child-grid-view-update').find('i').addClass('fa-spin');
        $.pjax.reload({
            container: '#child-grid-view',
            async: true,
            timeout: false
        }).done(function() {
          $('#btn-child-grid-view-update').find('i').removeClass('fa-spin');
          toastr["success"]("Обновление таблицы с детьми завершено", "Успех");
        });
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
