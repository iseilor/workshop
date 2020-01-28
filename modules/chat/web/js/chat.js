$(document).ready(function () {

    // Отправить сообщение в чат
    $('body').on('click', '#btn-message-send', function () {
        var $yiiform = $('#chat-form');
        $.ajax({
            url: $yiiform.attr('action'),
            type: 'POST',
            data: yiiform.serializeArray(),
            success: function (result) {
                alert('123');
            },
            error: function () {

            }
        });
        return false;
    });
});