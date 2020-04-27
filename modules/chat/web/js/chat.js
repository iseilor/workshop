$(document).ready(function () {
    // Отправить сообщение в чат
    $('#chat-form').on('beforeSubmit', function(){
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function (result) {
                $('#chat-form').find('input').val('');
                //chatListUpdate();
            },
            error: function () {
                alert('Ошибка')
            }
        });
        return false;
    });
});

function chatListUpdate(){
    $.ajax({
        url: '/chat/chat/list',
        success: function (result) {
            $('#chat-list').html(result);
        },
        error: function () {
            alert('Ошибка')
        }
    });
}