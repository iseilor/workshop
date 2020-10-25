<?php

use app\modules\user\models\Spouse;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

// Ищем супругу. Если есть, то можно редактировать, если нет, то можно добавить
// Обновить можно всегда
// var_dump($spouse->type);
// die();

if (!isset($user)) {
    $user = Yii::$app->user->identity;
}

if (!isset($spouse)) {
     $spouse = Spouse::find()->where(['user_id' => $user->id])->one();
}
?>
    <p>
        <?php if ($spouse): ?>
            <?= Html::a(Icon::show('edit') . 'Изменить информацию', ['/user/spouse/' . $spouse->id . '/update'],
                ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
        <?php else: ?>
            <?= Html::a(Icon::show('plus') . 'Добавить информацию', ['/user/spouse/create?userId='.$user->id],
                ['class' => 'btn btn-success', 'target' => '_blank']) ?>
        <?php endif; ?>
        <?= Html::button(Icon::show('sync-alt') . 'Обновить информацию',
            ['class' => 'btn btn-primary', 'id' => 'btn-spouse-update']) ?>
    </p>

<?php

Pjax::begin(['id' => 'spouse-view']);
if ($spouse) {
    echo DetailView::widget([
        'model' => $spouse,
        'attributes' => [
            [
                'attribute' => 'type',
                'value' => Spouse::getTypeList()[$spouse->type],
            ],
            [
                'attribute' => 'fio',
                'format' => 'raw',
                'value' => Html::a($spouse->fio, ['/user/spouse/' . $spouse->id], ['target' => '_blank']),
            ],
            /*[
                'attribute' => 'gender',
                'value' => Spouse::getGenderList()[$spouse->gender],
            ],
            'date:date',*/
            viewFieldFile($spouse, 'marriage_file', Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->marriage_file),
        ],
    ]);
} else {
    $data = [
        'Наличие супруги' => 'Нет',
    ];
    echo DetailView::widget([
        'model' => $data,
        'attributes' => [
            'Наличие супруги',
        ],
    ]);
}
Pjax::end();


$script = <<< JS
$(document).ready(function() {
    $('#btn-spouse-update').click(function(){
         $('#btn-spouse-update').find('i').addClass('fa-spin');
        $.pjax.reload({
            container: '#spouse-view',
            async: true,
            timeout: false
        }).done(function() {
          $('#btn-spouse-update').find('i').removeClass('fa-spin');
          toastr["success"]("Информация по супруге(у) успешно обновлена", "Успех");
        });
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);