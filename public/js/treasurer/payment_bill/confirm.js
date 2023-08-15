/**
 * Table Chờ duyệt chi
 * Event chọn check box & xác nhận phiếu
 */
function confirmPaymentPaymentBill(r) {
    if (saveConfirmPaymentPaymentBill === 1) return false;
    let boxConfirm = null;
    if ($('#level-template').val() > 0) {
        boxConfirm = renderListFundPaymentBill('Duyệt chi ?', 'question', 'select-fund-payment-bill-treasurer', $('#select-fund-payment-bill-treasurer'))
    } else {
        let title = 'Duyệt chi ?',
            content = '',
            icon = 'question';
        boxConfirm = sweetAlertComponent(title, content, icon)
    }
    boxConfirm
        .then(async (result) => {
            if (result.value) {
                saveConfirmPaymentPaymentBill = 1;
                let method = 'post',
                    url = 'payment-bill-treasurer.confirm-payment',
                    params = null,
                    data = {
                        branch: r.data('branch'),
                        id: r.data('id'),
                        cash_flow_time: $('#select-fund-payment-bill-treasurer').val()
                    };
                let res = await axiosTemplate(method, url, params, data);
                saveConfirmPaymentPaymentBill = 0;
                let text;
                switch (res.data.status) {
                    case 200:
                        text = $('#success-confirm-data-to-server').text();
                        SuccessNotify(text);
                        $('.check-all-bill-payment').prop('checked', false)
                        loadingData();
                        break;
                    case 500:
                        text = $('#error-post-data-to-server').text();
                        if (res.data.message !== null) text = res.data.message;
                        ErrorNotify(text);
                        break;
                    default:
                        text = $('#error-post-data-to-server').text();
                        if (res.data.message !== null) text = res.data.message;
                        WarningNotify(text);
                }
            }
        })
}

async function getListFundPaymentBill(selectorElm, cashFlowSelected = '') {
    $('#select2-select-fund-payment-bill-treasurer-container').parents('.swal2-content').css('z-index', 99);
    $('#select2-select-multi-fund-payment-bill-treasurer-container').parents('.swal2-content').css('z-index', 99);
    $('#select2-select-payment-fund-payment-bill-treasurer-container').parents('.swal2-content').css('z-index', 99);
    $('#select2-confirm-multi-payment-bill-treasurer-container').parents('.swal2-content').css('z-index', 99);
    let method = 'get',
        url = 'payment-bill-treasurer.list-fund',
        params = {},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#select-fund-payment-bill-treasurer'), $('#select-multi-fund-payment-bill-treasurer'),
        $('#select-payment-fund-payment-bill-treasurer'), $('#confirm-multi-payment-bill-treasurer')]);
    $('#select-fund-payment-bill-treasurer').html(res.data[0]).trigger('select2.select');
    $('#select-multi-fund-payment-bill-treasurer').html(res.data[0]).trigger('select2.select');
    $('#select-payment-fund-payment-bill-treasurer').html(res.data[0]).trigger('select2.select');
    let cash_flow_selected = res.data[1].data.list.find(v => moment(v.time_value, 'YYYY-MM-DD').format('MM/YYYY') === moment(cashFlowSelected, 'DD/MM/YYYY HH:mm:ss').format('MM/YYYY'))
    cash_flow_selected ? $('#select-payment-fund-payment-bill-treasurer').val(cash_flow_selected.time_value).trigger('change.select2') : false;
    $('#confirm-multi-payment-bill-treasurer').html(res.data[0]).trigger('select2.select');
}

