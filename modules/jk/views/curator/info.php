<?php
    use app\modules\user\models\User;
    use yii\helpers\Html;
?>
<?php
$js=<<< JS
$("#jk-curator-contacts").on('click',function(e){
e.preventDefault();
var x = document.getElementById("jk-curator-info");
if (x.style.display === "none") {
x.style.display = "block";
} else {
x.style.display = "none";
}
});
JS;
$this->registerJs($js,\yii\web\view::POS_READY);
?>

    <?php if (Yii::$app->user->isGuest): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center"> Для получения информации по куратору "Жилищной Кампании" необходимо <a href="login">авторизоваться</a></h3>
                </div>
            </div>
        </div>
    </div>
    <?php  return; endif;  ?>
<?php
    $user = User::findOne(Yii::$app->user->identity->getId());

    $curatorRf = '';
    if ($user) {
        $rf = \app\modules\jk\models\Rf::findOne(['title' => $user->rf]);
        if ($rf) {
            $curator = User::findOne($rf->user_id);
            $curatorRf = $rf->title;
        }else{
            // TODO: Избавиться от жёсткого ID=13
            $rf=\app\modules\jk\models\Rf::findOne(13);
        }
    }


    if (!isset($curator) || !$curator) {
        $curator = User::findOne(['email' => 'l_gorshkova@center.rt.ru']);
        $curatorIsFound = false;
    } else {
        $curatorIsFound = true;
    }


?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <?= Html::img("/workshop/files/user/photo/".$curator->photo, ['alt' => $curator->fio, 'class' => 'profile-user-img img-fluid img-circle']) ?>
                </div>
                <h3 class="profile-username text-center"> <?= $curator->fio?></h3>

                <p class="text-muted text-center">Ответственный по жилищной программе.<br/> <?= $curatorRf ?></p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Телефон</b> <span class="float-right col-md-9"> <?= $rf->phone ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <a  class="float-right col-md-9" href="mailto:<?= $rf->email ?>?subject=Жилищная%20кампания"><?= $rf->email ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Адрес</b> <span class="float-right col-md-9"><?= $rf->address ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


