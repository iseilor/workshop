<?php

use kartik\icons\Icon;

?>
<aside class="control-sidebar control-sidebar-dark chat-bot-sidebar">
    <div class="p-3 control-sidebar-content">
        <h5><?=Icon::show('robot')?>Чат-бот РОСТИК</h5>
        <hr class="mb-2">
        Укажите раздел, по которому у вас есть вопрос<br/>
        <?php echo $this->render('@app/modules/bot/views/bot/list');?>
    </div>
</aside>