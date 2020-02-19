// Если форма с TABS то перевключаем на первую вкладку с ошибкой
$('#profile-update').on('afterValidate', function(event, messages, errorAttributes){
    if(errorAttributes.length > 0) {
        var errElement = $('#' + errorAttributes[0].id);
        var pane = errElement.closest('.tab-pane');
        var tabId = pane[0].id;
        $('.nav-tabs a[href="#' + tabId + '"]').tab('show');
        return false;
    }
});