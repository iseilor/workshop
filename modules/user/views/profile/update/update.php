<?php

use app\modules\user\Module;
use kartik\file\FileInput;
use kartik\icons\Icon;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */


$this->title = '<i class="fas fa-user-edit"></i> ' . Module::t('module', 'Profile Update');
$this->params['breadcrumbs'][] = ['label' => '<i class="fas fa-user"></i> ' . Module::t('module', 'Profile'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-primary card-outline card-outline-tabs" style="border-top: none;">
    <div class="card-header p-0 border-bottom-0">

        <?php
        $tabs = [
            ['name' => Icon::show('user') . 'Общие данные', 'id' => 'general', 'tab-class' => 'active', 'selected' => 'true', 'tabs-class' => 'show active'],
            ['name' => Icon::show('user-tie') . 'Сотрудник', 'id' => 'user', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
            ['name' => Icon::show('address-card') . 'Паспорт', 'id' => 'passport', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
            ['name' => Icon::show('id-card') . 'СНИЛС', 'id' => 'snils', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
            //['name' => Icon::show('baby') . 'Дети', 'id' => 'childs', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
        ];
        echo Html::ul($tabs, [
            'item' => function ($item, $index) {
                return Html::tag(
                    'li',
                    Html::a($item['name'], '#tabs-' . $item['id'], [
                        'class' => 'nav-link ' . $item['tab-class'],
                        'id' => 'tab-' . $item['id'],
                        'data-toggle' => 'pill',
                        'role' => 'tab',
                        'aria-controls' => 'tabs-' . $item['id'],
                        'aria-selected' => $item['selected'],
                    ]),
                    ['class' => 'nav-item']
                );
            },
            'class' => 'nav nav-tabs',
            'id' => 'custom-tabs-three-tab',
            'role' => 'tablist',
        ]) ?>
    </div>

    <?php $form = ActiveForm::begin(['options' => ['id'=>'profile-update','enctype' => 'multipart/form-data']]); ?>

    <div class="card-body">
        <div class="tab-content" id="custom-tabs-three-tabContent">
            <?php foreach ($tabs as $tab): ?>
                <div class="tab-pane fade <?= $tab['tabs-class'] ?>" id="tabs-<?= $tab['id'] ?>" role="tabpanel" aria-labelledby="tab-<?= $tab['id'] ?>">
                    <?= $this->render( $tab['id'], ['model' => $model, 'form' => $form]) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="card-footer">
        <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerJsFile(Yii::$app->homeUrl.'js/index.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>