function renderListFundPaymentBill(title, icon, elmName, selectorElm, cashFlowSelected = '') {
    let swalWithBootstrapButton = Swal.mixin({
        customClass: {
            container: "body-payment-bill-treasurer",
            confirmButton: 'btn btn-primary btn-sweet-alert',
            cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
        },
        buttonsStyling: false,
        allowOutsideClick: false,
    });
    return swalWithBootstrapButton.fire({
        title: title,
        icon: icon,
        html: `<div class="seemt-container form-group select2_theme validate-group mt-3" style="width: 50%; transform: translateX(50%)">
                                <div class="form-validate-select ">
                                    <div class="col-lg-12 mx-0 px-0">
                                        <div class="col-lg-12 pr-0 select-material-box">
                                            <select id="${elmName}" data-select="1"
                                                    class="js-example-basic-single select2-hidden-accessible"
                                                    tabindex="-1" aria-hidden="true">
                                            </select>
                                            <label class="text-left" class="icon-validate">
                                                Chọn nguồn tiền
                                                <svg class="ml-0" width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="11" height="11" rx="5.5" fill="#E96012"/>
                                                    <g clip-path="url(#clip0_25549_405699)">
                                                        <path d="M8.07823 6.0886L7.12832 5.49999L8.07823 4.91138C8.17704 4.8511 8.26308 4.77138 8.33133 4.67687C8.39958 4.58236 8.44866 4.47495 8.47572 4.36092C8.50278 4.24689 8.50727 4.1285 8.48894 4.01268C8.4706 3.89686 8.42981 3.78592 8.36893 3.68632C8.30805 3.58673 8.22831 3.50048 8.13436 3.43261C8.0404 3.36474 7.93412 3.3166 7.82171 3.29101C7.7093 3.26542 7.59301 3.26288 7.47963 3.28354C7.36625 3.30421 7.25804 3.34767 7.16132 3.41138L6.3055 3.96943V2.99999C6.3055 2.77898 6.2193 2.56701 6.06586 2.41073C5.91242 2.25445 5.70432 2.16666 5.48732 2.16666C5.27033 2.16666 5.06222 2.25445 4.90878 2.41073C4.75534 2.56701 4.66914 2.77898 4.66914 2.99999V3.99666L3.81332 3.41138C3.61815 3.29232 3.38487 3.2561 3.16374 3.31054C2.94261 3.36497 2.75132 3.5057 2.63108 3.70241C2.51084 3.89911 2.47127 4.13605 2.5209 4.36218C2.57053 4.58832 2.70538 4.78554 2.89641 4.91138L3.84632 5.49999L2.89641 6.0886C2.70538 6.21444 2.57053 6.41166 2.5209 6.6378C2.47127 6.86393 2.51084 7.10087 2.63108 7.29757C2.75132 7.49428 2.94261 7.63501 3.16374 7.68944C3.38487 7.74388 3.61815 7.70766 3.81332 7.5886L4.66914 7.02249V7.99999C4.66914 8.221 4.75534 8.43297 4.90878 8.58925C5.06222 8.74553 5.27033 8.83332 5.48732 8.83332C5.70432 8.83332 5.91242 8.74553 6.06586 8.58925C6.2193 8.43297 6.3055 8.221 6.3055 7.99999V7.00555L7.16132 7.58888C7.35649 7.70794 7.58977 7.74415 7.8109 7.68972C8.03203 7.63528 8.22333 7.49456 8.34357 7.29785C8.46381 7.10115 8.50337 6.86421 8.45374 6.63807C8.40411 6.41194 8.26926 6.21471 8.07823 6.08888V6.0886Z" fill="#FCF0E7"/>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_25549_405699">
                                                            <rect width="6" height="6.66667" fill="white" transform="translate(2.5 2.16666)"/>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                           </div>`,
        onOpen: function () {
            $(`.swal2-html-container select`).select2({
                dropdownParent: $('.swal2-html-container')
            })
            getListFundPaymentBill(selectorElm, cashFlowSelected);
        },
        showConfirmButton: true,
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: $('#button-btn-confirm-component').text(),
        cancelButtonText: $('#button-btn-cancel-component').text(),
        reverseButtons: true,
        focusConfirm: true,
        customClass: {
            container: 'popup-swal-205',
            cancelButton: 'btn btn-grd-disabled btn-sweet-alert',
            confirmButton: 'btn btn btn-grd-primary btn-sweet-alert'
        }
    })
}

