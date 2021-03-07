<?php

use yii\widgets\DetailView;
use app\modules\user\models\Spouse;

$spouse = Spouse::find()->where(['user_id' => $model->created_by])->one();

$attr = [
    'money_summa_year:currency',
    'money_month_pay:currency',
    'money_user_pay:currency',
    viewFieldFile($model, 'ndfl2_file', ['/jk/order/' . $model->id . '/acs-ctrl?model=order&field=ndfl2_file']),
    viewFieldFile($model, 'spravka_zp_file', ['/jk/order/' . $model->id . '/acs-ctrl?model=order&field=spravka_zp_file']),
    viewFieldFile($model, 'other_income_file', ['/jk/order/' . $model->id . '/acs-ctrl?model=order&field=other_income_file']),
];
if ($spouse) {
    array_push($attr,
        viewFieldFile($spouse, 'ndfl2_file', ['/jk/order/' . $spouse->id . '/acs-ctrl?model=spouse&field=ndfl2_file']),
        viewFieldFile($spouse, 'salary_file', ['/jk/order/' . $spouse->id . '/acs-ctrl?model=spouse&field=salary_file'])
    );
}
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => $attr,
]) ?>

<?php

$script = <<< JS
$(document).ready(function() {
    $('table#w6 tbody tr:eq(7)').before('<tr><th><h4><i class="fas fa-baby"></i> Супруг(а)</h4></th><td></td></tr>');
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
