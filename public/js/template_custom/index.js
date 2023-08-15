let page_history_logs = 1, length_history_logs, vh_of_table, vh_of_table_report, vh_table_tab, checkSpamHistory = 0;
/**
 * Removes format warnings from moment
 * @type {boolean}
 */
let faviconMessage;

moment.suppressDeprecationWarnings = true;

$(function () {
    faviconMessage = new Favico({
        animation: 'slide'
    });

    countTableScrollY();
    // $('input').on('focus', function () {
    //     $(this).select();
    // });

    $( window ).resize(function() {
        countTableScrollY();
    });

    removeAllShortcuts();
    shortcut.add('F1', function () {
        // let check = $('#styleSelector').hasClass('open');
        // if (check === true) {
        //     $('#styleSelector').removeClass('open');
        // } else {
        //     getHistoryLog();
        //     $('#styleSelector').addClass('open');
        // }
        if($('.top-search input').is(':focus')){
            $('.top-search input').blur()
        }else{
            $('.top-search input').focus()
        }
    });

    $('#select-branch-setting .js-example-basic-single').select2({
        dropdownParent: $('#select-branch-setting'),
    })

    $('#styleSelector .js-example-basic-single').select2({
        dropdownParent: $('#styleSelector'),
    });
    $('.modal.fade').on('hidden', function () {
        shortcut.add('F1', function () {
            let check = $('#styleSelector').hasClass('open');
            if (check === true) {
                $('#styleSelector').removeClass('open');
            } else {
                getHistoryLog();
                $('#styleSelector').addClass('open');
            }
        });
        shortcut.add('F9', function () {
            $('.search-text-full-layout').focus();
            $('.search-text-full-layout').addClass('show-search-text-full-layout');
        });
        shortcut.add('F5', function () {
            loadData();
        });
    });

    dateTimePickerTemplate($('#from-date-history-layout'));
    dateTimePickerTemplate($('#to-date-history-layout'));
    $('#select-history-layout, #select-branch-history-layout').unbind('select2:select').on('select2:select', function () {
        $('#data-history-log').html('');
        page_history_logs = 1;
        getHistoryLog();
    });
    $('#search-time-history-log, #btn-search-history-layout').on('click', function () {
        $('#data-history-log').html('');
        page_history_logs = 1;
        getHistoryLog();
    });
    $('#from-date-history-layout').val(moment().startOf('month').format('DD/MM/YYYY'));
    $('#to-date-history-layout').val(moment(Date()).format('DD/MM/YYYY'));
    $('#data-history-log').on('scroll', function () {
        if ($(this).innerHeight() - $(this).scrollTop() + 500 >= $(this)[0].scrollHeight) {
            if (length_history_logs === 50) {
                $('#data-history-log').prepend('<div class="container loading-more-parent" id="loading-more-history-log">\n' + '<div class="loading-more yellow-loading-more"></div>\n' + '<div class="loading-more red-loading-more"></div>\n' + '<div class="loading-more blue-loading-more"></div>\n' + '<div class="loading-more violet-loading-more"></div>\n' + '</div>');
                page_history_logs++;
                getHistoryLog();
            }
        }
    });
    addLoading('setting.history');
    $('#choose-language li').on('click', async function () {
        if ($(this).find('img').data('value') != $('#selected-language img').attr('data-value')) {
            $('#selected-language img').attr('src', $(this).find('img').attr('src'));
            $('#selected-language img').attr('data-value', $(this).find('img').data('value'));
        }
    });


    $('.main-menu-1.selector-toggle-li').on("click", function () {
        if (!$('#styleSelector').hasClass('show')) {
            $('#styleSelector').addClass('show');
            $(this).find($(".fi-rr-time-quarter-to")).removeClass('fi-rr-time-quarter-to').addClass('fi-rr-cross');
            $('#styleSelector').css('right', '0');
            page_history_logs = 1;
            getHistoryLog();
        } else {
            $('#styleSelector').removeClass('show');
            $('#data-history-log').html('');
            $(this).find($(".fi-rr-cross")).removeClass('fi-rr-cross').addClass('fi-rr-time-quarter-to');
            $('#styleSelector').css('right', '-640px');
        }
    });
    shortcut.add('F5', function () {
        if (typeof loadingData === "function") {
            loadingData();
        } else {
            loadData();
        }
    });

    $('input[data-validate=search]').each(function () {
        $(this).parent().html('' +
            '<div class="input-group border-group">' + $(this).parents().html() + '</div>');
        $('input[data-validate=search]').parent().find('span').addClass('custom-find');
        $('input[data-validate=search]').addClass('custom-form-search');
        $('input[data-validate=search]').parent().find('button').addClass('custom-button-search');
    })

    $(document).on('shown.bs.modal', '.modal', function (e) {
        shortcut.remove('F1')
        $(".tooltip").tooltip("hide");
        $('.modal').find('.modal-body').scrollTop(0);
        $(document).unbind('keypress').on('keypress', function (event) {
            // console.log(event.keyCode);
            if (event.keyCode === 13 || event.keyCode === 27) {
                event.preventDefault();
            }
        });
        e.preventDefault();
    })
    $(document).on('hidden.bs.modal', '.modal', function (e) {
        $(document).unbind('keypress');
    })

    $(document).on('keyup', function (e) {
        if (e.keyCode === 32 && $('.modal').hasClass('show') && !['input', 'select', 'textarea'].includes(e.target.tagName)) return false;
    })

    $(document).on('click', 'button', function () {
        $(".tooltip").tooltip("hide");
    });
    countSideNavWidth();

    // $(document).on('focus', '', function (e) {
    //     e.preventDefault();
    //     $(this).select();
    // });
    // let focusedElement = 0;
    // $(document).on('click', 'input, textarea', function() {
    //     if(focusedElement == 1){
    //         return false; // already focused, return so the user can place the cursor at a specific entry point
    //         focusedElement = 1;
    //         $(this).select();
    //     }else {
    //         let el = $(this).get($(this).val().length);
    //         el.selectionStart = $(this).val().length;
    //         el.selectionEnd = $(this).val().length;
    //         el.focus();
    //     }
    // });
    //
    // $(document).on('focusout', 'input, textarea', function() {
    //     console.log(focusedElement)
    //     focusedElement = 0;
    // });


    // $(document).on('click', '[data-toggle="tooltip"]', function() {
    //     $('[data-toggle="tooltip"]').tooltip("hide");
    // });
    //
    // $('[data-toggle="tooltip"]').tooltip({
    //     trigger : 'click'
    // })

    // $(document).on('blur', 'input, textarea', function() {
    //     if ($(this).attr("data-selected-all")) {
    //         $(this).removeAttr("data-selected-all");
    //     }
    // });

    // $(document).on('click', 'input, textarea', function() {
    //     if (!$(this).attr("data-selected-all")) {
    //         try {
    //             $(this).selectionStart = 0;
    //             $(this).selectionEnd = $(this).value.length + 1;
    //             $(this).attr("data-selected-all", true);
    //         } catch (err) {
    //             $(this).select();
    //             $(this).attr("data-selected-all", true);
    //         }
    //     }
    // });

    CKEDITOR.on("instanceReady", function(event) {
        event.editor.on("beforeCommandExec", function(event) {
            // Show the paste dialog for the paste buttons and right-click paste
            if (event.data.name == "paste") {
                event.editor._.forcePasteDialog = true;
            }
            // Don't show the paste dialog for Ctrl+Shift+V
            if (event.data.name == "pastetext" && event.data.commandData.from == "keystrokeHandler") {
                event.cancel();
            }
        })
    });

    $(document).on('click', '.input-checkbox-ripple', function () {
        $(this).toggleClass('active');
        $(this).find('.menu').toggleClass('active');
    });
    $('.checkbox-ripple').rkmdCheckboxRipple();
});

