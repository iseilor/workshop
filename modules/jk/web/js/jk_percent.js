$(document).ready(function () {

    // Маска для процентов
    //$('#percent-percent_rate').inputmask("decimal", {min: 1, max: 100, allowMinus: false, digits: 1});

    // Кнопка рассчитать
    $('#percent-calc').click(function () {

        $('#result').html(''); // Очищаем предыдущее значение

        // Проверяем заполненность всех полей
        $all_full = true;
        var inputs = $('#percent-form .required :input');
        inputs.each(function () {
            if ($(this).val() == '') {
                $all_full = false;
            }
        });

        // Проверяем. чтобы не было ошибок
        var groups = $('#percent-form .form-group');
        groups.each(function (i, el) {
            if ($(el).hasClass('has-error')) {
                $all_full = false;
            }
        });

        // Нет ошибок на форме
        if ($all_full) {
            var data = $('#percent-form').serialize();
            $.ajax({
                url: $(this).data('url'),
                type: 'POST',
                data: data,
                success: function (result) {
                    toastr["success"]("Расчёт суммы компенсации процентов успешно завершён", "Расчёт окончен");
                    $('#result').html(result);
                    $('#percent-compensation_result').val(1);
                    $('#percent-compensation_count').val($('#result_money').html().replace(/\s+/g, ''));
                    $('#percent-compensation_years').val($('#result_years').html().replace(/\s+/g, ''));
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

    // Кнопка "Сохранить расчёт" в результатах расчёта
    $('body').on('click', '#result-save', function () {
        $('#btn-save').click();
    });

    // Кнопка "Отправить расчёт на почту"
    $('body').on('click', '#result-send-email', function () {
        var data = $('#percent-form').serialize();
        $.ajax({
            url: $(this).data('url'),
            type: 'POST',
            data: data,
            success: function (result) {
                toastr["success"]("Рассчёт суммы компенсации процентов отправлен на ваш email", "Письмо отправлено");
            },
            error: function () {
                toastr["error"]("Письмо по техническим причинам не отправлено, свяжитесь с администраторами системы", "Письмо не отправлено");
            }
        });
        return false;
    });
});