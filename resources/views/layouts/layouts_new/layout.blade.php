<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Techres</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/head.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/dataTable.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/header.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/menu_left.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/menu_sub.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/modal.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/input.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/validate.css', env('IS_DEPLOY_ON_SERVER'))}}"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/cssV2/element.css', env('IS_DEPLOY_ON_SERVER'))}}"/>

    @include('layouts.head')
    <link rel='stylesheet' type="text/css" href='{{asset('css/icon/regular/all.css', env('IS_DEPLOY_ON_SERVER'))}}'>
</head>
<body>
<div class="seemt-container">
    @include('layouts.layouts_new.header')
    @include('layouts.support')
    <div class="seemt-main-container" id="content-body-techres">
        @if(Session::get('SESSION_KEY_LEVEL') > 0)
            @if(count(array_intersect(Session::get(SESSION_PERMISSION), ['OWNER', 'VIEW_ALL'])) > 0)
                @include('layouts.layouts_new.menu_owner')
            @else
                @include('layouts.layouts_new.menu_left')
            @endif
        @else
            @include('layouts.layouts_new.menu_sell_solution')
        @endif
        @include('layouts.layouts_new.content')
    </div>
    @if(config('app.CONFIG_BUILD_NUMBER'))
        <div style="color: #000; position: fixed; bottom: 10px; right: 16px"><span style="">Build number :</span><span
                id="version-number">{{config('app.CONFIG_BUILD_NUMBER')}}</span></div>
    @endif

</div>
</body>
<script src="{{asset('js/layout/notify.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript"
        src="{{asset('files\bower_components\jquery-ui\js\jquery-ui.min.js', env('IS_DEPLOY_ON_SERVER'))}}"></script>
@include('notify.sweet_alert')
@include('layouts.popup')
@include('notify.error')
@include('notify.success')
@include('component.data_shared')
@include('message.popup.index')
@include('layouts.script')
@stack('scripts')