(function ($) {
    $.fn.rkmdCheckboxRipple = function () {
        let self = this, checkbox, ripple, size, eWidth, eHeight;
        checkbox = self.find('.input-checkbox');
        checkbox.on('mousedown', function (e) {
            if (e.button === 2) return false;
            if ($(this).find('.ripple').length === 0) $(this).append('<span class="ripple"></span>');
            ripple = $(this).find('.ripple');
            eWidth = $(this).outerWidth();
            eHeight = $(this).outerHeight();
            size = Math.max(eWidth, eHeight);
            ripple.css({'width': size, 'height': size});
            ripple.addClass('animated');
            $(this).on('mouseup', function () {
                setTimeout(function () {
                    ripple.removeClass('animated');
                }, 200);
            });
        });
    }
}(jQuery));

/**
 * Đổi ảnh khi ảnh load lỗi
 * @param r = $(this)
 */
function imageDefaultOnLoadError(r) {
    r.attr('src', '/images/tms/default.jpeg');
}

function bannerDefaultOnLoadError(r) {
    r.attr('src', '/images/tms/default_background.jpeg');
}

/**
 * Độ cao table
 */
async function countTableScrollY() {
    // let px_of_table = await $("#pcoded").outerHeight(true) - ($('.pcoded-inner-content').outerHeight(true) + $('.navbar').outerHeight(true) + 16);
    // let px_of_table = $(".pcoded-overlay-box").outerHeight(true) - ($('.topbar').outerHeight(true) + $('.main-body').outerHeight(true) + 10);
    // let px_of_table = $(".seemt-container").outerHeight(true) - ($('.seemt-header').outerHeight(true) + $('.seemt-main-container').outerHeight(true) + 20);
    let viewPort =  window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    vh_of_table = viewPort - ($('.seemt-header').outerHeight(true) + 275);
    // vh_of_table = (px_of_table) + 'px';

    vh_table_tab = vh_of_table - 49 + 'px';

    // chiều cao của table báo cáo
    let px_of_table_report = $(window).height() - ($('.seemt-header').outerHeight(true) + $('.filter-report').outerHeight(true) + 20) - 100 - 48 - $('.table').outerHeight(true) - 30 + 'px';
    vh_of_table_report = px_of_table_report;
}

