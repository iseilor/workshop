$(document).ready(function () {


    // Маска для процентов
    $('#percent-percent_rate').inputmask("decimal", { min: 1, max: 100, allowMinus: false,digits: 1 });

    // Кнопка рассчитать
    $('#percent-calc').click(function () {

        var data = $('#percent-form').serialize();
        $.ajax({
            url: $(this).data('url'),
            type: 'POST',
            data: data,
            success: function(result){
                $('#result').html(result);
                $('#percent-compensation_result').val(1);
                $('#percent-compensation_count').val($('#result_money').html().replace(/\s+/g,''));
                $('#percent-compensation_years').val($('#result_years').html().replace(/\s+/g,''));
            },
            error: function(){
                alert('Ошибка');
            }
        });
        return false;

        /*

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

        // Нет ошибок на форме bk
        if ($all_full) {
            jk_percent_calc();
        } else {
            alert('Не все поля формы заполнены, либо на ней есть ошибки');
        }*/
    });

    // Показываем подсказки
    $('.show-hint').click(function(){
        $(this).parent().parent().find('.hint-block p').toggleClass('d-none');
        return false;
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
            success: function(result){
                alert(result);
            },
            error: function(){
                alert('Ошибка');
            }
        });
        return false;
    });
});

// Функция рассчёта компенсации процентов
function jk_percent_calc() {

    // Считаем возраст
    now = Date.now();
    birth = Date.parse($('#percent-date_birth').val().replace(/(\d+).(\d+).(\d+)/, '$3/$2/$1'));
    age = Math.floor((now - birth) / 31536000000);
    console.log('Возраст: ' + age);

    // Выход на пенсию
    gender = $('#percent-gender').val();
    if (gender == 1) {
        console.log('Пол: М');
        date_pension = birth + 60 * 31536000000; // В 60 лет у мужчин
    } else {
        console.log('Пол: Ж');
        date_pension = birth + 55 * 31536000000; // В 55 лет у женщин
    }
    console.log('Выход на пенсию: ' + new Date(date_pension).toString());

    // Кол-во лет до пенсии
    result_year = Math.floor((date_pension - now) / 31536000000);
    console.log('Кол-во лет до пенсии: ' + result_year);

    // Максимальный срок компенсации процентов
    if (result_year > 10) {
        result_year = 10;
    }
    if (result_year < 0) {
        result_year = 0;
    }

    percent_family_income = $('percent-family_income').val(); // Ставка на одного члена семьи

    // Ставка компенсации процентов SKP
    if (age <= 35) {
        if (percent_family_income > 35000) {
            SKP = 6;
        } else if (percent_family_income > 25000) {
            SKP = 8;
        } else if (percent_family_income > 15000) {
            SKP = 10;
        } else {
            SKP = 12;
        }
    } else {
        if (percent_family_income > 35000) {
            SKP = 4;
        } else if (percent_family_income > 25000) {
            SKP = 6;
        } else if (percent_family_income > 15000) {
            SKP = 8;
        } else {
            SKP = 10;
        }
    }

    // Корпоративная норма площади жилья
    family_count = $('#percent-family_count').val();
    KN = 35; // Корпоративная норма в метрах
    if (family_count == 1) {
        KN = 35;
    } else if (family_count == 2) {
        KN = 50;
    } else {
        KN = 20 * family_count;
    }

    // Коэффициент учёта корпоративной нормы KUKN
    area_buy = $('#percent-area_buy').val();
    cost_user = $('#percent-cost_user').val();
    cost_total = $('#percent-cost_total').val();
    KUKN = KN / (area_buy - (cost_user / cost_total * area_buy));
    if (KUKN > 1) {
        KUKN = 1;
    }

    percent_count = $('#percent-percent_count').val();
    percent_rate = $('#percent-percent_rate').val();
    result_money = percent_count * (SKP / percent_rate) * KUKN;

    // Округляем до 1000
    result_money = Math.round(result_money / 1000) * 1000;

    // Показываем плашку с результатом
    $('#result_money').html(result_money);
    $('#result_year').html(result_year);
    $('#result').removeClass('d-none');

    // Скрыте поля формы
    $('#percent-compensation_result').val('1');
    $('#percent-compensation_count').val(result_money);
    $('#percent-compensation_years').val(result_year);
}