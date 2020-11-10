$(document).ready(function () {

    // Кнопка "Отправить расчёт на почту"
    $('body').on('click', '.btn-manager', function () {
        $.ajax({
            url: $(this).attr('href'),
            type: 'GET',
            success: function (result) {
                toastr["success"](result.toString(), "Email-уведомление отправлено");
                console.log(result);
            },
            error: function () {
                toastr["error"]("Обратитесь к администратору системы", 'Произошла ошибка');
            }
        });
        return false;
    });
});