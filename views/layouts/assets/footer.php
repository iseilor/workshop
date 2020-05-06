<footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
        От IT для людей с любовью
    </div>
    <!-- Default to the left -->
    <strong>Москва, ПАО Ростелеком &copy; 2K20</strong>
    <a href="https://workshop.center.rt.ru">Workshop</a>.
    МРФ Центр. Все права защищены.
</footer>

<?php
// Сообщения чата
use yii\helpers\Url;

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