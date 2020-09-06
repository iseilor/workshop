<?php
use kartik\icons\Icon;
use yii\helpers\Html;use yii\helpers\Url;
?>

<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        От IT для людей с  <span style="color:red;"><?=Icon::show('heart')?></span>
    </div>
    Москва &copy; 2019-2020 | ПАО Ростелеком | МРФ Центр |
    <?=Html::a(Icon::show('info'). \app\modules\main\Module::t('module', 'Information'),['/main/default/about'])?> |
    <?=Html::a(Icon::show('envelope'). \app\modules\main\Module::t('module', 'Feedback'),['/main/default/feedback'])?>
</footer>

<?php
// Сообщения чата

$url = Url::to('/chat/chat/messages',true);
$script = <<< JS
    $(document).ready(function() {
        /*var sec = 1;
        setInterval(function(){
             $.ajax({
                  url: '$url',
                  data: {time:sec},
                  success: function(data){
                        data = JSON.parse(data);
                        $.each(data,function(index, value){
                            //console.log(value.fio+': '+value.message);
                            toastr["info"]("<strong>"+value.fio+"</strong>: "+value.message, "Чат");
                        });
                  }
             });
        }, sec*1000);*/
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);