async function confirmMultiPaymentBill(r) {
    if (saveConfirmPaymentPaymentBill === 1) return false;
    let idPaymentBill = [];
    await tableWaitingConfirmPayment.rows().every(function () {
        let row = $(this.node());
        if (row.find('td:eq(8)').find('input').is(':checked')) {
            idPaymentBill.push(row.find('td:eq(8)').find('input').val());
        }
    });
    let boxConfirm = null;
    if ($('#level-template').val() > 0) {
        boxConfirm = renderListFundPaymentBill('Duyệt chi tất cả phiếu đã chọn ?', 'question', 'confirm-multi-payment-bill-treasurer', $('#confirm-multi-payment-bill-treasurer'))
    } else {
        let title = 'Duyệt chi tất cả phiếu đã chọn?',
            content = '',
            icon = 'question';
        boxConfirm = sweetAlertComponent(title, content, icon)
    }
    boxConfirm
        .then(async (result) => {
            if (result.value) {
                saveConfirmPaymentPaymentBill = 1
                let method = 'post',
                    url = 'payment-bill-treasurer.confirm-payment-multi',
                    params = null,
                    data = {
                        branch: $('#select-branch-payment-bill-treasurer').val(),
                        id: idPaymentBill,
                        cash_flow_time: $('#confirm-multi-payment-bill-treasurer').val(),
                    };
                let res = await axiosTemplate(method, url, params, data, [$('#table-waiting-confirm-payment-payment-treasurer')]);
                saveConfirmPaymentPaymentBill = 0
                let text;
                switch (res.data.status) {
                    case 200:
                        text = $('#success-confirm-data-to-server').text();
                        SuccessNotify(text);
                        hideCheckAllWaitingConfirmPaymentBill()
                        loadingData();
                        break;
                    case 400:
                        if (res.data.message !== null) text = 'Vui lòng chọn phiếu chi cần duyệt!';
                        WarningNotify(text);
                        break;
                    case 500:
                        text = $('#error-post-data-to-server').text();
                        if (res.data.message !== null) text = res.data.message;
                        ErrorNotify(text);
                        break;
                    default:
                        text = $('#error-post-data-to-server').text();
                        if (res.data.message !== null) text = res.data.message;
                        WarningNotify(text);
                }
            }
        })
}

async function checkWaitingConfirmPaymentBill(r) {
    if (r.is(':checked')) {
        let checkALl=true
        tableWaitingConfirmPayment.rows().every(function (index, element) {
            let x = $(this.node());
            if( x.find('td:eq(8)').find('input').is(':checked')){}
            else {
                $('#checkbox-all-confirm-waiting-payment').prop('checked', false)
                checkALl=false
            }
        })
        if(checkALl) {
            $('#checkbox-all-confirm-waiting-payment').prop('checked', true)
        }
        let total= $('#total-count-confirm-waiting-payment').text().split('/')[0]
        $('#total-count-confirm-waiting-payment').text(parseInt(total)+1+'/'+$('#total-count-confirm-waiting-payment').text().split('/')[1])
    } else {
        let total= $('#total-count-confirm-waiting-payment').text().split('/')[0]
        $('#total-count-confirm-waiting-payment').text(parseInt(total)-1+'/'+$('#total-count-confirm-waiting-payment').text().split('/')[1])
        $('#checkbox-all-confirm-waiting-payment').prop('checked', false)
    }
}

async function checkboxWaitingPaymentBill(r) {
    if (r.is(':checked')) {
        let checkALl=true
        tableWaitingPayment.rows().every(function (index, element) {
            let x = $(this.node());
            if( x.find('td:eq(8)').find('input').is(':checked')){}
            else {
                $('#checkbox-all-waiting-payment').prop('checked', false)
                checkALl=false
            }
        })
        if(checkALl) {
            $('#checkbox-all-waiting-payment').prop('checked', true)
        }
        let total= $('#total-count-waiting-payment').text().split('/')[0]
        $('#total-count-waiting-payment').text(parseInt(total)+1+'/'+$('#total-count-waiting-payment').text().split('/')[1])
    } else {
        let total= $('#total-count-waiting-payment').text().split('/')[0]
        $('#total-count-waiting-payment').text(parseInt(total)-1+'/'+$('#total-count-waiting-payment').text().split('/')[1])
        $('#checkbox-all-waiting-payment').prop('checked', false)
    }
}

async function checkAllWaitingConfirmPaymentBill(r) {
    if (r.is(':checked') === true) {
        await tableWaitingConfirmPayment.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(8)').find('input').prop('checked', true);
        });
    } else {
        await tableWaitingConfirmPayment.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(8)').find('input').prop('checked', false);
        });
    }

}

