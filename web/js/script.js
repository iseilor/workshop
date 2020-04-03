$(document).ready(function () {
    $(function () {

        // Статус-сообщения
        $('[data-toggle="tooltip"]').tooltip({
            placement: "bottom",
            trigger: "focus",
            html: true
        });

        // Картинки
        $(document).on('click', '[data-toggle="lightbox"]', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });


        // Кнопка прикрепить файлы
        bsCustomFileInput.init();


        // https://github.com/RobinHerbots/Inputmask
        //$(":input").inputmask();
        //$('.inputmask-date').inputmask("99.99.9999");
        //$('.inputmask-money').inputmask("000 000 000,00");

        //decimal mask
        /*Inputmask("( 999){+|1}", {
            positionCaretOnClick: "radixFocus",
            radixPoint: ",",
            _radixDance: true,
            numericInput: true,
            placeholder: "0",
            definitions: {
                "0": {
                    validator: "[0-9\uFF11-\uFF19]"
                }
            }
        }).mask('.inputmask-money');*/
    });
});