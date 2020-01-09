<?php

use app\components\grid\LinkColumn;
use app\modules\user\Module;
use yii\grid\ActionColumn;


use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Module::t('module', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-4">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="<?= Url::home() ?>img/user4-128x128.jpg"
                         alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">Иванов Иван</h3>
                <p class="text-muted text-center">Программист</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right"><?= $model->email; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Телефон</b> <a class="float-right"><?= $model->phone; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Дата рождения</b> <a class="float-right"><?= Yii::$app->formatter->format($model->birth_date, 'date'); ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Пол</b> <a class="float-right"><?= $model->gender; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Дата трудоустройства</b> <a class="float-right"><?= Yii::$app->formatter->format($model->work_date, 'date'); ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Стаж, полных лет</b> <a class="float-right"><?=$experience?></a>
                    </li>
                </ul>
                <?= Html::a('<i class="fas fa-user-edit"></i> ' . Module::t('module', 'Profile Update'), ['update'], [
                    'class' => 'btn 
        btn-primary',
                ]) ?>
                <?= Html::a('<i class="fas fa-user-lock"></i> ' . Module::t('module', 'Password Change'), ['password-change'], [
                    'class' => 'btn 
        btn-primary',
                ]) ?>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


        <!--<div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Обо мне</h3>
            </div>

            <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Образование</strong>

                <p class="text-muted">
                    МГУ, Мордовский Государственный Университет, г.Саранск
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Офис</strong>

                <p class="text-muted">г.Москва, ул.Киевское шоссе, д.6, БЦ Comcity</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Навыки</strong>

                <p class="text-muted">
                    <span class="tag tag-danger">Дизайн</span>
                    <span class="tag tag-success">Программирование</span>
                    <span class="tag tag-info">Продажи</span>
                    <span class="tag tag-warning">Спорт</span>
                    <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>
                <strong><i class="far fa-file-alt mr-1"></i> Заметки</strong>

                <p class="text-muted">Очень люблю общаться с коллеками, но пожалуйста не звоните
                    мне после 23:00. Спасибо
                </p>
            </div>

        </div>-->

    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#activity"
                                            data-toggle="tab"><i class="fas fa-calculator
                                            nav-icon"></i> Калькуляции процентов</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline"
                                            data-toggle="tab"><i class="fas fa-calculator
                                            nav-icon"></i> Калькуляции займов</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings"
                                            data-toggle="tab"><i class="fas fa-cog"></i>
                            Настройки</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="activity">
                        <?php Pjax::begin(); ?>
                        <?=
                        GridView::widget([
                            'dataProvider' => $percentDataProvider,
                            /*'filterModel' => $percentSearchModel,*/
                            'columns' => [
                                'id',
                                'created_at',
                                'compensation_count',
                                'compensation_years',
                                ['class' => ActionColumn::className()],
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>

                    <div class="tab-pane" id="timeline">
                        <?php Pjax::begin(); ?>
                        <?=
                        GridView::widget([
                            'dataProvider' => $zaimDataProvider,
                            /*'filterModel' => $zaimSearchModel,*/
                            'columns' => [
                                'id',
                                'created_at',
                                'compensation_count',
                                'compensation_years',
                                ['class' => ActionColumn::className()],
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>

                    <div class="tab-pane" id="settings">
                        <form class="form-horizontal">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>

</div>


<!--
<div class="user-profile">
    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'username',
        'email',
    ],
]) ?>
</div>
-->