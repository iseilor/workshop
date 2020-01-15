$(document).ready(function () {

    // Кнопка рассчитать
    $('#zaim-calc').click(function () {
        $('#result').html(''); // Очищаем предыдущее значение

        // Проверяем заполненность всех полей
        $all_full = true;
        var inputs = $('#zaim-form .required :input');
        inputs.each(function () {
            if ($(this).val() == '') {
                $all_full = false;
            }
        });

        // Проверяем. чтобы не было ошибок
        var groups = $('#zaim-form .form-group');
        groups.each(function (i, el) {
            if ($(el).hasClass('has-error')) {
                $all_full = false;
            }
        });

        // Нет ошибок на форме
        if ($all_full) {
            var data = $('#zaim-form').serialize();
            $.ajax({
                url: $(this).data('url'),
                type: 'POST',
                data: data,
                success: function (result) {
                    toastr["success"]("Расчёт суммы материальной помощи успешно завершён", "Расчёт окончен");
                    $('#result').html(result);
                    $('#zaim-compensation_result').val(1);
                    $('#zaim-compensation_count').val($('#result_money').html().replace(/\s+/g, ''));
                    $('#zaim-compensation_years').val($('#result_years').html().replace(/\s+/g, ''));
                },
                error: function () {
                    toastr["error"]("В процессе расчёта произошла ошибка. Попробуйте изменить данные вашей формы и повторить расчёт. Если ошибка сохранится, то свяжитесь с администраторами системы", "Ошибка");
                }
            });
        } else {
            toastr["error"]("Заполните все поля формы корректными данными и повторите расчёт", "Ошибка");
            return false;
        }
    });

    // Кнопка "Отправить расчёт на почту"
    $('body').on('click', '#result-send-email', function () {
        var data = $('#zaim-form').serialize();
        $.ajax({
            url: $(this).data('url'),
            type: 'POST',
            data: data,
            success: function (result) {
                toastr["success"]("Рассчёт суммы займа отправлен на ваш email", "Письмо отправлено");
            },
            error: function () {
                toastr["error"]("Письмо по техническим причинам не отправлено, свяжитесь с администраторами системы", "Письмо не отправлено");
            }
        });
        return false;
    });

    // Кнопка "Сохранить расчёт" в результатах расчёта
    $('body').on('click', '#result-save', function () {
        $('#btn-save').click();
    });
});