/**
 * Lịch sử hoạt động
 */

async function getHistoryLog() {
    if(checkSpamHistory !== 0) return false;
    checkSpamHistory = 1
    let height_begin = $('#data-history-log')[0].scrollHeight;
    let type = $('#select-history-layout').val(), from = $('#from-date-history-layout').val(),
        to = $('#to-date-history-layout').val(), key = $('#search-history-layout').val(),
        branch = $('#select-branch-history-layout').val(), method = 'get', url = 'setting.history',
        params = {branch: branch, type_object: type, from: from, to: to, key_search: key, page: page_history_logs}, data = null;
    let res = await axiosTemplate(method, url, params, data);
    checkSpamHistory = 0
    $('#data-history-log').empty()
    await $('#data-history-log').append(res.data[0]);
    length_history_logs = res.data[1];
    $('#loading-more-history-log').remove();
    if (page_history_logs === 1) {
        $('#data-history-log').scrollTop(0);
    } else {
        $('#data-history-log').scrollTop($('#data-history-log')[0].scrollHeight - height_begin);
    }
    $(document).on('input', 'input[data-convert="convert"]', function () {
        $(this).val(remove_special_char($(this).val()));
        $(this).parents('div').find('input[data-code="code-conversion"]').val($(this).val()).trigger('input');
    });
    $(document).on('input', 'input[data-code="code-conversion"]', function () {
        $(this).val(($(this).val().toUpperCase()))
    });
    $(document).on('change', '.files-upload', function () {
        $('.file-upload-name-js').text($(this)[0].files[0].name);
    });
    $(document).on('click', '.file-upload-submit-js', function () {
        $('.file-upload-name-js').trigger('click')
    });
}


/**
 * handle floating point calculations
 * @param n
 * @returns {number}
 */

function checkDecimal(n) {
    return Math.round(n * 1000) / 1000;
}
function checkTrunc(n){
    return Math.trunc(n);
}


/**
 *  search datatable cập nhật lại số thứ tự
 * */

async function searchUpdateIndexDatatable(datatable){
    let index = 1;
    await datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        row.find('td:eq(0)').text(index)
        index++;
    })
}

/**
 *
 * @param str
 * @returns {string}
 * Sẽ xoá
 */
function removeVietnameseStringLowerCase(str) {
    if (str) {
        str = str.toLowerCase();
        str = str.replace('/\s+/', '');
        str = str.replace(' ', '');
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/ |\-/g, "");
        str = str.replace(/đ/g, "d");
        return str.toLocaleLowerCase();
    } else {
        return '';
    }
}

function removeVietnameseStringLowerCaseAndAllowEnteringSpecialCharacters(str) {
    if (str) {
        str = str.toLowerCase();
        str = str.replace('/\s+/', '');
        str = str.replace(' ', '');
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/đ/g, "d");
        return str.toLocaleLowerCase();
    } else {
        return '';
    }
}

/**
 *
 * @param str
 * @returns {string}
 */
function removeVietnameseString(str) {
    if (str) {
        str = str.toLowerCase();
        str = str.replace('/\s+/', '');
        str = str.replace(' ', '');
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/ |\-/g, "");
        str = str.replace(/đ/g, "d");
        return str;
    } else {
        return '';
    }

}

function remove_special_char(str) {
    str = str.replace(/-+-/g, "_"); //thay thế 2- thành 1_
    str = str.replace(/^\-+|\-+$/g, "");
    str = str.replace(/!|@|%|\$|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\\|\]|~|$/g, "");
    return str;
}

function removeAllShortcuts() {
    shortcut.remove('ESC');
    shortcut.remove('ENTER');
    shortcut.remove('F1');
    shortcut.remove('F2');
    shortcut.remove('F3');
    shortcut.remove('F4');
    shortcut.remove('F5');
    shortcut.remove('F6');
    shortcut.remove('F7');
    shortcut.remove('F8');
    shortcut.remove('F9');
    shortcut.remove('F10');
    shortcut.remove('F11');
    shortcut.remove('F12');
}

// Tắt phím Space(32) & Tab(9) ở kí tự đầu tiên trong input.
$(document).on('keydown', 'input', function (e) {
    if ($(this).val().length === 0 && (e.which === 32 || e.which === 9)) e.preventDefault();
});

// notify check level
function showNotifyLevel(r) {
    Swal.fire({
        icon: 'error', title: $('#error-level-title').html(), text: $('#error-level-content').html(),
    }).then((result) => {
        if (result.value) {
            r.parents('li').removeClass('pcoded-trigger');
        }
    });
}

// notify check improving
function showNotifyImproving(r) {
    Swal.fire({
        icon: 'error',
        title: 'Đang phát triển',
        text: 'Tính năng đang được đội ngũ Techres phát triển, sẽ có mặt trong các phiên bản tới, hãy đón chờ nhé !',
    }).then((result) => {
        if (result.value) {
            r.parents('li').removeClass('pcoded-trigger');
        }
    });
}

