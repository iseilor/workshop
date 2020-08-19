$(document).ready(function () {

    // Выделяем пункт в SIDEBAR, т.к. фактический открывается страница совершенно по другому URL
    $('.sidebar-jk-doc a').addClass('active');
    $('.sidebar-jk, .sidebar-jk-doc').addClass('active menu-open');
    $('.sidebar-jk').children('a').addClass('active');

});