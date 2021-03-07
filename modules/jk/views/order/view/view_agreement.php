<?php

use app\modules\jk\models\Status;
use app\modules\user\models\Spouse;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$user = $model->createdUser;
$spouse = Spouse::find()->where(['user_id' => $model->created_by])->one();

$attr = [];

if ($model->file_agree_personal_data) {
    $attr[] = [
        'label' => 'Согласие на обработку персональных данных (' . $user->fio . ')',
        'format' => 'raw',
        'value' => Html::a(
            Icon::show('file-pdf') . $model->attributeLabels()['file_agree_personal_data_form'],
            Url::to(['/jk/order/' . $model->id . '/acs-ctrl?model=order&field=file_agree_personal_data']),
            ['target' => '_blank']),
    ];
}
if ($spouse && $spouse->type == 1) {
    if ($spouse->personal_data_file) {
        $attr[] = [
            'label' => 'Согласие на обработку персональных данных (' . $spouse->fio . ')',
            'format' => 'raw',
            'value' => Html::a(
                Icon::show('file-pdf') . $spouse->attributeLabels()['personal_data_file'],
                Url::to(['/jk/order/' . $spouse->id . '/acs-ctrl?model=spouse&field=personal_data_file']),
                ['target' => '_blank']),
        ];
    }
}
if (is_array($user->children) && count($user->children) > 0) {
    foreach ($user->children as $child) {
        if (!isset($child->deleted_at)) {
            if ($child->file_personal) {
                $attr[] = [
                    'label' => 'Согласие на обработку персональных данных (' . $child->fio . ')',
                    'format' => 'raw',
                    'value' => Html::a(
                        Icon::show('file-pdf') . $child->attributeLabels()['file_personal'],
                        Url::to(['/jk/order/' . $child->id . '/acs-ctrl?model=child&field=file_personal']),
                        ['target' => '_blank']),
                ];
            }
        }
    }
}
if ($model->order_file) {
    $attr[] = [
        'label' => 'Заявление о предоставлении помощи в улучшении жилищных условий',
        'format' => 'raw',
        'value' => Html::a(
            Icon::show('file-pdf') . $model->attributeLabels()['order_file_form'],
            Url::to(['/jk/order/' . $model->id . '/acs-ctrl?model=order&field=order_file']),
            ['target' => '_blank']),
    ];
}
if (in_array($model->status_id,[Status::findOne(['code' => 'COMMISSION_YES'])->id])) {
    if ($model->docs_egrn_file) {
        $attr[] = [
            'label' => $model->attributeLabels()['docs_egrn_file_form'],
            'format' => 'raw',
            'value' => Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['docs_egrn_file_form'],
                Url::to(['/jk/order/' . $model->id . '/acs-ctrl?model=order&field=docs_egrn_file']),
                ['target' => '_blank']),
        ];
    }
    if (!$model->is_mortgage && $model->docs_loan_agreement_file) {
        $attr[] = [
            'label' => $model->attributeLabels()['docs_loan_agreement_file_form'],
            'format' => 'raw',
            'value' => Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['docs_loan_agreement_file_form'],
                Url::to(['/jk/order/' . $model->id . '/acs-ctrl?model=order&field=docs_loan_agreement_file']),
                ['target' => '_blank']),
        ];
    }
    if ($model->is_mortgage && $model->docs_additional_agreement_file) {
        $attr[] = [
            'label' => $model->attributeLabels()['docs_additional_agreement_file_form'],
            'format' => 'raw',
            'value' => Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['docs_additional_agreement_file_form'],
                Url::to(['/jk/order/' . $model->id . '/acs-ctrl?model=order&field=docs_additional_agreement_file']),
                ['target' => '_blank']),
        ];
    }
}
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => $attr,
]) ?>