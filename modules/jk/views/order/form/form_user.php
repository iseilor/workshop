<?php

use app\modules\user\models\User;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

$user = User::findOne(Yii::$app->user->identity->id);
?>
    <p>
        <?= Html::a(Icon::show('edit') . 'Редактировать профиль',
            ['/user/profile/update'],
            ['class' => 'btn btn-warning', 'target' => '_blank']) ?>
        <?= Html::button(Icon::show('sync-alt') . 'Обновить информацию',
            ['class' => 'btn btn-primary', 'id' => 'btn-update']) ?>
    </p>
<?php Pjax::begin(['id' => 'user-info']);
echo DetailView::widget([
    'model' => $user,
    'attributes' => [
        'tab_number',
        'fio',
        [
            'label' => $user->attributeLabels()['gender'],
            'value' => User::getGenderName($user->gender),
        ],
        'birth_date:date',
        'position',
        'work_department_full',
        'work_address',
        'experience',
        [
            'label' => 'Паспорт',
            'format' => 'raw',
            'value' =>
                $user->passport_series . ' ' . $user->passport_number . '; ' .
                'Выдан: ' . $user->passport_department . '; ' .
                'Код подразделения: ' . $user->passport_code . '; ' .
                'Дата выдачи: ' . date('d.m.Y', $user->passport_date) . '; ' .
                'Адрес регистрации: ' . $user->passport_registration . ';<br/>' .
                Html::a(
                    Icon::show('file-pdf') . $user->attributeLabels()['passport_file'],
                    Url::to(['/' . Yii::$app->params['module']['user']['path'] . $user->id . '/' . $user->passport_file]),
                    ['target' => '_blank']),
        ],
    ],
]);
Pjax::end();

$script = <<< JS
$(document).ready(function() {
    $('#btn-update').click(function(){
         $('#btn-update').find('i').addClass('fa-spin');
        $.pjax.reload({
            container: '#user-info',
            async: true,
            timeout: false
        }).done(function() {
          $('#btn-update').find('i').removeClass('fa-spin');
          toastr["success"]("Информация по кандидату успешно обновлена", "Успех");
        });
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);