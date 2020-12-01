<?php

use yii\widgets\DetailView;
use app\modules\user\models\Spouse;

$spouse = Spouse::find()->where(['user_id' => $model->created_by])->one();
?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'money_summa_year:currency',
        'money_month_pay:currency',
        'money_nalog_year:currency',
        'money_user_pay:currency',
        viewFieldFile($model, 'ndfl2_file', Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->ndfl2_file),
        viewFieldFile($model, 'spravka_zp_file', Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->spravka_zp_file),
        viewFieldFile($spouse, 'ndfl2_file', Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->ndfl2_file),
        viewFieldFile($spouse, 'salary_file', Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->salary_file),
        viewFieldFile($model, 'other_income_file', Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->other_income_file),
        /*'money_oklad:currency',
        'money_summa_year:currency',
        'money_nalog_year:currency',
        viewFieldFile($model, 'ndfl2_file', Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->ndfl2_file),
        [
            'attribute' => 'is_do',
            'value' => (isset($model->is_do) && $model->is_do) ? 'Да' : 'Нет',
        ],
        viewFieldFile($model, 'spravka_zp_file', Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->spravka_zp_file),
        'money_month_pay:currency',
        'money_user_pay:currency',*/
    ]
]) ?>