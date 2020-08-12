<?php
/* @var $faq app\modules\jk\models\Faq */
?>


<?php if ($faq->question==''): ?>
    <?=$faq->answer?>
<?php else: ?>
    <p>
        <a data-toggle="collapse" href="#faq-<?=$faq->id?>" role="button" aria-expanded="false" aria-controls="faq-<?=$faq->id?>">
            <?=$faq->question?>
        </a>
    </p>
    <div class="collapse" id="faq-<?=$faq->id?>">
        <div class="card card-body">
            <?=$faq->answer?>
        </div>
    </div>
<?php endif; ?>