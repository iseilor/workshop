<?php

use app\modules\bot\models\BotSearch;

$items = BotSearch::find()->where(['bot_id' => null])->all();

echo '<div>';
foreach ($items as $item) {
    echo $this->render('item', ['model' => $item]);
}
echo '</div>';


$script = <<< JS
$(document).ready(function() {
   $("body").on("click", ".btn-bot", function(e) {
        parent = $(this).parent();
        $(parent).find('.btn-success').removeClass('btn-success').addClass('btn-primary');
        $(this).removeClass('btn-primary').addClass('btn-success');
        $.ajax({
           type : 'post',
           url: $(this).data('url'),
           success: function(data) {
               data = JSON.parse(data);
               $(parent).next().remove();
               if (data.links){
                   $(parent).after("<div><hr/>Выберите подраздел<br><div>"+data.links+"</div></div>");
               }
               if (data.modal){
                   $('.bot-modal-title').html('<i class="fas fa-'+data.icon+'"></i> '+data.title);
                   $('.bot-modal-body').html(data.text);
                   $('#bot-modal').modal('show')
               }
           }
        });
        e.stopPropagation();
        e.preventDefault();
        return false;
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);

