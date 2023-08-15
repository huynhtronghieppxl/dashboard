$(function () {
    // $('.navbar-logo').attr('logo-theme', getCookieShared('navbar-logo'));
    // $('.nav-dashboard').attr('navbar-theme', getCookieShared('nav-dashboard'));
    // $('.header-navbar').attr('header-theme', getCookieShared('header-theme'));
    // $('.pcoded-item > li.active > a:before').attr('active-item-theme', getCookieShared('active-item-theme'));
    /**
     * logo-theme
     * */
    $('.logo-theme').removeClass('border-selected');
    $('.logo-theme').each(function () {
        if ($(this).attr('logo-theme') === getCookieShared('navbar-logo')) {
            $(this).addClass('border-selected');
        }
    });
    $('.logo-theme').on('click', function () {
        $('.logo-theme').removeClass('border-selected');
        $(this).addClass('border-selected');
        saveCookieShared('navbar-logo', $(this).attr('logo-theme'));
    });

    /**
     * nav-dashboard
     * */
    $('.navbar-theme').removeClass('border-selected');
    $('.navbar-theme').each(function () {
        if ($(this).attr('navbar-theme') === getCookieShared('navbar-menu')) {
            $(this).addClass('border-selected');
        }
    });
    $('.navbar-theme').on('click', function () {
        $('.navbar-theme').removeClass('border-selected');
        $(this).addClass('border-selected');
        saveCookieShared('navbar-menu', $(this).attr('navbar-theme'));
    });

    /**
     * header-theme
     * */
    $('.header-theme').removeClass('border-selected');
    $('.header-theme').each(function () {
        if ($(this).attr('header-theme') === getCookieShared('header-theme')) {
            $(this).addClass('border-selected');
        }
    });
    $('.header-theme').on('click', function () {
        $('.header-theme').removeClass('border-selected');
        $(this).addClass('border-selected');
        saveCookieShared('header-theme', $(this).attr('header-theme'));
    });

    /**
     * active-item-theme
     * */
    $('.active-item-theme').removeClass('border-selected');
    $('.active-item-theme').each(function () {
        if ($(this).attr('active-item-theme') === getCookieShared('active-item-theme')) {
            $(this).addClass('border-selected');
        }
    });
    $('.active-item-theme').on('click', function () {
        $('.active-item-theme').removeClass('border-selected');
        $(this).addClass('border-selected');
        saveCookieShared('active-item-theme', $(this).attr('active-item-theme'));
    });

    /**
     * title-theme
     * */
    $('.leftheader-theme').removeClass('border-selected');
    $('.leftheader-theme').each(function () {
        if ($(this).attr('lheader-theme') === getCookieShared('title-theme')) {
            $(this).addClass('border-selected');
        }
    });
    $('.leftheader-theme').on('click', function () {
        $('.leftheader-theme').removeClass('border-selected');
        $(this).addClass('border-selected');
        saveCookieShared('title-theme', $(this).attr('lheader-theme'));
    });

    /**
     * icon color
     * */
    $('#menu-effect input[type="radio"]').each(function () {
        if ($(this).val() == getCookieShared('icon-color')) {
            $(this).prop('checked', true);
        } else {
            $(this).prop('checked', false);
        }
    });
    $('#menu-effect').on('change', function () {
        saveCookieShared('icon-color', $(this).find('input[type="radio"]:checked').val());
    });
});