async function axiosTemplate(method, url, params, data, element) {
    let x1 = moment();
    $(document).find('.active-row-focus').removeClass('active-row-focus');
    let classItem = url.replace(/[^a-z\s]/gi, '') + '-loading';
    classItem = classItem.trim();
    try {
        if ($.isArray(element)) {
            for (const v of element) {
                if (v.parent().find('.loading-2022-template').length === 0) v.parent().prepend(themeLoading(v.height(), classItem));
            }
        }
        if (!typeof (element) === "string") {
            element.parent().prepend(themeLoading(getComputedStyle(element[0]).height, classItem));
        }
        let res = await axios({
            method: method, url: url, params: params, data: data
        });
        $(".tooltip").tooltip("hide");
        $('.height-template-loading').remove()
        $('.' + classItem).remove();
        console.log(res);
        let x2 = moment();
        let time = (x2 - x1) / 1000;
        // console.log('Thời gian Axios: ' + time + 's');
        if (res.data.status === 401) {
            let title = 'Cảnh báo', content = 'Tài khoản quá hạn, vui lòng đăng nhập lại !', icon = 'warning';
            sweetAlertNextComponent(title, content, icon).then(async (result) => {
                if (result.value) {
                    window.location.href = "/logout";
                }
            });
            return false;
        } else if (res.data.status >= 500) {
            ErrorNotify(res.data.message);
            return false;
        } else if (res.data.status > 400) {
            WarningNotify(res.data.message);
            return false;
        } else {
            return res;
        }
    } catch (e) {
        $('.height-template-loading').remove()
        $('.' + classItem).remove();
        let x2 = moment();
        console.log('Kết thúc request:' + x2);
        console.log('Thời gian request:' + x2 - x1 + ' ms');
        console.log(e + ' AxiosTemplate' + '\n' + 'url: ' + url);
        return false;
    }
}

async function axiosTestTemplate(method, url, params, data, id) {
    try {
        if (checkValidateSave(id)) {
            let res = await axios({
                method: method, url: url, params: params, data: data
            });
            console.log(res)
            if (res.data[0] === '500') {
                return false;
            } else {
                return res;
            }
        } else {
            console.log('1');
            return false;

        }
    } catch (e) {
        console.log(e + ' AxiosTemplate' + '\n' + 'url: ' + url);
        return e;
    }
}

function convertUrlQueryTemplate(url, params) {
    /**
     * VD: url = 'abc-xyz.data'
     *     params = {a:1, b:2}
     *     query url = 'abc-xyz.data?a=1&b=2'
     */
    params = JSON.stringify(params);
    params = params.replaceAll('"', '');
    params = params.replaceAll(':', '=');
    params = params.replaceAll(',', '&');
    params = params.replaceAll('{', '');
    params = params.replaceAll('}', '');
    url = url + '?' + params;
    return url;
}

/**
 * @param method: get/post/..
 * @param url: route
 * @param params: when get or null
 * @param data: when post or null
 * @returns {Promise<*>}
 */
async function axiosFileTemplate(method, url, params, data) {
    try {
        let res = await axios({
            method: method, url: url, params: params, data: data, headers: {
                'content-type': 'multipart/form-data'
            }
        });
        console.log(res);
        if (res.data[0] === '500') {
            return false;
        } else {
            return res;
        }
    } catch (e) {
        console.log(e + ' AxiosTemplate' + '\n' + 'url: ' + url);
        return e;
    }
}

//upload
async function axiosTemplateProgress(method, url, params, data) {
    try {
        let res = await axios({
            method: method, url: url, params: params, data: data, onUploadProgress: (progressEvent) => {
                const progress = Math.ceil((progressEvent.loaded / progressEvent.total * 100), 1)
                console.log(progressEvent);
                console.log(progress);
            }
        });
        if (res.data[0] === '500') {
            return false;
        } else {
            return res;
        }
    } catch (e) {
        console.log(e + ' AxiosTemplate' + '\n' + 'url: ' + url);
        return e;
    }
}

$.fn.errorData = function () {
    $(this).append('<img class="center-loading loading-data error-data" style="width: 5rem" src="../../../../files/assets/images/errorrData.jpg"  alt="Error Data"/>')
};

/**
 * change checked detail chart
 */
$(document).on('change', '.detail-chart-all', function () {
    if ($(this).is(':checked')) {
        $('.detail-chart-all').prop('checked', true);
    } else {
        $('.detail-chart-all').prop('checked', false);
    }
});

/**
 * Popup zoom image data table
 * @param img
 */
function modalImageComponent(img) {
    $('#src-popup-image-component').attr('src', img);
    $('#modal-popup-image-component').modal('show');
    shortcut.add('ESC', function () {
        $('#modal-popup-image-component').modal('hide');
    })
}

/**
 * Popup zoom image chat
 * @param img
 */
