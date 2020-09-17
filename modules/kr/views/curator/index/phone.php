<?php




/* @var $model app\modules\kr\models\Curator */

use kartik\icons\Icon;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

Modal::begin([
    'title' => '<h4>' . Icon::show('user-graduate') . $model->fio . '</h4>',
    'toggleButton' => ['label' => $model->phone,'tag'=>'span'],
    'footer' => Html::a(Icon::show('times') . 'Закрыть', '#', ['class' => 'btn btn-primary', 'data-dismiss' => 'modal']),
    'size' => Modal::SIZE_SMALL,
]);
echo 'Скоро здесь будет QR-code :)';
/*
use Da\QrCode\QrCode;
$qrCode = (new QrCode('tel:8 951 051 13 00'))
    ->setSize(250)
    ->setMargin(5)
    ->useForegroundColor(51, 153, 255);
echo '<img src="' . $qrCode->writeDataUri() . '">';
*/
Modal::end();