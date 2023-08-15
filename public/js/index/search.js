$(function () {
    shortcut.add('F9', function () {
        $('.search-text-full-layout').focus();
        $('.search-text-full-layout').addClass('show-search-text-full-layout');
    });

    $('.search-text-full-layout').on('input paste', function (e) {
        if (e.keyCode !== 38 && e.keyCode !== 40) {
            $('.search-results-full-layout').show();
            $('.search-results-full-layout').removeClass('d-none');
            $('.search-text-full-layout').addClass('show-search-text-full-layout');
        }
    });

    $('.search-text-full-layout').on('focus', function (e) {
        $('.search-results-full-layout').show();
        $('.search-results-full-layout').removeClass('d-none');
        $('.search-text-full-layout').addClass('show-search-text-full-layout');
        $('.search-results-full-layout .search-item-full-layout').each(function (i, v) {
            if (i > 10) {
                return false;
            } else {
                $(v).show();
            }
        })
    });
    $(document).mouseup(function (e) {
        $('.search-item-full-layout').removeClass('active');
        let container = $('#search-group-full-layout');
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $('.search-text-full-layout').removeClass('show-search-text-full-layout');
            $('.search-results-full-layout').addClass('d-none');
            $('.search-text-full-layout').val('');
        }
    });

    $('.search-text-full-layout').on('keyup', function (e) {
        $('.search-results-full-layout .search-item-full-layout').hide();
        if (e.keyCode !== 38 && e.keyCode !== 40 && e.keyCode !== 13) {
            if ($(this).val() === '') {
                $('.search-results-full-layout').show();
                $('.search-results-full-layout').removeClass('d-none');
                $('.search-text-full-layout').addClass('show-search-text-full-layout');
                $('.search-results-full-layout .search-item-full-layout').each(function (i, v) {
                    if (i > 10) {
                        return false;
                    } else {
                        $(v).show();
                    }
                })
            } else {
                let g = removeVietnameseString($(this).val().toLowerCase());
                $('.search-results-full-layout .search-item-full-layout .pcoded-mtext').each(function () {
                    let s = removeVietnameseString($(this).text().toLowerCase());
                    $(this).closest('.search-item-full-layout')[(s.indexOf(g) !== -1 && $('.search-results-full-layout .search-item-full-layout:visible').length < 10) ? 'show' : 'hide']();
                });
                $('.search-results-full-layout .search-item-full-layout').removeClass('active');
                $('.search-results-full-layout').find('.search-item-full-layout:visible').eq(0).addClass('active');
            }
        } else if (e.keyCode === 13 && $(this).val() !== '' && $('.search-results-full-layout .search-item-full-layout.active').length === 1) {
            window.location = $('.search-results-full-layout .search-item-full-layout.active a').attr('href');
        } else if (e.keyCode === 13 && $(this).val() !== '' && $('.search-results-full-layout .search-item-full-layout.active').length === 0) {
            WarningNotify('Không tìm thấy chức năng tương ứng !');
        }
    });

    $('.search-text-full-layout').on('keyup', function (e) {
        if (e.keyCode === 38 && $(this).val() !== '') {
            e.preventDefault();
            $('.search-results-full-layout .search-item-full-layout:visible').each(function (i, v) {
                if ($(v).hasClass('active') === true) {
                    $(v).removeClass('active');
                    if (i > 0) {
                        $('.search-results-full-layout .search-item-full-layout:visible').eq(i - 1).addClass('active');
                    } else {
                        $('.search-results-full-layout .search-item-full-layout:visible').eq($('.search-results-full-layout .search-item-full-layout:visible').length - 1).addClass('active');
                    }
                    return false;
                }
            })
        } else if (e.keyCode === 40 && $(this).val() !== '') {
            e.preventDefault();
            $('.search-results-full-layout .search-item-full-layout:visible').each(function (i, v) {
                if ($(v).hasClass('active') === true) {
                    $(v).removeClass('active');
                    if (i < $('.search-results-full-layout .search-item-full-layout:visible').length - 1) {
                        $('.search-results-full-layout .search-item-full-layout:visible').eq(i + 1).addClass('active');
                    } else {
                        $('.search-results-full-layout .search-item-full-layout:visible').eq(0).addClass('active');
                    }
                    return false;
                }
            })
        } else if ($(this).val() === '') {
            e.preventDefault();
            $('.search-results-full-layout .search-item-full-layout:visible').each(function (i, v) {
                if ($(v).hasClass('active') === true) {
                    $(v).removeClass('active');
                }
            })
        }
    })
});