function modalImageChatComponent(img) {
    $('#src-popup-image-chat-component').attr('src', img);
    $('#modal-popup-image-chat-component').modal('show');
    shortcut.add('ESC', function () {
        $('#modal-popup-image-chat-component').modal('hide');
    })
}

/**
 * Popup zoom image media
 * @param img
 */
function modalImageMediaComponent(img) {
    $('#src-popup-image-media-component').attr('src', img);
    $('#modal-popup-image-media-component').modal('show');
    shortcut.add('ESC', function () {
        $('#modal-popup-image-media-component').modal('hide');
    })
}

/**
 * Popup zoom video media
 * @param video
 */
function modalVideoMediaComponent(video) {
    $('#src-popup-video-media-component source').attr('src', video);
    $('#modal-popup-video-media-component').modal('show');
    shortcut.add('ESC', function () {
        $('#modal-popup-video-media-component').modal('hide');
    });
}

/**
 * @param title
 * @param element // id input
 * @param content
 * @param icon
 */
function sweetAlertInputComponent(title, element = 'id-defaul', content, icon = '') {
    return Swal.fire({
        title: title,
        text: content,
        icon: icon,
        input: 'textarea',
        inputAttributes: {
            autocapitalize: 'off',
            id: element,
            style: 'border-radius:8px;height: 10vh; ',
            class: 'border-radius-20',
            "data-note": '2',
            maxlength: 255,
        },
        customClass: {
            confirmButton: 'btn btn-grd-primary btn-sweet-alert swal-button--confirm',
            cancelButton: 'btn btn-grd-disabled btn-sweet-alert swal-button--cancel'
        },
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: $('#button-btn-confirm-component').text(),
        cancelButtonText: $('#button-btn-cancel-component').text(),
        reverseButtons: true,
        focusConfirm: true,
        preConfirm: (text) => {
            $(document).on('input', '#'+ element ,function (){
                $(this).removeClass('border-danger');
            })
            if (text.length < 2) {
                $('textarea#'+element).parent().find('.error').remove();
                $('textarea#'+element).parent().append('<div class="error text-left">' +
                    '<span class="text-danger">' + 'Tối thiểu 2 đến 255 ký tự' + '</span>' +
                    '</div>');
                console.log($('#'+element));
                $('textarea#'+element).addClass('border-danger');
                return false;
            } else if(text.length > 255){
                $('textarea#'+element).parent().find('.error').remove();
                $('textarea#'+element).parent().append('<div class="error text-left">' +
                    '<span class="text-danger">' + 'Không được quá 255 kí tự' + '</span>' +
                    '</div>');
                $('textarea#'+element).addClass('border-danger');
                return false;
            } else {
                return text;
            }
        },
    })
}

/**
 *
 * @param title
 * @param text
 * @param icon
 * @param html
 * @returns {*}
 */
function sweetAlertComponent(title, text, icon, html = '') {
    let confirm = $('#button-btn-confirm-component').text();
    let cancel = $('#button-btn-cancel-component').text();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-grd-primary btn-sweet-alert swal-button--confirm',
            cancelButton: 'btn btn-grd-disabled btn-sweet-alert swal-button--cancel'
        },
        buttonsStyling: false,
        allowEnterKey: true,
    });
    return swalWithBootstrapButtons.fire({
        title: title,
        text: text,
        icon: icon,
        html: html,
        showCancelButton: true,
        confirmButtonText: confirm,
        cancelButtonText: cancel,
        reverseButtons: true,
        focusConfirm: true,
    })
}

/**
 *
 * @param title
 * @param text
 * @param icon
 * @param html
 * @param textConfirm
 * @returns {*}
 */
function sweetAlertHTMLComponent(title, text, icon, html = '', textConfirm = 'Đồng ý') {
    return Swal.fire({
        title: title,
        text: text,
        icon: icon,
        html: html,
        customClass: {
            confirmButton: 'swal2-confirm btn btn-grd-primary btn-sweet-alert',
            cancelButton: 'swal2-cancel btn btn-grd-disabled btn-sweet-alert',
        },
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: textConfirm,
        cancelButtonText: $('#button-btn-cancel-component').text(),
        reverseButtons: true,
        focusConfirm: true,
        allowEnterKey: true,
    });
}

/**
 *
 * @param title
 * @param text
 * @param icon
 * @returns {*}
 */
function sweetAlertNotifyComponent(title, text, icon) {
    let cancel = $('#button-btn-cancel-component').text();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
        }, buttonsStyling: false, className: "f-12",
    });
    swalWithBootstrapButtons.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: cancel,
        reverseButtons: true,
        focusCancel: true
    })
}

/**
 *
 * @param title
 * @param text
 * @param icon
 * @returns {*}
 */
function sweetAlertNextComponent(title, text, icon) {
    let confirm = $('#button-btn-confirm-component').text();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary f btn-sweet-alert',
        }, buttonsStyling: false
    });
    return swalWithBootstrapButtons.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: false,
        confirmButtonText: confirm,
        reverseButtons: true,
        focusConfirm: true
    })
}