/**
 * Table Chờ chi
 * Event chọn check box
 */
function paymentPaymentBill(r) {
    if (savePaymentPaymentBill === 1) return false;
    let boxConfirm = null;
    if ($('#level-template').val() > 0) {
        let cash_flow_selected = r.data('cash-flow-time');
        boxConfirm = renderListFundPaymentBill('Chi tiền ?', 'question', 'select-payment-fund-payment-bill-treasurer', $('#select-payment-fund-payment-bill-treasurer'), cash_flow_selected)
    } else {
        let title = 'Chi tiền ?',
            content = '',
            icon = 'question';
        boxConfirm = sweetAlertComponent(title, content, icon)
    }
    boxConfirm
        .then(async (result) => {
            if (result.value) {
                savePaymentPaymentBill = 1
                let method = 'post',
                    url = 'payment-bill-treasurer.payment',
                    params = null,
                    data = {
                        branch: $('#select-branch-payment-bill-treasurer').val(),
                        id: r.data('id'),
                        cash_flow_time: $('#select-payment-fund-payment-bill-treasurer').val()
                    }
                let res = await axiosTemplate(method, url, params, data);
                savePaymentPaymentBill = 0
                let text = $('#success-payment-data-to-server').text();
                switch (res.data.status) {
                    case 200:
                        SuccessNotify(text);
                        $('.check-all-bill-payment').prop('checked', false)
                        loadingData();
                        break;
                    case 500:
                        text = $('#error-post-data-to-server').text();
                        if (res.data.message !== null) text = res.data.message;
                        ErrorNotify(text);
                        break;
                    default:
                        text = $('#error-post-data-to-server').text();
                        if (res.data.message !== null) text = res.data.message;
                        WarningNotify(text);
                }
            }
        })
}

async function paymentMultiPaymentBill(r) {
    if (saveConfirmPaymentPaymentBill === 1) return false;
    let boxConfirm = null;
    if ($('#level-template').val() > 0) {
        boxConfirm = renderListFundPaymentBill('Duyệt chi tất cả phiếu đã chọn ?', 'question', 'select-multi-fund-payment-bill-treasurer', $('#select-multi-fund-payment-bill-treasurer'))
    } else {
        let title = 'Duyệt chi tất cả phiếu đã chọn?',
            content = '',
            icon = 'question';
        boxConfirm = sweetAlertComponent(title, content, icon)
    }
    boxConfirm
        .then(async result => {
            if (result.value) {
                saveConfirmPaymentPaymentBill = 1;
                let idPaymentBill = [];
                await tableWaitingPayment.rows().every(function () {
                    let row = $(this.node());
                    if (row.find('td:eq(8)').find('input').is(':checked')) {
                        idPaymentBill.push(row.find('td:eq(8)').find('input').val());
                    }
                });
                let method = 'post',
                    url = 'payment-bill-treasurer.payment-multi',
                    params = null,
                    data = {
                        branch: $('#select-branch-payment-bill-treasurer').val(),
                        id: idPaymentBill,
                        cash_flow_time: $('#select-multi-fund-payment-bill-treasurer').val()
                    };
                let res = await axiosTemplate(method, url, params, data, [$('#table-waiting-payment-payment-treasurer')]);
                saveConfirmPaymentPaymentBill = 0;
                let text;
                switch (res.data.status) {
                    case 200:
                        text = $('#success-confirm-data-to-server').text();
                        SuccessNotify(text);
                        hideCheckAllWaitingPaymentBill()
                        loadingData();
                        break;
                    case 400:
                        if (res.data.message !== null) text = 'Vui lòng chọn phiếu chi cần duyệt!';
                        WarningNotify(text);
                        break;
                    case 500:
                        text = $('#error-post-data-to-server').text();
                        if (res.data.message !== null) text = res.data.message;
                        ErrorNotify(text);
                        break;
                    default:
                        text = $('#error-post-data-to-server').text();
                        if (res.data.message !== null) text = res.data.message;
                        WarningNotify(text);
                }
            }
        })
}

