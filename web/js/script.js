$(document).ready(function () {
    $(function () {

        // Статус-сообщения
        $('[data-toggle="tooltip"]').tooltip({
            placement: "bottom",
            trigger: "focus",
            html: true
        });

        // Картинки
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

        $(":input").inputmask();
        $('.inputmask-date').inputmask("99.99.9999");

    });
});