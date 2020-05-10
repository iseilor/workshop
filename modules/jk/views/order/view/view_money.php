<?php

use yii\widgets\DetailView;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'money_oklad:currency',
        'money_summa_year:currency',
        'money_nalog_year:currency',
        viewFieldFile($model, 'ndfl2_file', Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->ndfl2_file),
        [
            'attribute' => 'is_do',
            'value' => (isset($model->is_do) && $model->is_do) ? 'Да' : 'Нет',
        ],
        viewFieldFile($model, 'spravka_zp_file', Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->spravka_zp_file),
        'money_month_pay:currency',
        'money_user_pay:currency',
    ]
]) ?>