function sweetAlertTimeoutComponent(title, text, icon) {
    const swalWithBootstrapButtons = Swal.mixin({
        buttonsStyling: false, className: "f-12", timer: 2000,
    });
    swalWithBootstrapButtons.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: false,
        showConfirmButton: false,
        reverseButtons: false,
        focusCancel: false
    })
}


/**
 * @param date
 * @key : day , month, year
 * @return call fuction dot key |ex: data.day = get day
 */
function takeTypeFromDate(date) {
    let date_format = '', day = 'day', month = 'month', year = 'year', dd_mm = 'day/month', mm_yy = 'month/year',
        dd_mm_yyyy = 'day/month/year';
    let data = [];
    //check date
    date.split('/').length - 1 === 2 ? date_format = moment(date, 'DD/MM/YYYY').format('DD/MM/YYYY') : date.substr(date.indexOf('/') + 1).length > 2 ? date_format = moment('01/' + date, 'DD/MM/YYYY').format('DD/MM/YYYY') : date_format = moment(date + '/2015', 'DD/MM/YYYY').format('DD/MM/YYYY');
    //add month
    if (date.split('/').length - 1 === 1 && date.substr(date.indexOf('/') + 1).length > 2) {//input YYYY/MM
        let item = {};
        item.month = moment(date_format, 'DD/MM/YYYY').isValid() === true ? moment(date_format, 'DD/MM/YYYY').format('MM') : mm_yy;
        item.year = moment(date_format, 'DD/MM/YYYY').isValid() === true ? moment(date_format, 'DD/MM/YYYY').format('YYYY') : mm_yy;
        data.push(item);
    } else if (date.split('/').length - 1 === 1 && date.substr(date.indexOf('/') + 1).length === 2) {
        let item = {};
        item.month = moment(date_format, 'DD/MM/YYYY').isValid() === true ? moment(date_format, 'DD/MM/YYYY').format('MM') : dd_mm;
        item.day = moment(date_format, 'DD/MM/YYYY').isValid() === true ? moment(date_format, 'DD/MM/YYYY').format('DD') : dd_mm;
        data.push(item);
    } else if (date.length === 4) {
        let item = {};
        item.month = null;
        item.year = date;
        data.push(item);
    } else {
        let item = {};
        item.day = moment(date_format, 'DD/MM/YYYY').isValid() === true ? moment(date_format, 'DD/MM/YYYY').format('DD') : dd_mm_yyyy;
        item.month = moment(date_format, 'DD/MM/YYYY').isValid() === true ? moment(date_format, 'DD/MM/YYYY').format('MM') : dd_mm_yyyy;
        item.year = moment(date_format, 'DD/MM/YYYY').isValid() === true ? moment(date_format, 'DD/MM/YYYY').format('YYYY') : dd_mm_yyyy;
        data.push(item);
    }
    return data[0];
}

/**
 *
 **/

// let loadingBall = '<div class="ball-scale">\n' + '        <div class="contain">\n' + '            <div class="ring">\n' + '                <div class="frame"></div>\n' + '            </div>\n' + '            <div class="ring">\n' + '                <div class="frame"></div>\n' + '            </div>\n' + '            <div class="ring">\n' + '                <div class="frame"></div>\n' + '            </div>\n' + '            <div class="ring">\n' + '                <div class="frame"></div>\n' + '            </div>\n' + '            <div class="ring">\n' + '                <div class="frame"></div>\n' + '            </div>\n' + '            <div class="ring">\n' + '                <div class="frame"></div>\n' + '            </div>\n' + '            <div class="ring">\n' + '                <div class="frame"></div>\n' + '            </div>\n' + '            <div class="ring">\n' + '                <div class="frame"></div>\n' + '            </div>\n' + '            <div class="ring">\n' + '                <div class="frame"></div>\n' + '            </div>\n' + '            <div class="ring">\n' + '                <div class="frame"></div>\n' + '            </div>\n' + '        </div>\n' + '    </div>'
let loadingBall = '';

function showErrorServer(data) {
    let text = $('#error-500').text();
    ErrorNotify(text);
    console.log('Status: ' + data.data[1] + ', Message: ' + data.data[2]);
}

function addLoading() {
    return false;
}

function themeLoading(height, classItem) {
    return `<div class='loading-2022-template ${classItem}' style='min-height: 20px ; min-width: 20px ; height: ${height / 2}px; width: ${height / 2}px; max-height: 100px; max-width: 100px;'><hr/><hr/><hr/><hr/></div>`
}


function countSideNavWidth() {
    $('#mySidenav-321 a').each(function () {
        let width = $(this).width();
        $(this).css('right', '' - width + 'px');
    })
}

$(document).on('show.bs.modal', '.modal', function () {
    $('#mySidenav-321').addClass('d-none')
});

// Show button when close modal
$(document).on('hide.bs.modal', '.modal', function () {
    shortcut.add('F1', function () {
        let check = $('#styleSelector').hasClass('open');
        if (check === true) {
            $('#styleSelector').removeClass('open');
        } else {
            getHistoryLog();
            $('#styleSelector').addClass('open');
        }
    })
    $('#mySidenav-321').removeClass('d-none')
});

