"use strict";
$(document).ready(function() {
    // $('.theme-loader').addClass('loaded');
    $('.theme-loader').animate({
        'opacity': '0',
    }, 1200);
    setTimeout(function() {
        $('.theme-loader').remove();
    }, 2000);

    $('.theme-loader-data').animate({
        'opacity': '0',
    }, 1200);
    setTimeout(function() {
        $('.theme-loader-data').remove();
    }, 2000);
    // $('.pcoded').addClass('loaded');
});
