<?php
use kartik\icons\Icon;
use yii\helpers\Html;use yii\helpers\Url;
?>

<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        От IT для людей с  <span style="color:red;"><?=Icon::show('heart')?></span>
    </div>
    Москва &copy; 2021, ПАО Ростелеком МРФ Центр |
    Тех.поддержка:
    <a href="tel:+74959800148" title="Горячая линия" target="_blank"><?=Icon::show('phone')?> 8 (495) 980-01-48</a>
    <a href="mailto: skit@rt.ru" title="Почта support" target="_blank"><?=Icon::show('envelope')?>skit@rt.ru</a>

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