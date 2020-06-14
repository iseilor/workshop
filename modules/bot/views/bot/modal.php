<?php

use kartik\icons\Icon;

?>
<div class="modal fade" id="bot-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title bot-modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body bot-modal-body">

            </div>
            <div class="card-footer">
                <div class="float-right">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><?= Icon::show('check') ?> Да, теперь мне всё понятно</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?= Icon::show('check') ?> Нет, у меня остались вопросы</button>
                </div>
            </div>
        </div>
    </div>
</div>