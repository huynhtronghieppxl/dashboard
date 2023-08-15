let fromDateCardsCustomer = $('.from-date-cards-customer').val(), toDateCardsCustomer = $('.to-date-cards-customer').val(),
    checkConfirmCardMembershipTopUp = 0, checkCancelCardMembershipTopUp = 0, tabCurrentCardsCustomer = 1,
tableWaitingConfirmCardMembership, tableConfirmedCardMembership, tableCancelCardMembership, statusCardsCustomer = -1;
$(async function () {
    if(getCookieShared('cards-customer-user-id-' + idSession)){
        let data = JSON.parse(getCookieShared('cards-customer-user-id-' + idSession));
        fromDateCardsCustomer = data.from;
        toDateCardsCustomer = data.to;
        tabCurrentCardsCustomer = data.tab;
        statusCardsCustomer = data.status;
        $('.from-date-cards-customer').val(fromDateCardsCustomer);
        $('.to-date-cards-customer').val(toDateCardsCustomer);
    }
    shortcut.add("F2", function () {
        openModalCreateCards();
    });
    dateTimePickerFromMaxToDate($('.from-date-cards-customer'), $('.to-date-cards-customer'))
    $('#nav-cards-customer li a[data-tab="'+ tabCurrentCardsCustomer +'"]').click();
    $('.select-status-card-customer').val(statusCardsCustomer).trigger('change.select2');
    $('.from-date-cards-customer').on('dp.change', function () {
        $('.from-date-cards-customer').val($(this).val());
    });
    $('.to-date-cards-customer').on('dp.change', function () {
        $('.to-date-cards-customer').val($(this).val());
    });
    $('.search-btn-cards-customer').on('click', function (e) {
        if(!checkDateTimePicker($(this))){
            return false
        }
        updateCookieCardsCustomer();
        loadData();
    });
    $('#nav-cards-customer li a').on('click', function(){
        tabCurrentCardsCustomer = $(this).data('tab');
        updateCookieCardsCustomer();
    })
    $('.select-status-card-customer').on('change',function (){
        statusCardsCustomer = $(this).val();
        updateCookieCardsCustomer();
        loadData();
    })

    if(!$('.select-branch').val()) {
        await updateSessionBrandNew($('.select-brand'));
    }else {
        loadData();
    }
});

function updateCookieCardsCustomer(){
    saveCookieShared('cards-customer-user-id-' + idSession, JSON.stringify({
        'from' : $('.from-date-cards-customer').val(),
        'to' : $('.to-date-cards-customer').val(),
        'tab' : tabCurrentCardsCustomer,
        'status' : statusCardsCustomer
    }))
}

async function loadData() {
    let method = 'get',
        url = 'cards.data',
        branch = $('.select-branch').val(),
        params = {
            branch: branch,
            is_used : $('.select-status-card-customer option:selected').val(),
            from_date : $('.from-date-cards-customer').val(),
            to_date : $('.to-date-cards-customer').val()},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[$(".seemt-main-content")]);
    dataTableCards(res);
    $('#total-record-waiting-confirm-card').text(res.data[3].total_waiting_confirm);
    $('#total-record-confirm-card').text(res.data[3].total_confirm);
    $('#total-record-tab-cancel-card').text(res.data[3].total_cancel);
}

function openModalQrCodeCardMembership(r) {
    console.log("r ",r);
    $('#modal-qr-card-membership').modal('show');
    $('#code-number-qr-card-membership').text(r.data('code'));
    let qr_code = '{"header":"Nạp thẻ","Mã code":"'+ r.data('qr-code') +'"}';
    $('#code-qr-card-membership').qrcode({
        "render": "canvas",
        "width": 200,
        "height": 200,
        "top": 2,
        "ecLevel": 'L',
        "colorDark": "#000000",
        "colorLight": "#ffffff",
        "text": r.data('qr-code'),
    });
    shortcut.add('ESC', function () {
        closeModalQrCodeCardMembership();
    });

    $("#copy-text-code-qr").click(function() {
        let text = $("#code-number-qr-card-membership").text();
        let tempInput = $("<input>");
        $("body").append(tempInput);
        tempInput.val(text).select();
        document.execCommand("copy");
        tempInput.remove();
        SuccessNotify("Đã sao chép mã code thành công!");
    });
}

function closeModalQrCodeCardMembership(){
    $('#modal-qr-card-membership').modal('hide');
    $('#code-qr-card-membership').html('')
}

