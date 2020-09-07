<?php

use app\modules\user\models\ChildSearch;

$searchModel = new ChildSearch(['user_id' => Yii::$app->user->identity->id]);
$dataProvider = $searchModel->search([]);
$dataProvider->query->andWhere(['deleted_at' => null]);

echo $this->render('@app/modules/user/views/child/grid-view', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
]);
?>



<?php if ($model->filling_step == 3): ?>
    <div class="card card-solid card-secondary  ">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <?=  $form->field($model, 'filling_step')->hiddenInput(['value' => 3])->label(false) ?>
                </div>
                <div class="col-2">
                    <?= \yii\helpers\Html::submitButton(
                        \kartik\icons\Icon::show('play') . 'Далее',
                        [
                            'class' => 'btn btn-success float-right',
                            'id' => 'btn-save',
                            'value' => 1,
                            'name' => 'save',
                        ]
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>