async function checkWaitingPaymentBill() {
    let i = 0;
    let x = 0;
    await tableWaitingPayment.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(8)').find('input').is(':checked') === true) {
            i++;
        }
        x++;
    });
    if (i === x) {
        $('#check-all-waiting-payment-bill-treasurer').prop('checked', true);
    } else {
        $('#check-all-waiting-payment-bill-treasurer').prop('checked', false);
    }
}

async function checkAllWaitingPaymentBill(r) {
    if (r.is(':checked') === true) {
        await tableWaitingPayment.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(8)').find('input').prop('checked', true);
        });
    } else {
        await tableWaitingPayment.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(8)').find('input').prop('checked', false);
        });
    }
}

/**
 * Event tắt mở chọn duyệt tất cả cchờ duyệt
 */

function showCheckAllWaitingConfirmPaymentBill() {
        $('.btn-event-payment-bill').addClass('d-none');
        $('.check-confirm-payment-bill').removeClass('d-none');
        $('.check-all-bill-payment').removeClass('d-none');
        $('.btn-show-check').addClass('d-none');
        $('.btn-confirm-check').removeClass('d-none');
        $('.btn-cancel-check').removeClass('d-none');

        $('.toolbar-button-datatable').css({
            "transition": "all .2s linear",
            "opacity": "0.5",
            "pointer-events": "none"
        });
        $('.checkbox-all-confirm-waiting-payment').removeClass('d-none')
        $('.check-confirm-muti-payment').removeClass('d-none')
}

function hideCheckAllWaitingConfirmPaymentBill() {
        $('.btn-event-payment-bill').removeClass('d-none');
        $('.check-confirm-payment-bill').addClass('d-none');
        $('.check-all-bill-payment').addClass('d-none');
        $('.btn-show-check').removeClass('d-none');
        $('.btn-confirm-check').addClass('d-none');
        $('.btn-cancel-check').addClass('d-none');
        $('.check-confirm-payment-bill input[type="checkbox"]').prop('checked', false);
        $('.check-all-bill-payment input[type="checkbox"]').prop('checked', false);

        $('#total-count-confirm-waiting-payment').text('0/'+$('#total-count-confirm-waiting-payment').text().split('/')[1])
        $('.toolbar-button-datatable').css({"transition": "", "opacity": "", "pointer-events": ""});
        $('#checkbox-all-confirm-waiting-payment').prop('checked', false)
        $('.checkbox-all-confirm-waiting-payment').addClass('d-none')
        $('.check-confirm-muti-payment').addClass('d-none')
}

/**
 * Event tắt mở chọn duyệt tất cả cchờ chi
 */

function showCheckAllWaitingPaymentBill() {
        $('.btn-event-payment-bill').addClass('d-none');
        $('.check-confirm-payment-bill').removeClass('d-none');
        $('.check-all-bill-payment').removeClass('d-none');
        $('.btn-show-check').addClass('d-none');
        $('.btn-confirm-check').removeClass('d-none');
        $('.btn-cancel-check').removeClass('d-none');

        $('.toolbar-button-datatable').css({
            "transition": "all .2s linear",
            "opacity": "0.5",
            "pointer-events": "none"
        });
        $('.checkbox-all-waiting-payment').removeClass('d-none')
        $('.check-muti-payment').removeClass('d-none')
}

function hideCheckAllWaitingPaymentBill() {
        $('.btn-event-payment-bill').removeClass('d-none');
        $('.check-confirm-payment-bill').addClass('d-none');
        $('.check-all-bill-payment').addClass('d-none');
        $('.btn-show-check').removeClass('d-none');
        $('.btn-confirm-check').addClass('d-none');
        $('.btn-cancel-check').addClass('d-none');
        $('.check-confirm-payment-bill input[type="checkbox"]').prop('checked', false);
        $('.check-all-bill-payment input[type="checkbox"]').prop('checked', false);

        $('#total-count-waiting-payment').text('0/'+$('#total-count-waiting-payment').text().split('/')[1])
        $('.toolbar-button-datatable').css({"transition": "", "opacity": "", "pointer-events": ""});
        $('#checkbox-all-waiting-payment').prop('checked', false)
        $('.checkbox-all-waiting-payment').addClass('d-none')
        $('.check-muti-payment').addClass('d-none')
        $('.checkbox-all-waiting-payment').addClass('d-none')
}