async function confirmCardMemberShipTopUp(r) {
    if(checkConfirmCardMembershipTopUp === 1) return false;
    let title = 'Duyệt thẻ nạp ?',
        content = '',
        icon =  'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'cards.confirm',
                params = null,
                data = {id: r.data('id')};
            checkConfirmCardMembershipTopUp = 1;
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            checkConfirmCardMembershipTopUp = 0;
            switch(res.data.status) {
                case 200:
                    SuccessNotify($('#success-status-data-to-server').text());
                    removeRowDatatableTemplate(tableWaitingConfirmCardMembership,r,true);
                    addRowDatatableTemplate(tableConfirmedCardMembership,{
                        'customer_name': r.parents('tr').find('td:eq(1)').text(),
                        'customer_phone': r.parents('tr').find('td:eq(2)').text(),
                        'amount': res.data.data.amount,
                        'bonus_amount': res.data.data.bonus_amount,
                        'total_amount': res.data.data.total_amount,
                        'employee_create_name': r.parents('tr').find('td:eq(6)').text(),
                        'created_at': res.data.data.created_at,
                        'branch_name': r.parents('tr').find('td:eq(8)').text(),
                        'status_card': res.data.data.status_card,
                        'action': res.data.data.action,
                        'keysearch': res.data.data.keysearch,
                    })
                    $('#total-record-waiting-confirm-card').text(Number($('#total-record-waiting-confirm-card').text()) - 1);
                    $('#total-record-confirm-card').text(Number($('#total-record-confirm-card').text()) + 1);
                    break;
                case 500:
                    ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify(res.data.message);
            }
        }else{
            checkChangeAcceptTableMaterialData = 0
        }
    })
}

async function cancelCardMemberShipTopUp(r) {
    if(checkCancelCardMembershipTopUp === 1) return false;
    let title = 'Huỷ thẻ nạp ?',
        content = '',
        icon =  'question',
        element = 'id-cancel-card-membership';
    sweetAlertInputComponent(title,element, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'cards.cancel',
                params = null,
                data = {id: r.data('id'), cancel_reason : result.value};
            checkCancelCardMembershipTopUp = 1;
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            checkCancelCardMembershipTopUp = 0;
            switch(res.data.status) {
                case 200:
                    SuccessNotify($('#success-status-data-to-server').text());
                    loadData();
                    break;
                case 500:
                    ErrorNotify($('#error-post-data-to-server').text());
                    break;
                default:
                    WarningNotify(res.data.message);
            }
        }else{
            checkChangeAcceptTableMaterialData = 0
        }
    })
}



async function dataTableCards(data) {
    let fixed_left = 2,
        fixed_right = 2,
        id1 = $('#table-waiting-confirm-card'),
        id2 = $('#table-confirm-card'),
        id3 = $('#table-cancel-card'),
        column2 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'customer_name', name: 'customer_name', className: 'text-left'},
            {data: 'customer_phone', name: 'customer_phone', className: 'text-left'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'bonus_amount', name: 'bonus_amount', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'employee_create_name', name: 'employee_create_name', className: 'text-left'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'branch_name', name: 'branch_name', className: 'text-left'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch',  className: 'd-none'},
        ], column3 = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'customer_name', name: 'customer_name', className: 'text-left'},
            {data: 'customer_phone', name: 'customer_phone', className: 'text-left'},
            {data: 'amount', name: 'amount', className: 'text-right'},
            {data: 'bonus_amount', name: 'bonus_amount', className: 'text-right'},
            {data: 'total_amount', name: 'total_amount', className: 'text-right'},
            {data: 'employee_create_name', name: 'employee_create_name', className: 'text-left'},
            {data: 'created_at', name: 'created_at', className: 'text-center'},
            {data: 'branch_name', name: 'branch_name', className: 'text-left'},
            {data: 'status_card', name: 'status_card', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch',  className: 'd-none'},
        ];
    let option = [
        {
        'title': 'Thêm mới (F2)',
        'icon': 'fa fa-plus text-primary',
        'class': '',
        'function': 'openModalCreateCards',
    }]
    tableWaitingConfirmCardMembership = await DatatableTemplateNew(id1, data.data[0].original.data, column2, vh_of_table, fixed_left, fixed_right, option);
    tableConfirmedCardMembership = await DatatableTemplateNew(id2, data.data[1].original.data, column3, vh_of_table, fixed_left, fixed_right, []);
    tableCancelCardMembership = await DatatableTemplateNew(id3, data.data[2].original.data, column2, vh_of_table, fixed_left, fixed_right, []);
    $(document).on('input paste keyup','input[type="search"]', function (){
        $('#total-record-waiting-confirm-card').text(formatNumber(tableWaitingConfirmCardMembership.rows({'search': 'applied'}).count()))
        $('#total-record-confirm-card').text(formatNumber(tableConfirmedCardMembership.rows({'search': 'applied'}).count()))
        $('#total-record-tab-cancel-card').text(formatNumber(tableCancelCardMembership.rows({'search': 'applied'}).count()))
        searchUpdateIndexCardMembership(tableWaitingConfirmCardMembership)
        searchUpdateIndexCardMembership(tableConfirmedCardMembership)
        searchUpdateIndexCardMembership(tableCancelCardMembership)
    })
}
async function searchUpdateIndexCardMembership(datatable){
    let index = 1;
    await datatable.rows({'search':'applied'}).every(function (){
        let row = $(this.node())
        row.find('td:eq(0)').text(index)
        index++;
    })
}