/**
 * @param startTime: time()
 */
function updateTimeTextTemplate(startTime) {
    let endTime = moment().format('x');
    let timeDiff = moment(endTime, "x").diff(moment(startTime, "x"));
    let duration = moment.duration(timeDiff);
    let years = Math.floor(duration.years());
    let months = Math.floor(duration.subtract(years).months());
    let days = Math.floor(duration.subtract(months).days());
    let hours = Math.floor(duration.subtract(days).hours());
    let minutes = Math.floor(duration.subtract(hours).minutes());
    let seconds = Math.floor(duration.subtract(minutes).seconds());
    if (days > 9) {
        // return moment(startTime, 'x').format('DD/MM/YYYY HH:mm:ss');
        return moment(startTime, 'x').format('DD/MM');
    } else if (days > 0) {
        return days + ' ngày';
    } else if (hours > 0) {
        return hours + ' giờ';
    } else if (minutes > 0) {
        return minutes + ' phút';
    } else if (seconds > 0) {
        // return seconds + ' giây trước';
        return 'Vài giây';
    }
}


function imageError(r) {
    // let name = '{{ env('IMG_DEFAULT') }}';
    r.attr('src', 'https://beta.storage.aloapp.vn/public/images/tms/default.jpg');
}

/**
 * Tự động chụp màn hình hiện tại
 */
function capture() {
    html2canvas(document.querySelector("body")).then((canvas) => {
        let a = document.createElement("a");
        a.download = "ss.png";
        a.href = canvas.toDataURL("image/png");
        a.click(); // MAY NOT ALWAYS WORK!
    });
}

/**
 * Check null cookie select
 */
function checkHasInSelect(id, selectString) {
    let stringIdCheck = `"${id}"`,
        selectStringHtml = selectString.html();
    if (selectStringHtml.includes(stringIdCheck) === true) {
        selectString.val(id).trigger('change.select2')
    } else {
        selectString.find('option:first').trigger('change.select2')
    }
}

function hideTextTooLong(element){
    let content = element.text()
    let showChar = 200;
    let ellipsestext ="...";
    let moretext ="Xem thêm";
    let lesstext ="Thu gọn"
    if(content.length > showChar) {
        let c = content.substr(0, showChar);
        let h = content.substr(showChar, content.length - showChar);
        let html = c +'<span class="moreellipses">' + ellipsestext +'</span><span class="morecontent"><span class="col-form-label-fz-15" style="display: none;">' + h +'</span>&nbsp;&nbsp;<a href="" style="color: #fa6342 !important;  font-weight: 500 !important;" class="morelink">' + moretext +'</a></span>';
        element.html(html);
    }

    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
}

function templateReportTypeOption(){
    dateTimePickerFromToDateTemplate2($('.from-date-filter-time-bar'),$('.to-date-filter-time-bar'));
    dateTimePickerFromToMonthTemplate2($('.from-month-filter-time-bar'),$('.to-month-filter-time-bar'))
    dateTimePickerFromToYearTemplate2($('.from-year-filter-time-bar'),$('.to-year-filter-time-bar'))
    $('.custom-select-option-report').on('change', function (){
        switch (Number($(this).val())){
            case 15:
                $('.custom-date').addClass('d-none')
                $('.custom-month').removeClass('d-none')
                $('.custom-year').addClass('d-none')
                break;
            case 16:
                $('.custom-date').addClass('d-none')
                $('.custom-month').addClass('d-none')
                $('.custom-year').removeClass('d-none')
                break;
            default:
                $('.custom-date').removeClass('d-none')
                $('.custom-month').addClass('d-none')
                $('.custom-year').addClass('d-none')
        }
    })
    $('#select_time').on('click', function () {
        if ($(this).hasClass('btn-grd-warning')) return false;
        $('.add-display').addClass('d-none');
        $('.btn-edit-display').removeClass('btn-grd-warning');
        $('#select_time').addClass('btn-grd-warning');
        $('.content-filter-time-bar').removeClass('d-none')
    });
}

function getToMaxDateTimePickerReport(){
    $('.search-date-filter-time-bar').on('click', function () {
        if(!checkReportDateTimePicker($(this))){
            return false;
        }
    });
}

/**
 * Render time options based on type report detail
 */
