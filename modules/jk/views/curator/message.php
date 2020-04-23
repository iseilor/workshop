<div class="direct-chat-msg">
    <div class="direct-chat-infos clearfix">
        <span class="direct-chat-name float-left">Иван Иванович</span>
        <span class="direct-chat-timestamp float-right"><?=date('d.m.Y H:i:s',$model->created_at)?></span>
    </div>
    <img class="direct-chat-img" src="/img/user1-128x128.jpg" alt="Message User Image">
    <div class="direct-chat-text">
        <?=$model->message?>
    </div>
</div>