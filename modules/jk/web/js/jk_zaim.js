$(document).ready(function () {
    // Кнопка рассчитать Займ
    $('#zaim-calc').click(function () {

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

        // Нет ошибок на форме bk
        if ($all_full) {
            zaim_calc();
        } else {
            alert('Есть ошибки на форме');
        }
    });
});

// Функция рассчёта займа
function zaim_calc() {

    // Прожиточный минимум в зависимости от региона
    rf_area = $('#zaim-rf_area').val();
    PM = 15382;
    switch (rf_area) {
        case '1':
            PM = 15382;
            break;
        case '2':
            PM = 10916;
            break;
        case '20':
        case '19':
            PM = 9068;
            break;
        case '3':
            PM = 8221;
            break;
        case '4':
            PM = 9223;
            break;
        case '5':
            PM = 9398;
            break;
        case '6':
            PM = 9650;
            break;
        case '7':
            PM = 8317;
            break;
        case '8':
            PM = 9429;
            break;
        case '9':
            PM = 9345;
            break;
        case '10':
            PM = 8456;
            break;
        case '11':
            PM = 8523;
            break;
        case '12':
            PM = 8967;
            break;
        case '13':
            PM = 8930;
            break;
        case '14':
            PM = 10599;
            break;
        case '15':
            PM = 8403;
            break;
        case '16':
            PM = 9747;
            break;
        case '17':
            PM = 9212;
            break;
        case '18':
            PM = 9095;
            break;
        default:
            PM = 15382;
            break;
    }
    console.log('Прожиточный минимум в этом регионе: ' + PM);

    // Максимальный срок займа
    MSZ = 10;
    family_income = $('#zaim-family_income').val(); // Среднемесячный доход на одного члена семьи
    if (family_income > 35000) {
        MSZ = 7;
    } else if (family_income > 25000) {
        MSZ = 8;
    } else if (family_income > 15000) {
        MSZ = 10;
    } else {
        MSZ = 10;
    }
    console.log('Максимальный срок займа: ' + MSZ);

    // Максимальный размер займа
    family_count = $('#zaim-family_count').val();
    MRZ = (family_income - PM) * family_count * MSZ * 12;
    console.info('Максимальный размер займа: '+MRZ);

    result_money = MRZ;
    result_year = MSZ;

    // Показываем плашку с результатом
    $('#result_money').html(result_money);
    $('#result_year').html(result_year);
    $('#result').removeClass('d-none');

    // Скрыте поля формы
    $('#percent-compensation_result').val('1');
    $('#percent-compensation_count').val(result_money);
    $('#percent-compensation_years').val(result_year);
}