function getTimeBasedOnTypeReport(el, type) {
    switch (parseInt(type)) {
        case 1:
            return el.text($('#calendar-day').val());
        case 2:
            return el.text(moment().weekday(1).format('DD/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'));
        case 3:
            return el.text($('#calendar-month').val());
        case 4:
        // return el.text(moment().month(-3).format('MM/YYYY') + ' - ' + moment().format('MM/YYYY'));
            return el.text(moment().add(-2, 'months').format('MM/YYYY') + ' - ' + moment().format('MM/YYYY'));
        case 5:
            return el.text($('#calendar-year').val());
        case 6:
            return el.text((moment().add(-3, 'years').format('YYYY')) + ' - ' + moment().format('YYYY'));
        case 7:
            return el.text(moment().format('YYYY'));
        case 8:
            return el.text(moment().format('YYYY'));
        case 13:
            return el.text($('.from-date-filter-time-bar').val() + ' - ' + $('.to-date-filter-time-bar').val());
        case 15:
            return el.text($('.from-month-filter-time-bar').val() + ' - ' + $('.to-month-filter-time-bar').val());
        case 16:
            return el.text($('.from-year-filter-time-bar').val() + ' - ' + $('.to-year-filter-time-bar').val());
        default:
            return 'Lỗi rồi';
    }
}

/**
 * Get time when change select type dashboard report
 */
function getTimeChangeSelectTypeDashboardReport(el1, el2){
   let text = '';
    switch (parseInt(el2.find('option:selected').val())) {
        case 1:
            return 'Ngày ' +  $(el1).text(el2.find('option:selected').data('time'));
        case 2:
            return 'Từ ' + $(el1).text(moment().weekday(1).format('DD/MM/YYYY') + ' - ' + 'đến ' + moment().format('DD/MM/YYYY'));
        case 3:
            return 'Ngày ' +  $(el1).text(el2.find('option:selected').data('time'));
        case 4:
            return $(el1).text(moment().subtract(3, 'months').format('MM/YYYY') + ' - ' + moment().format('MM/YYYY'));
        case 5:
            return 'Năm ' + $(el1).text($('#calendar-year').val());
        case 6:
            return $(el1).text((moment().add(-3, 'years').format('YYYY')) + ' - ' + moment().format('YYYY'));
        case 7:
            return 'Năm ' + $(el1).text(moment().format('YYYY'));
        case 8:
            return 'Năm ' + $(el1).text(moment().format('YYYY'));
        case 13:
            // return 'Từ ' + $(el1).text($('.from-date-filter-time-bar').val() + ' - ' + 'đến ' +$('.to-date-filter-time-bar').val());
            return '';
        case 15:
            // return 'Từ ' + (el1).text($('.from-month-filter-time-bar').val() + ' - ' + 'đến ' +$('.to-month-filter-time-bar').val());
            return '';

        case 16:
            // return 'Từ ' + (el1).text($('.from-year-filter-time-bar').val() + ' - ' + 'đến ' +$('.to-year-filter-time-bar').val());
            return '';

        default:
            return 'Lỗi rồi';
    }
}

function getTimeChangeSelectTypeDashboardPointReport(el1, el2){
    let text = '';
    switch (parseInt(el2.find('option:selected').val())) {
        case 1:
            $('#time-filter').text(el2.find('option:selected').data('time'))
            return 'Ngày ' +  $(el1).text(el2.find('option:selected').data('time'));
        case 2:
            $('#time-filter').text(moment().format('WW/YYYY'))
            return 'Từ ' + $(el1).text(moment().weekday(1).format('DD/MM/YYYY') + ' - ' + 'đến ' + moment().format('DD/MM/YYYY'));
        case 3:
            if (el2.find('option:selected').data('time') != moment().format('MM/YYYY')) {
                $('#time-filter').text('01/' + el2.find('option:selected').data('time') + ' - ' + '30/' + el2.find('option:selected').data('time'))
            }else {
                $('#time-filter').text('01/' + moment().format('MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'))
            }
            return 'Ngày ' +  $(el1).text(el2.find('option:selected').data('time'));
        case 4:
            $('#time-filter').text(moment().subtract(3, 'months').format('MM/YYYY') + ' - ' + moment().format('MM/YYYY'))
            return $(el1).text(moment().subtract(3, 'months').format('MM/YYYY') + ' - ' + moment().format('MM/YYYY'));
        case 5:
            $('#time-filter').text(el2.find('option:selected').data('time'))
            return 'Năm ' + $(el1).text(el2.find('option:selected').data('time'));
        case 6:
            $('#time-filter').text((moment().add(-3, 'years').format('YYYY')) + ' - ' + moment().format('YYYY'))
            return $(el1).text((moment().add(-3, 'years').format('YYYY')) + ' - ' + moment().format('YYYY'));
        case 7:
            return 'Năm ' + $(el1).text(moment().format('YYYY'));
        case 8:
            $('#time-filter').text('Tất cả')
            return 'Năm ' + $(el1).text(moment().format('YYYY'));
        case 13:
            // return 'Từ ' + $(el1).text($('.from-date-filter-time-bar').val() + ' - ' + 'đến ' +$('.to-date-filter-time-bar').val());
            return '';
        case 15:
            // return 'Từ ' + (el1).text($('.from-month-filter-time-bar').val() + ' - ' + 'đến ' +$('.to-month-filter-time-bar').val());
            return '';

        case 16:
            // return 'Từ ' + (el1).text($('.from-year-filter-time-bar').val() + ' - ' + 'đến ' +$('.to-year-filter-time-bar').val());
            return '';

        default:
            return 'Lỗi rồi';
    }
}
