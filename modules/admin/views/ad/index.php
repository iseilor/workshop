<?php

use app\modules\admin\Module;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $email  */
/* @var $data  */

$this->title = Module::t('module', 'Active Directory');
$this->params['breadcrumbs'][] = ['label' => '<i class="nav-icon fas fa-tools"></i> Admin', 'url' => ['/admin']];
$this->params['breadcrumbs'][] = 'AD';
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header ">
                <h3 class="card-title">Active Directory</h3>
            </div>
            <?php ActiveForm::begin(['method' => 'GET','id' => 'ad-form','action'=> Url::to(['/admin/ad'])]); ?>
                <div class="card-body">
                    <p>Для того, чтобы получить информацию о сотрудники из <strong>Active Directory</strong> укажите его email и нажмите кнопку <strong>Поиск</strong></p>
                    <div class="input-group input-group">
                        <?= Html::input('email', 'email', $email, ['class' => 'form-control']) ?>
                        <span class="input-group-append">
                            <?= Html::submitButton('<i class="fas fa-search"></i> Поиск</button>', ['class' => 'btn btn-info btn-flat']) ?>
                        </span>
                    </div>
                </div>
            <?php ActiveForm::end();?>
        </div>

        <div class="card card-info">
            <div class="card-header ">
                <h3 class="card-title">Результаты поиск из Active Directory</h3>
            </div>
            <div class="card-body">
                <?php if ($data): ?>
                    <?= DetailView::widget(
                        [
                            'model' => $data,
                            'attributes' => array_keys($data),
                        ]
                    );
                    ?>
                <?php else: ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Предупреждение!</h5>
                        Вы неверно указали email, либо сотрудника с указанным email <strong><?=$email?></strong> не существует
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>