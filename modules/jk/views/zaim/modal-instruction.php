<?php

use kartik\icons\Icon;

?>
<div class="modal fade" id="modal-instruction">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><?=Icon::show('info')?> Инструкция по работе с калькулятором займа</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $this->render('_instruction')?>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-info"><?=Icon::show('folder')?> Документы</button>
                <button type="button" class="btn btn-info"><?=Icon::show('question')?> Ответы</button>
                <button type="button" class="btn btn-info"><?=Icon::show('user')?> Написать куратору</button>
                <button type="button" class="btn btn-success float-right" data-dismiss="modal"><?=Icon::show('check')?> Да, мне всё понятно</button>
            </div>
        </div>
    </div>
</div>