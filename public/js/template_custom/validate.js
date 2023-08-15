$(function () {
    /* VALIDATE INDEX  */
    $(document).on('change click', 'input', function () {
        if (!$(this).parent().hasClass('validate-error') && !$(this).parent().hasClass('warning-error')) {
            $(this).parent().removeClass('focus-validate');
            $(this).parents('.validate-error').removeClass('validate-error');
            $(this).parent().parent().find('.error').remove();
            $(this).parent().addClass('focus-validate');
        }
    })
    $(document).on('input', 'input', function () {
        if (!$(this).parent().hasClass('validate-error') && !$(this).parent().hasClass('warning-error')) {
            $(this).parent().removeClass('focus-validate');
            $(this).parents('.validate-error').removeClass('validate-error');
            $(this).parent().parent().find('.error').remove();
            $(this).parent().removeClass('focus-validate');
        }
    })
    $(document).on('input paste', 'input[type="text"] , textarea', function () {
        $(this).val($(this).val().replaceAll('>', ''));
        $(this).val($(this).val().replaceAll('<', ''));
        $(this).val($(this).val().replaceAll('"', ''));
        $(this).val($(this).val().replaceAll("'", ''));
        $(this).val($(this).val().replaceAll("`", ''));
        // $(this).val($(this).val().replaceAll('[', ''));
        // $(this).val($(this).val().replaceAll(']', ''));
        // $(this).val($(this).val().replaceAll('{', ''));
        // $(this).val($(this).val().replaceAll('}', ''));
        $(this).val($(this).val().replaceAll('%', ''));
    })
    $(document).on('paste', 'input', function (e) {
        let value = $(this).val();
        let lastIndex = $(this).get(0).selectionStart;
        let stringBefore = $(this).val().slice(0, lastIndex);
        let stringLast = $(this).val().slice(lastIndex, $(this).val().length);
        let stringPaste = e.originalEvent.clipboardData.getData('Text');
        if (/\p{Emoji}[^0-9]/u.test(stringPaste)) {
            stringPaste = stringPaste.replace(/([\u2700-\u27BF]|[\uE000-\uF8FF]|\uD83C[\uDC00-\uDFFF]|\uD83D[\uDC00-\uDFFF]|[\u2011-\u26FF]|\uD83E[\uDD10-\uDDFF])/g, '');
            $(this).val(stringPaste.trim())
            e.preventDefault();
        } else {
            $(this).val(value);
        }
        // let a = stringBefore +  stringPaste + stringLast;
        // $(this).get(0).setSelectionRange(lastIndex, lastIndex);
    })
    $(document).on('hide.bs.modal', '.modal', function () {
        removeAllValidate();
    });
    $(document).on('show.bs.modal', '.modal', function () {
        shortcut.remove('SPACE');
        shortcut.remove('ENTER');
        shortcut.remove('ESC');
    });
    $(document).on('click', 'input[data-table]', function () {
        if (!$(this).parents('.border-group').hasClass('validate-error')) {
            $(this).parents('.border-group').removeClass('warning-validate');
            $(this).parents('.border-group').removeClass('focus-validate');
            $(this).parents('.border-group').addClass('focus-validate');
        }
    });
    $(document).on('focusout', 'input', function () {
        $(this).parent().removeClass('focus-validate');
        $(this).parent().parent().find('.error').remove();

    });
    $(document).on('input', 'input[data-table]', function () {
        if ($(this).parents('.border-group').hasClass('validate-error')) {
            $(this).parents('.border-group').removeClass('warning-validate');
            $(this).parents('.border-group').removeClass('focus-validate');
            $(this).parents('.border-group').removeClass('validate-error');
            $(this).parents('.border-group').addClass('focus-validate');
            removeErrorInputTable($(this));
        }
    })

    /* VALIDATE EMPTY  */
    $(document).on('focusout', 'input[data-empty]', function (e) {
        $(this).parent().removeClass('focus-validate');
    })
    $(document).on('input change onkeypress', 'input[data-empty]', function (e) {
        $(this).parent().removeClass('validate-error');
        $(this).parent().addClass('focus-validate');
        $(this).parent().removeClass('border-danger');
        $(this).parent().parent().find('.error').remove();
    })

    /* VALIDATE FLOAT */
    $(document).on('input paste', 'input[data-float]', function () {
        let input_val = $(this).val();
        if (input_val === '.') {
            $(this).val(0);
        }
    })

    /* VALIDATE MAX LENGTH */
    $(document).on('input paste', 'input[data-max-length]', function () {
        $(this).val($(this).val().replace(/\  /g, ''));
        if ($(this).val().length > $(this).attr('data-max-length')) {
            $(this).val($(this).val().slice(0, $(this).attr('data-max-length')));
            // addWarningInput($(this), 'Tối đa ' ng+ $(this).attr('data-max-length') + ' kí tự')
        }
        removeErrorInput($(this));
    })

    /* VALIDATE MÃ SỐ THUẾ */
    // $(document).on('input paste', 'input[data-tax-code]', function () {
    //     if ($(this).val().length > 0 && $(this).val().length < Number($(this).attr('data-tax-code'))) {
    //         // $(this).val($(this).val().slice(0, $(this).attr('data-tax-code')));
    //         addWarningInput($(this), 'Mã số thuế từ 10 - 15 ký tự')
    //     }
    //     removeErrorInput($(this));
    // })

    /* VALIDATE MAX VALUE */

    $(document).on('input paste keyup change', 'input[data-max]', function () {
        removeErrorInput($(this));
        if (!$(this).val().includes('.')) {
            if($(this).val().slice(-1) != "-"){
                $(this).val(formatNumber(parseFloat(removeformatNumber($(this).val()))));
            }
            else  $(this).val(0)
        }
        if (removeformatNumber($(this).val()) > Number($(this).attr('data-max'))) {
            $(this).val(formatNumber($(this).attr('data-max')));
            let exists = false;
            let max_value = formatNumber($(this).attr('data-max'));
            if ($(this).attr('data-table')) {
                $(".ui-pnotify-text").each(function () {
                    if ($(this).text().length === ('Số tối đa là ' + max_value).length)
                        exists = true;
                });
                $(this).val(formatNumber($(this).attr('data-max')));
                if (!exists) {
                    WarningNotify('Số tối đa là ' + max_value);
                    $(this).val(formatNumber($(this).attr('data-max')));
                }
            } else {
                $(this).val(formatNumber($(this).attr('data-max')));
            }
        }
    })
    $(document).on('input', 'input[data-max-value-of]', function () {
        removeErrorInput($(this));
    })

    /* VALIDATE IP */
    $(document).on('input onkeypress paste', 'input[data-ip]', function () {
        let regex = /[^0-9.]/g;
        $(this).val($(this).val().replace(regex, ''));
    })
    /* VALIDATE MIN LENGTH */
    $(document).on('focusout', 'input[data-min-length]', function (e) {
        removeErrorInput($(this));
    })
    /* VALIDATE MIN VALUE */
    $(document).on('input', 'input[data-min]', function () {
        removeErrorInput($(this));
    })
    $(document).on('input', 'input[data-value-min-value-of]', function () {
        removeErrorInput($(this));
        $(this).parent().removeClass('border-danger');
        if (!$(this).val().includes('.')) {
            $(this).val(formatNumber(parseFloat(removeformatNumber($(this).val()))));
        }
    })
    $(document).on('focus', 'input[data-value-min-value-of]', function () {
        // let el = $(this).get(0);
        // let elemLen = $(this).val().length;
        // el.selectionStart = 0;
        // el.selectionEnd = elemLen;
        // el.focus();
    })
    /* VALIDATE MAIL */
    $(document).on('focusout', 'input[data-mail]', function (e) {
        removeErrorInput($(this));
    })
    $(document).on('input', 'input[data-mail]', function (e) {
        removeErrorInput($(this));
    })

    /* VALIDATE PHONE */
    $(document).on('input onkeypress paste', 'input[data-phone]', function () {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
        if ($(this).val().length > 10) {
            $(this).val($(this).val().slice(0, 10));
        }
    })
    $(document).on('focusout', 'input[data-phone]', function () {
        removeErrorInput($(this));
    })

    /* VALIDATE MONEY */
    $(document).on('input paste', 'input[data-money]', function (e) {
        removeErrorInput($(this));
        if ($(this).val() === undefined || $(this).val() === '' || /[^0-9]/g.test(removeformatNumber($(this).val()))) {
            if ($(this).val() == '') {
                $(this).val('0');
            } else {
                $(this).val(checkDecimal($(this).val()).toFixed(0));
            }
        }
        if (!/[^0-9]/g.test(removeformatNumber($(this).val()))) {
            if (removeformatNumber($(this).val()) < 999999999999) {
                if ($(this).val() < 0) {
                    $(this).val('0');
                }
                $(this).val(formatNumber(parseInt(removeformatNumber($(this).val()))));
            } else {
                $(this).val(formatNumber(999999999999));
            }
        }
    })
    $(document).on('click', 'input[data-money]', function () {
        // let el = $(this).get(0);
        // let elemLen = $(this).val().length;
        // el.selectionStart = 0;
        // el.selectionEnd = elemLen;
        // el.focus();
    })

    /* VALIDATE TEXT ARTE */
    $(document).on('change click input', 'textarea', function () {
        if (!$(this).parent().hasClass('validate-error')) {
            $(this).parent().removeClass('validate-error');
            $(this).parent().removeClass('focus-validate');
            $(this).parent().addClass('focus-validate');
            $(this).parent().find('.error').remove();
        }
    })
    $(document).on('input paste', 'textarea', function () {
        $(this).parent().removeClass('validate-error');
        $(this).parent().removeClass('focus-validate');
        $(this).parents('.form-validate-textarea').removeClass('validate-error');
        $(this).parents('.form-group').find('.error').remove();
        $(this).parents('.form-validate-textarea').find('.the-count span:first-child').text($(this).val().length);
        $(this).parents('.form-validate-textarea').find('.the-count span:last-child').text(($(this).attr('.data-note-max-length') != undefined) ? '/' + $(this).attr('data-note-max-length') : '/1000');
    });

    $(document).on('paste', 'textarea', function (e) {
        if (!$(this).attr('data-emoji')) {
            let value = $(this).val();
            // let lastIndex = $(this).get(0).selectionEnd;
            // let stringBefore = $(this).val().slice(0 , lastIndex);
            // let stringLast = $(this).val().slice(lastIndex , $(this).val().length);
            // let stringPaste = $(this).val();
            // if(/\p{Emoji}/u.test(stringPaste)){
            //     stringPaste = $(this).val().replaceAll(/\p{Emoji}/ug, '').trim();
            // }
            // let a = stringBefore +  stringPaste + stringLast;
            // $(this).val(a);
            // $(this).value = textAreaTxt.substring(0, caretPos) + a + textAreaTxt.substring(caretPos);
            // $(this).val(stringPaste);
            // e.preventDefault(stringPaste);
            let lastIndex = $(this).get(0).selectionStart;
            let stringBefore = $(this).val().slice(0, lastIndex);
            let stringLast = $(this).val().slice(lastIndex, $(this).val().length);
            let stringPaste = e.originalEvent.clipboardData.getData('Text');

            if (/\p{Emoji}[^0-9]/u.test(stringPaste)) {
                stringPaste = stringPaste.replace(/([\u2700-\u27BF]|[\uE000-\uF8FF]|\uD83C[\uDC00-\uDFFF]|\uD83D[\uDC00-\uDFFF]|[\u2011-\u26FF]|\uD83E[\uDD10-\uDDFF])/g, '');
                $(this).val(stringPaste.trim())
                e.preventDefault();
            } else {
                $(this).val(value);
            }
        }
        // if ($(this).val().length > 1000) {
        //     $(this).val($(this).val().slice(0, 1000));
        // }
    });
    // $(document).on('input', 'textarea', function (e) {
    //     if ($(this).val().length > 1000) {
    //         $(this).val($(this).val().slice(0, 1000));
    //     }
    // });
    // $(document).on('input', 'textarea.textarea_v2', function (e) {
    //     if ($(this).val().length >255) {
    //         $(this).val($(this).val().slice(0, 255));
    //     }
    // });
    $(document).on('input paste keyup', 'textarea[data-note-max-length]', function (e) {
        if ($(this).val().length > $(this).data('note-max-length')) {
            $(this).val($(this).val().slice(0, $(this).data('note-max-length')))
        }
    })

    /* VALIDATE WEBSITE */
    $(document).on('focusout', 'input[data-website]', function (e) {
        if ($('button' + ':hover').length === 0) {
            if ($(this).val() != '') {
                let reWeb = /^(http:\/\/|https:\/\/)?(www.)?([a-zA-Z0-9]+).[a-zA-Z0-9]*.[‌​a-z]{3}\.([a-z]+)?$/gi;
                if (!($(this).val().match(reWeb))) {
                    removeErrorInput($(this));
                    addErrorInput($(this), 'Website không đúng định dạnh | VD: www.domain.com');
                } else {
                    removeErrorInput($(this));
                }
            }
        }
    })
    $(document).on('focusout', 'textarea', function () {
        $(this).parent().removeClass('focus-validate');
    })

    /* VALIDATE TEXT */
    $(document).on('input', 'input[data-only-text]', function () {
        // $(this).val($(this).val().replace(/\  /g,' '));
        console.log(/^\d+$/.test($(this).val().substr($(this).val().length - 1)));
        $(this).val($(this).val().replace(/[^\p{L}\p{N}\p{P}\p{Z}^$\n]/gu, ''));
        if (/^\d+$/.test($(this).val().substr($(this).val().length - 1))) {
            $(this).val($(this).val().slice(0, -1));
        }
        if (/[^0-9]/g.test($(this).val()) === false && $(this).val() != '') {
            addWarningInput($(this), 'Chỉ được nhập chữ');
        }

    });

    $(document).on('input paste keyup', 'input[data-spec]', function () {
        // let regex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$;
        // if (!regex.test($(this).val())) {
        //    $(this).val($(this).val().slice(0,-1));
        // }

        // Đổi lại cho nhập - + _ {} ( )
        $(this).val($(this).val().replace(/[`~!@#$^*|\=?;:'",.<>\[\]\\\/]/gi, ''));
    })

    $(document).on('input paste keyup', 'input[data-spec-vat]', function () {
        // let regex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$;
        // if (!regex.test($(this).val())) {
        //    $(this).val($(this).val().slice(0,-1));
        // }

        // Đổi lại cho nhập  - + & ( ) % /
        $(this).val($(this).val().replace(/[`\\\#,@!|\^=?;$~._'":*?<>{}]/g, ''));
    })

    $(document).on('input paste keyup', 'input[data-dot]', function () {
        // let regex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$;
        // if (!regex.test($(this).val())) {
        //    $(this).val($(this).val().slice(0,-1));
        // }

        // Đổi lại cho nhập .
        $(this).val($(this).val().replace(/[`~!@#$-+_{}()%^*|\=?;:'",<>\[\]\\\/]/gi, ''));
    })

    //Bắt toàn bộ ký tự đặc biệt
    $(document).on('input paste keyup', 'input[data-spec-all]', function () {
        // let regex = /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$;
        // if (!regex.test($(this).val())) {
        //    $(this).val($(this).val().slice(0,-1));
        // }

        //Bắt toàn bộ ký tự đặc biệt
        $(this).val($(this).val().replace(/[`~!@#$&+_{}()%^*|\-=?;:'",.<>\[\]\\\/]/gi, ''));
    })

    $(document).on('input paste keyup', 'input[data-emoji]', function () {
        let value = $(this).val();
        let newValue = value.replace(/[\u{1f300}-\u{1f5ff}\u{1f900}-\u{1f9ff}\u{1f600}-\u{1f64f}\u{1f680}-\u{1f6ff}\u{2600}-\u{26ff}\u{2700}-\u{27bf}\u{1f1e6}-\u{1f1ff}\u{1f191}-\u{1f251}\u{1f004}\u{1f0cf}\u{1f170}-\u{1f171}\u{1f17e}-\u{1f17f}\u{1f18e}\u{3030}\u{2b50}\u{2b55}\u{2934}-\u{2935}\u{2b05}-\u{2b07}\u{2b1b}-\u{2b1c}\u{3297}\u{3299}\u{303d}\u{00a9}\u{00ae}\u{2122}\u{23f3}\u{24c2}\u{23e9}-\u{23ef}\u{25b6}\u{23f8}-\u{23fa}\u{200d}]*/ug, '');
        $(this).val(newValue);
    });

    $(document).on('input paste keyup', 'textarea[data-emoji]', function () {
        let value = $(this).val();
        let newValue = value.replace(/[\u{1f300}-\u{1f5ff}\u{1f900}-\u{1f9ff}\u{1f600}-\u{1f64f}\u{1f680}-\u{1f6ff}\u{2600}-\u{26ff}\u{2700}-\u{27bf}\u{1f1e6}-\u{1f1ff}\u{1f191}-\u{1f251}\u{1f004}\u{1f0cf}\u{1f170}-\u{1f171}\u{1f17e}-\u{1f17f}\u{1f18e}\u{3030}\u{2b50}\u{2b55}\u{2934}-\u{2935}\u{2b05}-\u{2b07}\u{2b1b}-\u{2b1c}\u{3297}\u{3299}\u{303d}\u{00a9}\u{00ae}\u{2122}\u{23f3}\u{24c2}\u{23e9}-\u{23ef}\u{25b6}\u{23f8}-\u{23fa}\u{200d}]*/ug, '');
        $(this).val(newValue);
    });


    $(document).on('focusout', 'input[data-only-text]', function (e) {
        if ($('button' + ':hover').length === 0) {
            if (/[^0-9]/g.test($(this).val()) === false && $(this).val() != '') {
                if ($(this).parents('table').length > 0) {
                    // addWarningInputTable($(this), 'Chỉ được nhập chữ');
                    // warningTimeOutTable($(this));
                } else {
                    // addWarningInput($(this), 'Chỉ được nhập chữ');
                    // warningTimeOut($(this));
                }
            }
        }
    })

    /* VALIDATE TAX */
    $(document).ready('input', 'input[data-tax]', function () {
        $(this).val($(this).val().replace(/[^0-9\-]/g, ''));
    });
    $(document).on('focusout', 'input[data-tax]', function () {
        $(this).parent().removeClass('focus-validate');
    })

    /* VALIDATE SELECT */
    $(document).on('change', 'select', function () {
        $(this).parent().removeClass('validate-error');
        $(this).parent().removeClass('table-select-error');
    })

    /* VALIDATE RADIO */
    $('.validate-group input[type=radio]').each(function () {
        $(this).parents('.form-group').addClass('validate-group');
        $(this).parents('.form-group').removeClass('row');

        let icon = '<label><i  class="typcn typcn-document-text"></i>' + $(this).parents('.form-group').find('.col-form-label').html() + '</label>';
        if (!($(this).attr('data-icon') === undefined) && $(this).attr('data-icon') !== '') {
            icon = '<label for="' + $(this).attr('id') + '">' + '<i  class="icofont ' + $(this).attr('data-icon') + '"></i>' + $(this).parents('.form-group').find('.col-form-label').html() + '</label>';
        }

        let tooltip = '';
        if ($(this).attr('data-tooltip')) {
            tooltip = '<div class="tool-tip">     ' +
                '<i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip" data-placement="top" data-original-title="' + $(this).data('original-title') + '"></i>' +
                '</div>';
        }
        $(this).parents('.form-group').html('<div class="form-validate-checkbox pb-0 mb-0">' +
            '<i class="icofont icofont-disc"></i>' +
            '<div class="pt-3 ' + $(this).parents('.form-radio').attr('class') + '">' +
            $(this).parents('.form-radio').html() +
            '</div>' + icon +
            '<div class="line"></div>' + tooltip +
            '</div>')
    })

    /* VALIDATE QUANTITY */
    $(document).on('input paste', 'input[data-quantity]', function () {
        console.log($(this).attr('data-limit-text'))
        if ($(this).val() === '.') {
            $(this).val('');
        }
        if ($(this).val() === undefined || $(this).val() === '') {
            $(this).val(0);
        }
        if (removeformatNumber($(this).val()) < 999999999999) {
            if ($(this).val() <= 0) {
                $(this).val('0');
            }
            $(this).val(formatNumber(parseFloat(removeformatNumber($(this).val()))));
        } else {
            $(this).val(formatNumber(999999999999));
            addWarningInput($(this), 'Số lượng tối đa ' + formatNumber(999999999999));
        }
    })
    $(document).on('click', 'input[data-quantity]', function () {
        // let el = $(this).get(0);
        // let elemLen = $(this).val().length;
        // el.selectionStart = 0;
        // el.selectionEnd = elemLen;
        // el.focus();
    })
    $(document).on('focusout', 'input[data-quantity]', function () {
        if ($('button' + ':hover').length === 0) {
            $(this).parent().removeClass('focus-validate');
        }
    })

    /* VALIDATE PERCENT */
    $(document).on('input paste keyup keydown', 'input[data-percent]', function () {
        if (removeformatNumber($(this).val()) < 100) {
            if ($(this).val() < 0) {
                $(this).val('0');
            }
            $(this).val(checkDecimal($(this).val()).toFixed(0));
        } else {
            $(this).val(100)
            // addWarningInput($(this), 'Tối đa là 100');
        }
        $(this).parent().removeClass('focus-validate');
    })
    $(document).on('focusout', 'input[data-percent]', function () {
        if (removeformatNumber($(this).val()) < 100) {
            if ($(this).val() < 0) {
                $(this).val('0');
                addWarningInput($(this), 'Tối thiểu là 0');
            }
            $(this).val(formatNumber(parseFloat(removeformatNumber($(this).val()))));
        } else if ($(this).val() > 100) {
            $(this).val(100)
            addWarningInput($(this), 'Tối đa là 100');
        }

        $(this).parent().removeClass('focus-validate');
    })

    /* VALIDATE NUMBER TEXT */
    $(document).on('input paste', 'input[data-numbertext]', function () {
        // console.log(11);
        removeErrorInput($(this));
        if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/.test($(this).val())) {
            $(this).val($(this).val().slice(0, -1));
        }
    })
    $(document).on('focusout', 'input[data-numbertext]', function () {
        if (!$(this).parent().hasClass('validate-error')) {
            removeErrorInput($(this));
        }
    })

    /* VALIDATE NUMBER */
    $(document).on('input paste', 'input[data-number]', function () {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    })

    /* VALIDATE LABEL */
    $('label[data-theme="material"]').each(function () {
        $(this).removeAttr('class');
        $(this).parents('.form-group').addClass('validate-group');
        $(this).parents('.form-group').removeClass('row');
        $(this).prop('required', true);
        $(this).parents('.form-group').html('<div class="form-validate-label">' +
            '<div class="box-label">' +
            $(this).parent().html() +
            '</div>' +
            '                                <label for="' + $(this).attr('id') + '"><i  class="icofont ' + $(this).parent().attr('data-icon') + '"></i>' + $(this).parents('.form-group').find('.col-form-label').html() + '</label>' +
            '                                <div class="line"></div>' +
            '                               </div>')
    })

    /* VALIDATE CHECKBOX */
    $('input[type=checkbox]').each(function () {
        if ($(this).parents('.validate-group').length === 0) {
            let tooltip = '';
            $(this).parents('.form-group').addClass('validate-group');
            $(this).parents('.form-group').removeClass('row');
            $(this).prop('required', true);
            if ($(this).attr('data-tooltip')) {
                tooltip = '<div class="tool-tip">     ' +
                    '<i class="fa fa-exclamation-circle text-inverse pointer" data-toggle="tooltip" data-placement="top" data-original-title="' + $(this).data('original-title') + '"></i>' +
                    '</div>';
            }
            // $(this).parents('.form-group').html(`<div class="form-validate-checkbox">
            //                                          <i class="icofont icofont-disc"></i>
            //                                             ${$(this).parents(".checkbox-zoom").parent().html()}
            //                                          <label for=" $(this).attr(id) ">
            //                                             <i  class="icofont  $(this).attr(data-icon) "></i>
            //                                             ${$(this).parents(".form-group").find(".col-form-label").html()}
            //                                          </label>
            //                                          <div class="line"></div>
            //                                             ${tooltip}
            //                                      </div>`)
        }
    })

    //Click outside hide tooltip warning dateTimePicker
    $(document).mouseup(function (e) {
        if (!$('.time-filer-dataTale').is(e.target) && $('.time-filer-dataTale').has(e.target).length === 0) {
            $('.time-filer-dataTale').tooltip('hide')
            $('.time-filer-dataTale').removeClass('border-danger')
        }
    });


})


function validateDateTemplate(from, to, functionLoading) {
    if (moment(from.val(), 'DD/MM/YYYY').clone().format('x') > moment(to.val(), 'DD/MM/YYYY').clone().format('x')) {
        WarningNotify('Ngày bắt đầu không được lớn hơn ngày kết thúc !');
        return false;
    } else {
        functionLoading();
    }
}

function checkRequire(name, item) {
    if (item === '') {
        WarningNotify(name + ' không được để trống !');
        return false;
    } else {
        return true;
    }
}

function checkChange(name, item) {
    if (item === '' || item === null || item === '-2') {
        WarningNotify('Vui lòng chọn ' + name + ' !');
        return false;
    } else {
        return true;
    }
}

function checkChangeMultiple(name, item) {
    if (item.length === 0) {
        WarningNotify('Vui lòng chọn ' + name + ' !');
        return false;
    } else {
        return true;
    }
}

function checkChangeRole(name, item) {
    if (item === '' || item === null || item === '-2' || item === '0') {
        WarningNotify('Vui lòng chọn ' + name + ' !');
        return false;
    } else {
        return true;
    }
}

function checkTableLength(name, item) {
    if (item === 0) {
        WarningNotify(name + ' không được để trống!');
        return false;
    } else {
        return true;
    }
}

function checkDate(item) {
    let re = /(\d{1,2})[-\/](\d{1,2})[-\/](\d{4})\s*(\d{0,2}):?(\d{0,2}):?(\d{0,2})/;
    if (item === '') {
        WarningNotify('Vui lòng chọn ngày !');
        return false;
    }
    if (!item.match(re)) {
        WarningNotify('Ngày nhập không hợp lệ !');
        return false;
    } else {
        return true;
    }
}

function checkAge(item) {
    let re = /(\d{1,2})[-\/](\d{1,2})[-\/](\d{4})\s*(\d{0,2}):?(\d{0,2}):?(\d{0,2})/;
    if (item === '') {
        WarningNotify('Vui lòng chọn ngày !');
        return false;
    }
    if (!item.match(re)) {
        WarningNotify('Ngày nhập không hợp lệ !');
        return false;
    }
    let dateInput = Date.parse(item);
    let today = moment().format('DD/MM/YYYY');
    let dateCurrent = Date.parse(today);
    let Difference_In_Time = dateCurrent - dateInput;
    let Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
    alertify.notify(Difference_In_Days, 'error', 5);
}

function checkDateTimeFormat(name, item) {
    if (item === '' || item === null || item.length < 10) {
        WarningNotify(name + ' không đúng định dạng ngày/tháng/năm !');
        return false;
    } else {
        return true;
    }
}

function checkDateTimeMax(name, item) {
    let today = moment().format('MM/DD/YYYY');
    let date = moment(item, 'DD/MM/YYYY').format('MM/DD/YYYY');
    if (Date.parse(today) < Date.parse(date)) {
        WarningNotify(name + ' không được lớn hơn ngày hiện tại !');
        return false;
    } else {
        return true;
    }
}

function checkDateTimeMaxYesterday(name, item) {
    let today = moment().subtract(1, 'days').format('MM/DD/YYYY');
    let date = moment(item, 'DD/MM/YYYY').format('MM/DD/YYYY');
    if (Date.parse(today) < Date.parse(date)) {
        alertify.notify(name + ' không được lớn hơn ngày hiện tại !');
        return false;
    } else {
        return true;
    }
}

function checkCompareDate(name1, data1, name2, data2) {
    let date1 = moment(data1, 'DD/MM/YYYY').format('MM/DD/YYYY');
    let date2 = moment(data2, 'DD/MM/YYYY').format('MM/DD/YYYY');
    if (Date.parse(date1) > Date.parse(date2)) {
        WarningNotify(name1 + ' không được lớn hơn ' + name2 + ' !');
        return false;
    } else {
        return true;
    }
}

function ErrorNotify(text) {
    Swal.fire({
        icon: 'error',
        title: 'Lỗi rồi...',
        text: text,
    })
    // let exists = false;
    // $(".ui-pnotify-text").each(function () {
    //     if ($(this).text().length === text.length)
    //         exists = true;
    // });
    //
    // if (!exists) {
    //     new PNotify({
    //         title: 'Lỗi',
    //         text: text,
    //         icon: 'icofont icofont-info-circle',
    //         type: 'error'
    //     });
    // }
    // alertify.notify('<i class="fa fa-minus-circle"></i> <b> Error: </b> <br> ' + text, 'error', Math.floor(text.length / 5));
}

function ErrorNotifyProfile(text) {
    Swal.fire({
        icon: 'error',
        title: 'Lỗi hệ thống',
        text: text,
    })
    // let exists = false;
    // $(".ui-pnotify-text").each(function () {
    //     if ($(this).text().length === text.length)
    //         exists = true;
    // });
    //
    // if (!exists) {
    //     new PNotify({
    //         title: 'Lỗi',
    //         text: text,
    //         icon: 'icofont icofont-info-circle',
    //         type: 'error'
    //     });
    // }
    // alertify.notify('<i class="fa fa-minus-circle"></i> <b> Error: </b> <br> ' + text, 'error', Math.floor(text.length / 5));
}

function WarningNotify(text) {
    Swal.fire({
        icon: 'warning',
        title: 'Thông báo',
        text: text,
    })
    // let exists = false;
    // $(".ui-pnotify-text").each(function () {
    //     if ($(this).text().length === text.length)
    //         exists = true;
    // });
    //
    // if (!exists) {
    //     new PNotify({
    //         title: 'Nhắc',
    //         text: text,
    //         icon: 'icofont icofont-info-circle',
    //         type: 'default',
    //     });
    // }
    // alertify.notify('<i class="fa fa-info-circle"></i> <b> Warning: </b> <br> ' + text, 'warning', Math.floor(text.length / 5));
}

function SuccessNotify(text) {
    Swal.fire({
        icon: 'success',
        title: text,
        showConfirmButton: false,
        timer: 1000
    })
    // let exists = false;
    // $(".ui-pnotify-text").each(function () {
    //     if ($(this).text().length === text.length)
    //         exists = true;
    // });
    //
    // if (!exists) {
    //     new PNotify({
    //         title: 'Thành công',
    //         text: text,
    //         icon: 'icofont icofont-info-circle',
    //         type: 'success'
    //     });
    // }

    // alertify.notify('<i class="fa fa-check-circle"></i> <b> Done: </b> <br> ' + text, 'success', Math.floor(text.length / 5));
}

/* FUNCTION VALIDATE  */
/**
 * Key: data-validate=""
 * Value:
 * - empty: k được rỗng
 * - max-100: số tối đa là 100, tự động currency
 * - min-10: số tối thiểu là 100 tự động currency
 * -
 */

let exists = false;

// Thêm class lỗi vào message thông báo cho validate
function addErrorInput(el, text) {
    el.parent().removeClass('validate-error');
    el.parent().removeClass('focus-validate');
    el.parent().addClass('validate-error');
    el.parent().parent().append('<div class="error">' +
        '<span class="text-danger">' + text + '</span>' +
        '</div>');
}

function addErrorInputTable(el, text) {
    el.parents('.border-group').removeClass('focus-validate');
    el.parents('.border-group').removeClass('error-validate');
    el.parents('.border-group').addClass('error-validate');
    el.parents('td').append('<div class="error-table">' +
        '                        <span class="text-danger text-left">' + text + '</span>' +
        '                    </div>');
}

// Thêm class thông báo cho textarea
function addErrorTexeArea(el, text) {
    el.parents('.form-group').find('.error').remove();
    el.parent().removeClass('validate-error');
    el.parent().removeClass('focus-validate');
    el.parent().addClass('validate-error');
    el.parent().parent().parent().append(' <div class="error">' +
        '                           <span class="text-danger">' + text + '</span>' +
        '                           </div>');
    warningTimeOut(el);
}

//
function addWarningInput(el, text) {
    // el.parent().parent().prepend('<span class="notify-valid text-center" id="error-input">' + text + '</span>');
    el.parent().parent().find('.error').remove();
    el.parent().removeClass('warning-error');
    el.parent().removeClass('focus-validate');
    el.parent().removeClass('validate-error');
    el.parent().addClass('warning-error');
    el.parent().parent().append('<div class="error">' +
        '                        <span class="text-danger">' + text + '</span>' +
        '                    </div>');
    warningTimeOut(el);
}

// Xoá class validate lỗi
function removeErrorInput(el) {
    el.parent().removeClass('focus-validate');
    el.parents('.validate-error').removeClass('validate-error');
    el.parents('.warning-error').removeClass('warning-error');
    el.parent().parent().find('.error').remove();
}

function removeErrorInputTable(el) {
    el.parents('.border-group').removeClass('error-validate');
    el.parents('.border-group').removeClass('warning-validate');
    el.parents('.border-group').parent().find('.error-table').remove();

}

function warningTimeOutTable(el) {
    let this_input = el;
    if (!$(this).parent().hasClass('warning-validate')) {
        setTimeout(function () {
            this_input.parents('.border-group').removeClass('warning-validate');
            this_input.parents('.border-group').parent().find('.error-table').remove();
        }, 3000);
    }
}

function warningTimeOut(el) {
    let this_input = el;
    if (!$(this).parent().hasClass('warning-error')) {
        setTimeout(function () {
            this_input.parent().removeClass('warning-error');
            this_input.parent().parent().find('.error').remove();
        }, 3000);
    }
}

function checkMoney(el) {
    console.log(123)
    let flag = true;

}


function checkValidateSave(el) {
    let flag = true;
    let text = '';
    el.find('input:not(:checkbox)').each(function () {
        if ($(this).attr('type') != 'file') {
            $(this).val($(this).val().trim());
            if ($(this).parents('.d-none').length === 0 && !$(this).hasClass('disabled')) {
                text = '';
                let element = $(this).attr('data-validate');
                if ($(this).attr('data-empty')) {
                    if ($(this).val() === '') {
                        let exists = false;
                        if ($(this).parents('table').length != 0) {
                            // $(".ui-pnotify-text").each(function () {
                            //     if ($(this).text().length === ('Không được để trống').length)
                            //         exists = true;
                            //     flag = false;
                            // });
                            // if (!exists) {
                            //     WarningNotify('Không được để trống');
                            //     flag = false;
                            // }
                            $(this).parent().addClass('border-danger');
                        } else {
                            text = 'Không được để trống'
                        }
                        flag = false;
                    }
                }
                $(this).val($(this).val().trim());


                // Validate max
                if ($(this).attr('data-max') && !$(this).attr('data-max-value-of')) {
                    let max_value = formatNumber($(this).attr('data-max'));
                    if (removeformatNumber($(this).val()) <= Number($(this).attr('data-max'))) {
                        $(this).attr('data-check', 0);
                    } else {
                        if ($(this).parents('table').length != 0) {
                            // $(".ui-pnotify-text").each(function () {
                            //     if ($(this).text().length === ('Số tối đa là ' + max_value).length)
                            //         exists = true;
                            //     flag = false;
                            // });
                            // $(this).val(formatNumber($(this).attr('data-max')));
                            // if (!exists) {
                            //     WarningNotify('Số tối đa là ' + max_value);
                            //     $(this).val(formatNumber($(this).attr('data-max')));
                            //     flag = false;
                            // }
                            $(this).parent().addClass('border-danger');
                        } else {
                            text = 'Số tối đa là ' + $(this).attr('data-max');
                            $(this).val(Number($(this).attr('data-max')));
                            addErrorInput($(this), text);
                            $(this).attr('data-check', 2);
                            flag = false;
                        }
                    }
                }

                // Validate min
                if ($(this).attr('data-min') && !$(this).attr('data-min-value-of')) {// removeErrorInput($(this));
                    $(this).parent().removeClass('border-danger');
                    let exists = false;
                    let min_value = formatNumber($(this).attr('data-min'));
                    if ($(this).val() === '') {
                        $(this).val(0);
                        if ($(this).parents('table').length != 0) {
                            $(this).parent().addClass('border-danger');
                            flag = false
                        } else {
                            text = 'Số tối thiểu ' + min_value;
                            addErrorInput($(this), text);
                        }
                        flag = false;
                    } else {
                        if (parseFloat(removeformatNumber($(this).val())) < removeformatNumber(min_value)) {
                            if ($(this).parents('table').length != 0) {
                                $(this).parent().addClass('border-danger');
                                flag = false;
                            } else {
                                text = 'Số tối thiểu ' + min_value;
                                addErrorInput($(this), text);
                            }
                            flag = false;
                        } else {
                            $(this).parent().removeClass('border-danger');
                        }
                    }
                } else {
                    if ($(this).attr('data-value-min-value-of')) {
                        removeErrorInput($(this));
                        $(this).parent().removeClass('border-danger');
                        let exists = false;
                        let min_value = formatNumber($(this).attr('data-value-min-value-of'));
                        if ($(this).val() === '') {
                            $(this).val(0);
                            if ($(this).parents('table').length != 0) {
                                $(this).parent().addClass('border-danger');
                                flag = false;
                            } else {
                                addErrorInput($(this), 'Số phải lớn hơn ' + $(this).data('data-value-min-value-of'));
                                text = 'Số tối thiểu ' + min_value;
                            }
                        } else {
                            if (parseFloat($(this).val()) <= $(this).attr('data-value-min-value-of')) {
                                if ($(this).parents('table').length != 0) {
                                    $(this).parent().addClass('border-danger');
                                } else {
                                    text = 'Số phải lớn hơn ' + min_value;
                                }
                                flag = false;
                            } else {
                                $(this).parent().removeClass('border-danger');
                            }
                        }

                    }
                }

                // validate money
                if ($(this).attr('data-money-min') && $(this).attr('data-money-allow')) {
                    let min_values = $(this).attr('data-money-min');
                    let allow_zero = parseFloat($(this).attr('data-money-allow'));
                    if ($(this).val() === '') {
                        $(this).val(0);
                    }
                    if (parseFloat(removeformatNumber($(this).val())) < min_values && parseFloat(removeformatNumber($(this).val())) > allow_zero) {
                        console.log($(this).parents('table').length)
                        if ($(this).parents('table').length != 0) {
                            $(this).parent().addClass('border-danger');
                        } else {
                            text = 'số tối thiểu = 100 hoặc = 0 ';
                        }
                        flag = false;
                    } else {
                        $(this).parent().removeClass('border-danger');
                    }
                }

                // Số Phần trăm
                if ($(this).attr('data-percent')) {
                    if ($(this).val() < 0 || $(this).val() == '') {
                        $(this).val('0');
                        $(this).attr('data-check', '1');
                        $(this).val(0);
                        flag = false;
                    } else if ($(this).val() > 100) {
                        $(this).val('100');
                        $(this).attr('data-check', '1');
                        text = 'Phần trăm không được lớn hơn 100';
                        flag = false;
                    } else {
                        $(this).attr('data-check', '0');
                    }
                    // $(this).val($(this).val().replace(/[^0-9]/g,''));
                }

                // // Chỉ được nhập chữ
                // if(element.includes('text')){
                //     if(/[^0-9]/g.test($(this).val()) === false && $(this).val() != ''){
                //         text = 'Chỉ được nhập chữ';
                //         $(this).attr('data-check', 2);
                //     }
                //     $(this).val($(this).val().replace(/[^a-z]/g, ''));
                // }

                if ($(this).attr('data-text') !== undefined) {
                    $(this).val($(this).val().trim());
                }

                if ($(this).attr('data-max-length') !== undefined) {
                    $(this).val($(this).val().trim());
                }

                // Validate mail
                if ($(this).attr('data-mail')) {
                    // let reMail = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
                    // let reMail = /^[a-zA-Z0-9]{1,49}((\.|\+)?[a-zA-Z0-9])\@([a-zA-Z0-9]+)([\.])([a-zA-Z\.]+){2,}/g;
                    let reMail = /^[a-zA-Z0-9]+([._]?[a-zA-Z0-9]+)*@[a-zA-Z0-9]+([.-]?[a-zA-Z0-9]+)*(\.[a-zA-Z]{2,})+$/;
                    // let reMail = /^[a-zA-Z0-9.]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                    let input_email = $(this).val();
                    if (input_email !== '') {
                        if (!input_email.match(reMail)) {
                            if ($(this).parents('table').length != 0) {
                                $(this).parent().addClass('border-danger');
                            } else {
                                text = 'Mail không đúng định dạng | VD: TenMail@gmail.com'
                                $(this).attr('data-check', 1);
                                flag = false;
                            }
                        }
                    }
                }

                if ($(this).attr('data-numbertext')) {
                    let number = /^(?=.*[A-Za-z])(?=.*?[0-9])/u;
                    if (!number.test($(this).val())) {
                        text = 'Phải ít nhất 1 số và 1 chữ';
                        flag = false;
                    } else {
                        flag = true;
                    }
                }
                // Độ tối thiểu chuỗi
                if ($(this).attr('data-min-length')) {
                    if ($(this).val().length >= $(this).attr('data-min-length')) {
                        $(this).attr('data-check', 0);
                    } else {
                        if ($(this).val() != '') {
                            if ($(this).parents('table').length != 0) {
                                // let exists = false;
                                // $(".ui-pnotify-text").each(function () {
                                //     if ($(this).text().length === ('Độ dài tối thiểu ' + $(this).attr('data-min-length')).length)
                                //         exists = true;
                                //     flag = false;
                                // });
                                // if (!exists) {
                                //     WarningNotify('Độ dài tối thiểu ' + $(this).attr('data-min-length'));
                                flag = false;
                                // }
                                $(this).parent().addClass('border-danger');
                            } else {
                                text = 'Độ dài tối thiểu ' + $(this).attr('data-min-length') + ' ký tự';
                                flag = false;
                            }
                        }
                    }
                }

                // Độ tối đa chuỗi
                if ($(this).attr('data-max-length')) {
                    if ($(this).val().length <= $(this).attr('data-max-length')) {
                        $(this).attr('data-check', 0);
                    } else {
                        $(this).attr('data-check', 2);
                        text = 'Độ dài tối đa ' + $(this).attr('data-max-length');
                        // $(this).val($(this).val().slice(0, -1));
                        flag = false;
                    }
                    $(this).val($(this).val().trim());
                }

                if ($(this).attr('data-money')) {
                    if ($(this).val() < 100 && $(this).val() != 0) {
                        // if ($(this).val() != 0) {
                        if ($(this).parents('table').length != 0) {
                            // let exists = false;
                            // $(".ui-pnotify-text").each(function () {
                            //     if ($(this).text().length === ('Số tiền 0 hoặc lớn bằng 100'))
                            //         exists = true;
                            //     flag = false;
                            // });
                            // if (!exists) {
                            //     WarningNotify('Số tiền 0 hoặc lớn bằng 100');
                            flag = false;
                            // }
                            $(this).parent().addClass('border-danger');
                        } else {
                            text = 'Số tiền lớn hơn hoặc bằng 100';
                            flag = false;
                        }
                        // }
                    }
                }
                //Validate nơi sinh
                if ($(this).attr('data-birthday-place')) {
                    if ($(this).val().length === 1 || $(this).val().length > 255) {
                        text = 'Nơi sinh phải từ 2 đến 255 ký tự';
                        flag = false;
                    }
                }


                // Validate website
                if ($(this).attr('data-website')) {
                    if ($(this).val() != '') {
                        let reWeb = /^(http:\/\/|https:\/\/)?(www.)?([a-zA-Z0-9]+).[a-zA-Z0-9]*.[‌​a-z]{3}\.([a-z]+)?$/gi;
                        if (!($(this).val().match(reWeb))) {
                            text = 'Website không đúng định dạnh | VD: www.domain.com';
                            flag = false;
                        }
                    }
                }

                if ($(this).attr('data-url')) {
                    if ($(this).val() != '') {
                        let reWeb = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w\.-]*)*\/?$/;
                        if (!(reWeb.test($(this).val()))) {
                            text = 'Website không đúng định dạnh | VD: www.domain.com';
                            flag = false;
                        }
                    }
                }

                //Mã số thuế
                if ($(this).attr('data-tax-code')) {
                    if ($(this).val().length > 0 && ($(this).val().length < 10 || $(this).val().length > 15)) {
                        // $(this).val($(this).val().slice(0, $(this).attr('data-tax-code')));
                        text = 'Mã số thuế phải từ 10 - 15 ký tự';
                        flag = false;
                    }
                }

                // Validate số điện thoại
                if ($(this).attr('data-phone')) {
                    // removeErrorInput($(this));
                    // let rePhone = /^(09|03|07|08|05).*$/;
                    let rePhone = /^(09|03|07|08|05|04|06|02|01).*$/;
                    $(this).val($(this).val().replace(/([^0-9\\])[\/]/g, ''));
                    if ($(this).val().length <= 10 && $(this).val() != '') {
                        if (!($(this).val().length < 2 || $(this).val().length >= 1 && $(this).val().substring(0, 2).match(rePhone))) {
                            if ($(this).parents('table').length != 0) {
                                // let exists = false;
                                // $(".ui-pnotify-text").each(function () {
                                //     if ($(this).text().length === ('Đầu số không đúng định dạng | 09 | 03 | 07 | 08 | 05'))
                                //         exists = true;
                                //     flag = false;
                                // });
                                // if (!exists) {
                                //     WarningNotify('Đầu số không đúng định dạng | 09 | 03 | 07 | 08 | 05');
                                //     flag = false;
                                // }
                                $(this).parent().addClass('border-danger');
                            } else {
                                text = 'Đầu SĐT không đúng định dạng'
                                // text = 'Đầu số không đúng định dạng | 09 | 03 | 07 | 08 | 05';
                                flag = false;
                            }
                        } else {
                            if ($(this).val().length === 10 && $(this).val().substring(0, 2).match(rePhone)) {
                                $(this).attr('data-check', 0);
                            } else {
                                if ($(this).parents('table').length != 0) {
                                    // let exists = false;
                                    // $(".ui-pnotify-text").each(function () {
                                    //     if ($(this).text().length === ('Số điện thoại chưa đúng 10 số!'))
                                    //         exists = true;
                                    //     flag = false;
                                    // });
                                    // if (!exists) {
                                    //     WarningNotify('Số điện thoại chưa đúng 10 số!');
                                    //     flag = false;
                                    // }
                                    $(this).parent().addClass('border-danger');
                                } else {
                                    text = 'Số điện thoại chưa đúng 10 số!';
                                    flag = false;
                                }
                            }
                        }
                    } else {
                        if ($(this).parents('table').length != 0) {
                            // let exists = false;
                            // $(".ui-pnotify-text").each(function () {
                            //     if ($(this).text().length === ('Số điện thoại chưa đúng 10 số!'))
                            //         exists = true;
                            //     flag = false;
                            // });
                            // if (!exists) {
                            //     WarningNotify('Số điện thoại chưa đúng 10 số!');
                            //     flag = false;
                            // }
                            $(this).parent().addClass('border-danger');
                        } else {
                            text = 'Số điện thoại không được bỏ trống !';
                            flag = false;
                        }
                    }
                }

                if ($(this).attr('ipadd')) {
                    let ip = /^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;
                    if (!ip.test($(this).val())) {
                        text = 'IP không hợp lệ ';
                        flag = false;
                    }
                }

                if (text != '') {
                    if ($(this).parents('table').length) {
                        removeErrorInputTable($(this));
                        addErrorInputTable($(this), text);
                    } else {
                        removeErrorInput($(this));
                        addErrorInput($(this), text);
                    }
                } else {
                    if ($(this).parents('table').length) {
                        removeErrorInputTable($(this));
                    } else {
                        removeErrorInput($(this));
                    }
                    $(this).parent().removeClass('focus-validate');
                }
            }
        }
    })
    el.find('select[data-select]').each(function () {
        if ($(this).parents('.d-none').length === 0 && !$(this).hasClass('disabled')) {
            // let element = $(this).attr('data-validate');
            if ($(this).val() == '-2' || $(this).val() == null || $(this).val() == '') {
                if ($(this).parents('table').length != 0) {
                    $(this).parent().addClass('table-select-error');
                } else {
                    $(this).parent().addClass('validate-error');
                }
                flag = false;
            } else {
                $(this).parent().removeClass('border-danger');
                $(this).parent().removeClass('validate-error');
            }
        }
    })
    el.find('textarea[data-note]').each(function () {
        $(this).val($(this).val().trim());
        if ($(this).parents('.d-none').length === 0 && !$(this).hasClass('disabled')) {
            $(this).parents('.form-group').find('.error').remove();
            $(this).parent().removeClass('validate-error');
            $(this).parent().removeClass('focus-validate');
            let element = $(this).attr('data-validate');
            if ($(this).attr('data-note')) {
                if ($(this).val() === '' || $(this).val().length < 2) {
                    // $(this).parent().addClass('validate-error');
                    text = 'Tối thiểu 2 đến 255 ký tự';
                    addErrorInput($(this).parent(), text);
                    flag = false;
                } else {
                    $(this).parent().removeClass('validate-error');
                }
            }
        }
    })
    return flag;
}

function removeAllValidate() {
    $('select').prop('selectIndex', 0);
    $('select').parent().removeClass('validate-error');
    $('input').parent().removeClass('validate-error');
    removeErrorInput($('input'));
    removeErrorInput($('textarea'));
    // removeSpanSelect($('select'));
    $('input').parent().find('.error').remove();
    $('textarea').parent().find('.error').remove();
    // $('textarea').val('');
    // $("input[type=radio]").first().click();
}

function focusTextInput(r) {
    // let el = r.get(0);
    // let elemLen = r.val().length;
    // el.selectionStart = 0;
    // el.selectionEnd = elemLen;
    // el.focus();
}

function checkDateTimePicker(r) {
    let from = r.parent().find('input:first'),
        to = r.parent().find('input:last'),
        wrapper = r.parent()
    wrapper.tooltip({
        'trigger': 'manual',
        'container': r.parents('.time-filer-dataTale')
    })
    wrapper.tooltip('hide')
    if (moment(from.val(), 'DD/MM/YYYY').clone().format('x') > moment(to.val(), 'DD/MM/YYYY').clone().format('x')) {
        wrapper.addClass('border-danger')
        wrapper.attr({
            'data-toggle': 'tooltip',
            'data-placement': 'top',
            'data-original-title': 'Ngày bắt đầu không được lớn hơn ngày kết thúc'
        })
        r.parents('.time-filer-dataTale').tooltip('show');
        from.on('click', function () {
            $(this).parent().tooltip('hide')
            $(this).parent().removeClass('border-danger')
        })
        to.on('click', function () {
            $(this).parent().tooltip('hide')
            $(this).parent().removeClass('border-danger')
        })
        return false;
    }
    return true;
}

function checkReportDateTimePicker(r) {
    let from = r.parent().find('input:first'),
        to = r.parent().find('input:last'),
        wrapper = r.parent()
    wrapper.tooltip({
        'trigger': 'manual',
        'container': r.parents('.time-input-filter-time-bar')
    })
    wrapper.tooltip('hide');
    switch ($('.custom-select-option-report').val()) {
        case '13':
            if (moment(from.val(), 'DD/MM/YYYY').clone().format('x') > moment(to.val(), 'DD/MM/YYYY').clone().format('x')) {
                wrapper.addClass('border-danger')
                wrapper.attr({
                    'data-toggle': 'tooltip',
                    'data-placement': 'top',
                    'data-original-title': 'Thời gian bắt đầu không được lớn hơn thời gian kết thúc !'
                })
                r.parents('.time-input-filter-time-bar').tooltip('show');
                from.on('click', function () {
                    $(this).parent().removeClass('border-danger')
                })
                to.on('click', function () {
                    $(this).parent().removeClass('border-danger')
                })
                return false;
            }
            break;
        case '15':
            if (moment(from.val(), 'MM/YYYY').clone().format('x') > moment(to.val(), 'MM/YYYY').clone().format('x')) {
                wrapper.addClass('border-danger')
                wrapper.attr({
                    'data-toggle': 'tooltip',
                    'data-placement': 'top',
                    'data-original-title': 'Thời gian bắt đầu không được lớn hơn thời gian kết thúc !'
                })
                r.parents('.time-input-filter-time-bar').tooltip('show');
                from.on('click', function () {
                    $(this).parent().removeClass('border-danger')
                })
                to.on('click', function () {
                    $(this).parent().removeClass('border-danger')
                })
                return false;
            }
            break;
    }
    return true;
}

function checkDashboardCustomDateTimePicker(r, selectElm) {
    let from = r.parents('.add-display').find('input:first'),
        to = r.parents('.add-display').find('input:last'),
        wrapper = r.parents('.add-display');
    wrapper.tooltip({
        'trigger': 'manual',
        'container': r.parents('.add-display')
    })
    switch (selectElm.val()) {
        case '13':
            if (moment(from.val(), 'DD/MM/YYYY').isAfter(moment(to.val(), 'DD/MM/YYYY'))) {
                wrapper.addClass('border-danger')
                wrapper.attr({
                    'data-toggle': 'tooltip',
                    'data-placement': 'top',
                    'data-original-title': 'Ngày bắt đầu không được lớn hơn ngày kết thúc !'
                })
                r.parents('.add-display').tooltip('show');
                from.on('click', function () {
                    $(this).parents('.add-display').removeClass('border-danger')
                })
                to.on('click', function () {
                    $(this).parents('.add-display').removeClass('border-danger')
                })
                return false;
            }
            r.parents('.add-display').tooltip('hide');
            break;
        case '15':
            if (moment(from.val(), 'MM/YYYY').isAfter(moment(to.val(), 'MM/YYYY'))) {
                wrapper.addClass('border-danger')
                wrapper.attr({
                    'data-toggle': 'tooltip',
                    'data-placement': 'top',
                    'data-original-title': 'Tháng bắt đầu không được lớn hơn tháng kết thúc !'
                })
                r.parents('.add-display').tooltip('show');
                from.on('click', function () {
                    $(this).parents('.add-display').removeClass('border-danger')
                })
                to.on('click', function () {
                    $(this).parents('.add-display').removeClass('border-danger')
                })
                return false;
            }
            r.parents('.add-display').tooltip('hide');
            break;
        case '16':
            if (moment(from.val(), 'YYYY').isAfter(moment(to.val(), 'YYYY'))) {
                wrapper.addClass('border-danger')
                wrapper.attr({
                    'data-toggle': 'tooltip',
                    'data-placement': 'top',
                    'data-original-title': 'Năm bắt đầu không được lớn hơn năm kết thúc !'
                })
                r.parents('.add-display').tooltip('show');
                from.on('click', function () {
                    $(this).parents('.add-display').removeClass('border-danger')
                })
                to.on('click', function () {
                    $(this).parents('.add-display').removeClass('border-danger')
                })
                return false;
            }
            r.parents('.add-display').tooltip('hide');
            break;
    }
    return true;
}