<script>
    $(function () {
        // click ở ngoài mà vẫn focus vào ô input
        $('.form-left').on('click', () => {
            $('.text-left').focus();
        });
        $('.form-right').on('click', () => {
            $('.text-right').focus();
        });

        // Hiện/ẩn popup chat khi bấm vào nó
        // $('#messages').click(function () {
        //     $('.list-conversation-group').toggleClass('d-none')
        // })
        //
        // // Ẩn popup chat khi bấm ra ngoài
        // $('.seemt-main-container').click(function () {
        //     $('.list-conversation-group').addClass('d-none')
        //     $('.seemt-item-profile').addClass('d-none');
        //     $('.box-restaurant-system').removeClass('active');
        //
        // })
        $(document).click(function (event) {
            if (!$(event.target).closest('#messages').length) {
                $('.list-conversation-group').addClass('d-none');
            }
        });

        $('#messages').on('click', function () {
            $('.list-conversation-group').toggleClass('d-none')
            // ẩn log khi bấm vào profile
            $('#styleSelector').removeClass('show');
            $('#data-history-log').html('');
            $('.main-menu-1.selector-toggle-li').find($(".fi-rr-cross")).removeClass('fi-rr-cross').addClass('fi-rr-time-quarter-to');
            $('#styleSelector').css('right', '-640px');
        })

        // Sự kiện Select
        $('.select-btn').click(function () {
            $('.select-menu').toggleClass('active')
        })

        $('.option').each(function () {
            $(this).click(function () {
                let selectedOption = $(this).find('p').text()
                $('.sBtn-text').text(selectedOption)
            })
        })

        $('#search-input-seemt').on('focus click', function () {
            $(this).parents('.seemt-search').addClass('active');
        })

        $('#search-input-seemt').on('focusout', function () {
            $(this).parents('.seemt-search').removeClass('active');
        })

        $(document).click(function (event) {
            if (!$(event.target).closest('.seemt-box-profile').length) {
                $('.seemt-box-profile').find('.seemt-item-profile').addClass('d-none');
            }
        });

        $('.seemt-box-profile').on('click', function (event) {
            $(this).find('.seemt-item-profile').toggleClass('d-none');
            // ẩn log khi bấm vào profile
            $('.list-conversation-group').toggleClass('d-none')
            $('#styleSelector').removeClass('show');
            $('#data-history-log').html('');
            $('.main-menu-1.selector-toggle-li').find($(".fi-rr-cross")).removeClass('fi-rr-cross').addClass('fi-rr-time-quarter-to');
            $('#styleSelector').css('right', '-640px');
        })


        $(document).on('click', '.seemt-btn', function () {
            $('#seemt-menu-left').toggle();
            $('#seemt-menu-left-mini').toggle();

            if ($('#seemt-menu-left').is(":visible")) {
                $('.seemt-container .seemt-main').attr('style', 'margin-left: 218px;')
            } else {
                $('.seemt-container .seemt-main').attr('style', 'margin-left: 64px;')
            }
        })


        // xử lý sub
        $('.seemt-restaurant-system').on('click', function () {
            if ($(this).parents('.seemt-nav-right').find('.box-restaurant-system').hasClass('active')) {
                $(this).parents('.seemt-nav-right').find('.box-restaurant-system').removeClass('active');
            } else {
                $(this).parents('.seemt-nav-right').find('.box-restaurant-system').addClass('active');
            }
        })


        // $('.box-restaurant-system-brand-item').on('click', function () {
        //     let title = 'Nhắc',
        //         content = 'Bạn muốn thay đổi Thương hiệu, hệ thống sẽ được tải lại !',
        //         icon = 'warning';
        //     sweetAlertComponent(title, content, icon).then(async (result) => {
        //         if (result.value) {
        //             $(this).parents('.seemt-nav-right').find('.seemt-restaurant-system').find('img').attr('src', $(this).children('img').attr('src'));
        //             $(this).parents('.seemt-nav-right').find('.seemt-restaurant-system').text($(this).find('label').text());
        //             $('.box-restaurant-system-brand-item').removeClass('active');
        //             $(this).addClass('active')
        //             $('#restaurant-branch-id-selected span').data('value', $(this).data('id'));
        //             $('.wavy-wraper').removeClass('d-none');
        //             updateSessionBrand($(this).data('id'));
        //         }
        //     })
        // })

        $('.select-brand').on('change', function () {
            $('.select-brand').val($(this).val()).trigger('change.select2')
            if (window.location.pathname === '/branch-dashboard') {
                updateSessionBrandNew($(this), 1);
            } else {
                updateSessionBrandNew($(this));
            }
        })

        $('.select-branch').on('change', function () {
            $('.select-branch').val($(this).val()).trigger('change.select2')
            updateSessionBranch($(this).val());
        })


        $('.select-brand').select2({
            templateResult: function (idioma) {
                let $span = $(`<span>${idioma.text}</span>`);
                return $span;
            },
            templateSelection: function (idioma) {
                if (!idioma.disabled) {
                    let $span = $(`<span class="d-flex align-items-center"><i class="fi-rr-bank icon-brand" data-toggle="tooltip" data-placement="top" data-original-title="Thương hiệu"></i><span class="option-content">${idioma.text}</span></span>`);
                    return $span;
                } else {
                    let $span = $(`<span>${idioma.text}</span>`);
                    return $span;
                }
            }
        });

        $('.select-branch').select2({
            templateResult: function (idioma) {
                let $span = $(`<span>${idioma.text}</span>`);
                return $span;
            },
            templateSelection: function (idioma) {
                if (!idioma.disabled) {
                    let $span = $(`<span class="d-flex align-items-center"><i class="fi-rr-marker icon-branch" data-toggle="tooltip" data-placement="top" data-original-title="Chi nhánh"></i><span class="option-content">${idioma.text}</span></span>`);
                    return $span;
                } else {
                    let $span = $(`<span>${idioma.text}</span>`);
                    return $span;
                }
            }
        });

        // $(document).on('click', '.box-restaurant-system-branch .seemt-branch-item', function () {
        //     $('.box-restaurant-system-branch .seemt-branch-item').removeClass('selected');
        //     $(this).addClass('selected');
        //     $('#change_branch option:selected').val($(this).data('id'));
        //     $(this).parents('.box-restaurant-system').removeClass('active');
        //     loadData();
        //     updateSessionBranch($(this).data('id'));
        // })

        $('#search-input-seemt').on('input', function () {
            searchInput()
        })

        dateFullTimePickerTemplate($('form-date'))
        dateFullTimePickerTemplate($('to-date'))
    })

    function searchInput() {
        let keySearch = $('#search-input-seemt').val().toLowerCase();
        let valueSearch = $('.seemt-search-item .search-item');
        valueSearch.each(function () {
            let textRemoveVietnamese = removeVietnameseString($(this).find('a').text().toLowerCase())
            let text = $(this).find('a').text().toLowerCase()
            if (textRemoveVietnamese.includes(keySearch) || text.includes(keySearch)) {
                $(this).show()
            } else {
                $(this).hide()
            }
        })
    }

    $('.seemt-menu-item').hover(function (e) {
        if ($(this).attr('data-is-click') != 1) {
            $('.seemt-menu-sub-last').removeClass('d-block');
            $('.seemt-menu-item').removeAttr('data-is-click');
            $('.seemt-menu-sub').removeClass('d-block');
            $(this).find('.seemt-menu-sub').addClass('d-block');
            $(this).children('.seemt-menu-sub').attr("style", "");
            if ($(this).find('.seemt-menu-sub').hasClass('d-block')) {
                let winHeight = $('.seemt-container').height();
                let posTop = $(this).position().top;
                let lineHeight = winHeight - posTop;
                lineHeight = $(this).children('.seemt-menu-sub').offset().top + $(this).children('.seemt-menu-sub').height();
                let liCount = $(this).children('.seemt-menu-sub').children().length;
                if (lineHeight > winHeight) {
                    $(this).children('.seemt-menu-sub').attr("style", "top: auto; bottom:0");
                } else {
                    $(this).children('.seemt-menu-sub').attr("style", "");
                }
            }
        }
        // if ($(this).hasClass('active') && !$(this).find('.seemt-menu-sub-last').hasClass('d-block')) {
        if ($(this).hasClass('active')) {
            $('.seemt-menu-sub-item .active').parent('.seemt-menu-sub-last').addClass('d-block')
            $(this).find('.seemt-menu-sub').addClass('d-block')
            // if ( $('.seemt-menu-sub-item .active').parents('.seemt-menu-sub-last').length > 0) {
            if ($('.seemt-menu-sub-item .active').parents('.seemt-menu-sub-last').length > 0) {
                let winHeight = $('.seemt-container').height();
                // let posTop =  $('.seemt-menu-sub-item .active').position().top;
                let posTop = $(this).find('.seemt-menu-sub-item .active').position().top;
                let lineHeight = winHeight - posTop;
                // lineHeight =  $('.seemt-menu-sub-item .active').parents('.seemt-menu-sub-last').offset().top +  $('.seemt-menu-sub-item .active').parents('.seemt-menu-sub-last').height();
                lineHeight = $(this).find('.seemt-menu-sub-item .active').parents('.seemt-menu-sub-last').offset().top + $(this).find('.seemt-menu-sub-item .active').parents('.seemt-menu-sub-last').height();
                let liCount = $('.seemt-menu-sub-item .active').parents('.seemt-menu-sub-last').children().length;
                if (lineHeight > winHeight) {
                    $('.seemt-menu-sub-item .active').parents('.seemt-menu-sub-last').attr("style", "top: auto; bottom:0");
                } else {
                    $('.seemt-menu-sub-item .active').parents('.seemt-menu-sub-last').attr("style", "");
                }
            }
        }
    }, function () {
        if ($(this).attr('data-is-click') != 1) {
            $(this).find('.seemt-menu-sub').removeClass('d-block');
            $('.seemt-menu-sub-item .active').parents('.seemt-menu-sub-last').attr("style", "");
        }
    })
    $('.seemt-menu-sub-item').hover(function (e) {
        $(this).children().find('.fi-rr-angle-small-down').first().css('color', '#FF8B00')
        e.stopPropagation();
        if ($(this).hasClass('disabled')) {
            $(this).attr('data-original-title', 'Bạn chưa được phân quyền cho chức năng này')
            $(this).tooltip();
        }
        if ($(this).parents('.seemt-menu-sub-item.disabled').length) {
            $(this).parents('.seemt-menu-sub-item.disabled').tooltip('hide');
            $(this).parents('.seemt-menu-sub-item.disabled').attr('data-original-title', '')
        }

    }, function () {
        $(this).children().find('.fi-rr-angle-small-down').first().css('color', '#7D7E81')
    })
    $(document).on('click', '.seemt-menu-item', function () {
        $(this).attr('data-is-click', 1)
    })
    $(document).on('click', '.seemt-menu-sub-item', function (event) {
        event.stopPropagation();
        $(this).parents('.seemt-menu-item').attr('data-is-click', 1)
        $(this).children('.seemt-menu-sub-last').attr("style", "");
        if ($(this).children('.seemt-menu-sub-last').length == 0) {
            $('.seemt-menu-sub').removeClass('d-block');
        } else {
            if ($(this).children('.seemt-menu-sub-last').length > 0)
                $(this).parent().find('.seemt-menu-sub-last').removeClass('d-block')
            $(this).children('.seemt-menu-sub-last').addClass('d-block');
        }
        if ($(this).find('.seemt-menu-sub-last').length > 0) {
            let winHeight = $('.seemt-container').height();
            let posTop = $(this).position().top;
            let lineHeight = winHeight - posTop;
            lineHeight = $(this).children('.seemt-menu-sub-last').offset().top + $(this).children('.seemt-menu-sub-last').height();
            let liCount = $(this).children('.seemt-menu-sub-last').children().length;
            if (lineHeight > winHeight) {
                $(this).children('.seemt-menu-sub-last').attr("style", "top: auto; bottom:0");
            } else {
                $(this).children('.seemt-menu-sub-last').attr("style", "");
            }
        }
    })
    $(document).click(function (event) {
        if (!$(event.target).closest('.seemt-menu-item').length) {
            $('.seemt-menu-sub').removeClass('d-block');
            $('.seemt-menu-sub-last').removeClass('d-block');
            $('.seemt-menu-item').removeAttr('data-is-click');
        }
    });
</script>
</html>


