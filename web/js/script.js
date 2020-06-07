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

        // Запоминаем активную вкладку
        $(function() {
            $('a[data-toggle="pill"]').on('click', function (e) {
                localStorage.setItem('lastTab', $(e.target).attr('id'));
            });
            var lastTab = localStorage.getItem('lastTab');
            if (lastTab) {
                $('#'+lastTab).tab('show');
            }
        });

        // Если форма с TABS то перевключаем на первую вкладку с ошибкой
        $('.form-tabs').on('afterValidate', function(event, messages, errorAttributes){
            if(errorAttributes.length > 0) {
                var errElement = $('#' + errorAttributes[0].id);
                var pane = errElement.closest('.tab-pane');
                var tabId = pane[0].id;
                $('.nav-tabs a[href="#' + tabId + '"]').tab('show');
                return false;
            }
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


        // Ajax удаление
        // TODO: Нужно сделать по уму
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            var row = $(this).parent().parent();
            var deleteUrl = $(this).attr('href');
            var pjaxContainer = 'child-grid-view';
            var result = confirm('Вы действительно хотите удалить?');
            if(result) {
                $.ajax({
                    url: deleteUrl,
                    type: 'post',
                    error: function(xhr, status, error) {
                        alert('There was an error with your request.' + xhr.responseText);
                    }
                }).done(function(data) {
                    //$.pjax.reload('#' + $.trim(pjaxContainer), {timeout: 3000});
                    $(row).remove();
                });
            }
        });
    });
});