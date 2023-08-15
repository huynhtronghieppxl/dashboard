let tablePendingEmployeeBonusPunish,
    tabCurrent = 0, timeId = $('.time-bonus-punish-index').val(),
    typeId = $('.select-type-employee-bonus-punish').find(':selected').val(),
    tableConfirmEmployeeBonusPunish,
    tableApprovedEmployeeBonusPunish,
    tableCancelEmployeeBonusPunish,
    thisChangeStatusEmmployeeBonusPunish,
    saveApproveEmployeeBonusPunish = 0, saveCancelEmployeeBonusPunish = 0, saveConfirmEmployeeBonusPunish = 0;
$(function () {
    dateTimePickerMonthYearTemplate($('.time-bonus-punish-index'));
    if(getCookieShared('employee-bonus-punish-user-id-' + idSession)){
        let data = JSON.parse(getCookieShared('employee-bonus-punish-user-id-' + idSession));
        timeId = data.time;
        typeId = data.type;
        tabCurrent = data.tab;
        $('.time-bonus-punish-index').val(timeId)
        $('.select-type-employee-bonus-punish').val(typeId).trigger('change.select2')
    }
    loadData();
    $('.nav-link').on('click', function () {
        tabCurrent  = $(this).data('id')
        updateCookieEmployeeBonusPunish()
    })
    $('.time-bonus-punish-index').on('dp.change', function () {
        timeId = $(this).val();
        $('.time-bonus-punish-index').val($(this).val())
        loadData();
    });
    $('.select-type-employee-bonus-punish').on('select2:select', function () {
        typeId = $(this).val();
        $('.select-type-employee-bonus-punish').val($(this).val()).trigger('change.select2');
        loadData();
    });
    $('.nav-link[data-id="' + tabCurrent + '"]').click();
});

async function loadData() {
    updateCookieEmployeeBonusPunish()
    let type = $('.select-type-employee-bonus-punish').find(':selected').data('value'),
        time = $('.time-bonus-punish-index').val(),
        branch = $('#select-branch-employee-bonus-punish').val(),
        punish = $('.select-type-employee-bonus-punish').find(':selected').data('punish'),
        method = 'get',
        url = 'employee-bonus-punish.data',
        params = {
            time: time,
            type: type,
            branch: branch,
            punish: punish,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#content-body-techres')
    ]);
    await dataTableEmployeeBonusPunish(res);
    dataTotalEmployeeBonusPunish(res.data[3]);
    checkPermissionEmployeeBonusPunish(res.data[4]);
}
function updateCookieEmployeeBonusPunish(){
    saveCookieShared('employee-bonus-punish-user-id-' + idSession, JSON.stringify({
        'tab' : tabCurrent,
        'type' : typeId,
        'time' : timeId,
    }))
}

async function dataTableEmployeeBonusPunish(data) {
    let id2 = $("#table-confirmed-employee-bonus-punish"),
        id3 = $("#table-approved-employee-bonus-punish"),
        id4 = $("#table-cancel-employee-bonus-punish"),
        scroll_Y = vh_of_table,
        fixedLeft = 0,
        fixedRight = 0,
        column = [
            {data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "5%"},
            {data: "name", name: "name", width: "20%"},
            {data: "type_name", name: "type_name", className: "text-center", width: "15%"},
            {data: "bonus", name: "bonus", className: "text-center", width: "15%"},
            {data: "punish", name: "punish", className: "text-center", width: "15%"},
            {data: "note", name: "note", className: "text-center", width: "15%"},
            {data: "time", name: "time", className: "text-center", width: "10%"},
            {data: "status_text", name: "status_text", className: "text-center", width: "10%"},
            {data: "action", name: "action", className: "text-center", width: '5%'},
            {data: "keysearch", className: "d-none"},
        ],
        option = [{
            'title': 'Tạo phiếu thưởng phạt(Một nhân viên)',
            'icon': 'fa fa-plus text-primary',
            'class': '',
            'function': 'openModalCreateEmployeeBonusPunish',
        },
            {
                'title': 'Tạo phiếu thưởng phạt(Nhiều nhân viên)',
                'icon': 'fa fa-gift',
                'class': '',
                'function': 'openModalCreateHolidayEmployeeBonusPunish',
            }];
    tableConfirmEmployeeBonusPunish = await DatatableTemplateNew(id2, data.data[0].original.data, column, scroll_Y, fixedLeft, fixedRight, option);
    tableApprovedEmployeeBonusPunish = await DatatableTemplateNew(id3, data.data[1].original.data, column, scroll_Y, fixedLeft, fixedRight, option);
    tableCancelEmployeeBonusPunish = await DatatableTemplateNew(id4, data.data[2].original.data, column, scroll_Y, fixedLeft, fixedRight, option);

    $(document).on('input paste', '#content-body-techres input[type="search"]', async function () {
        console.log(1)
        $('#total-record-confirmed').text(tableConfirmEmployeeBonusPunish.rows({'search': 'applied'}).count());
        $('#total-record-approved').text(tableApprovedEmployeeBonusPunish.rows({'search': 'applied'}).count());
        $('#total-record-cancel').text(tableCancelEmployeeBonusPunish.rows({'search': 'applied'}).count());

        let totalAmountConfirm = searchTable(tableConfirmEmployeeBonusPunish),
            totalAmountApproved = searchTable(tableApprovedEmployeeBonusPunish),
            totalAmountCancel = searchTable(tableCancelEmployeeBonusPunish)

        $('#total-bonus-amount-confirmed-bonus-punish').text(formatNumber(totalAmountConfirm[0]));
        $('#total-punish-amount-confirmed-bonus-punish').text(formatNumber(totalAmountConfirm[1]));
        $('#total-bonus-amount-approved-bonus-punish').text(formatNumber(totalAmountApproved[0]));
        $('#total-punish-amount-approved-bonus-punish').text(formatNumber(totalAmountApproved[1]));
        $('#total-bonus-amount-cancel-bonus-punish').text(formatNumber(totalAmountCancel[0]));
        $('#total-punish-amount-cancel-bonus-punish').text(formatNumber(totalAmountCancel[1]));
    })

}

function searchTable(datatable){
    let totalBonus = 0, totalPunish = 0;
    datatable.rows({'search': 'applied'}).every(function () {
        let row = $(this.node());
        totalBonus += removeformatNumber(row.find('td:eq(3)').text());
        totalPunish += removeformatNumber(row.find('td:eq(4)').text());
    })
    return [totalBonus, totalPunish]
}


function dataTotalEmployeeBonusPunish(data) {
    $('#total-record-pending').text(data.total_record_pending);
    $('#total-record-confirmed').text(data.total_record_confimed);
    $('#total-record-approved').text(data.total_record_approved);
    $('#total-record-cancel').text(data.total_record_cancel);
    $('#total-bonus-amount-pending-bonus-punish').text(data.total_bonus_pending);
    $('#total-punish-amount-pending-bonus-punish').text(data.total_punish_pending);
    $('#total-bonus-amount-confirmed-bonus-punish').text(data.total_bonus_confimed);
    $('#total-punish-amount-confirmed-bonus-punish').text(data.total_punish_confimed);
    $('#total-bonus-amount-approved-bonus-punish').text(data.total_bonus_approved);
    $('#total-punish-amount-approved-bonus-punish').text(data.total_punish_approved);
    $('#total-bonus-amount-cancel-bonus-punish').text(data.total_bonus_cancel);
    $('#total-punish-amount-cancel-bonus-punish').text(data.total_punish_cancel);
}

function checkPermissionEmployeeBonusPunish(data) {
    tableConfirmEmployeeBonusPunish.rows().every(function (i, v) {
        let x = $(this.node());
        if (data[0] === true) x.find('td:eq(8)').find('.btn-manage-employee-bonus-punish').removeClass('d-none');
        if (data[2] === true) x.find('td:eq(8)').find('.btn-approve-employee-bonus-punish').removeClass('d-none');
    })
}

function confirmEmployeeBonusPunish(id, branch_id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-grd-primary btn-sweet-alert',
            cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
        },
        buttonsStyling: false
    });
    let text = 'Xác nhận phiếu thưởng phạt ?';
    let icon = 'success';
    swalWithBootstrapButtons.fire({
        title: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Hủy',
        reverseButtons: true,
        focusConfirm: true
    }).then(async (result) => {
        if (result.value) {
            saveConfirmEmployeeBonusPunish = 1;
            let method = 'post',
                url = 'employee-bonus-punish.confirm',
                params = null,
                data = {
                    id: id,
                    branch_id: branch_id
                };
            let res = await axiosTemplate(method, url, params, data);
            saveConfirmEmployeeBonusPunish = 0;
            if (res.data.status === 200) {
                let msg_success = 'Xác nhận phiếu thưởng phạt thành công !';
                loadData();
                SuccessNotify(msg_success);
            } else {
                ErrorNotify('Xác nhận phiếu thưởng phạt thất bại !');
            }
        } else {
            return false;
        }
    })
}

function approveEmployeeBonusPunish(id, branch_id, r) {
    thisChangeStatusEmmployeeBonusPunish = r;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-grd-primary btn-sweet-alert',
            cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
        },
        buttonsStyling: false
    });
    let text = 'Duyệt phiếu thưởng phạt ?';
    let icon = 'question';
    swalWithBootstrapButtons.fire({
        title: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Hủy',
        reverseButtons: true,
        focusConfirm: true
    }).then(async (result) => {
        if (result.value) {
            saveApproveEmployeeBonusPunish = 1
            let method = 'post',
                url = 'employee-bonus-punish.approve',
                params = null,
                data = {
                    id: id,
                    branch_id: branch_id
                };
            let res = await axiosTemplate(method, url, params, data);
            saveApproveEmployeeBonusPunish = 0
            if (res.data.status === 200) {
                let msg_success = 'Duyệt phiếu thưởng phạt thành công !';
                removeRowDatatableTemplate(tableConfirmEmployeeBonusPunish, thisChangeStatusEmmployeeBonusPunish, true);
                addRowDatatableTemplate(tableApprovedEmployeeBonusPunish, {
                    name: res.data.data.name,
                    type_name: res.data.data.type_name,
                    bonus: res.data.data.bonus,
                    punish: res.data.data.punish,
                    note: res.data.data.note,
                    time: res.data.data.time,
                    status_text: res.data.data.status_text,
                    action: res.data.data.action,
                    keysearch: res.data.data.keysearch,
                })
                $('#total-record-confirmed').text(parseInt($('#total-record-confirmed').text()) - 1);
                $('#total-record-approved').text(parseInt($('#total-record-approved').text()) + 1);
                SuccessNotify(msg_success);
            } else if (res.data.status >= 500) {
                ErrorNotify(res.data.message);
                return false;
            } else if (res.data.status > 400) {
                WarningNotify(res.data.message);
                return false;
            } else {
                ErrorNotify('Duyệt phiếu thưởng phạt thất bại !');
                return res;
            }
        } else {
            return false;
        }
    })
}

function cancelEmployeeBonusPunish(id, branch_id, r) {
    thisChangeStatusEmmployeeBonusPunish = r;
    let title = 'Hủy phiếu thưởng phạt ?',
        content = '',
        icon = 'question';
    sweetAlertInputComponent(title,'id-cancel-update-salary-employee-bonus', content, icon).then(async (result) => {
        if (result.isConfirmed) {
            saveCancelEmployeeBonusPunish = 1
            let method = 'post',
                url = 'employee-bonus-punish.cancel',
                reason = result.value,
                params = null,
                data = {
                    id: id,
                    branch_id: branch_id,
                    reason: reason
                };
            let res = await axiosTemplate(method, url, params, data);
            saveCancelEmployeeBonusPunish = 0
            let text;
            switch (res.data.status){
                case 200:
                    text = 'Hủy phiếu thưởng phạt thành công !';
                    removeRowDatatableTemplate(tableConfirmEmployeeBonusPunish, thisChangeStatusEmmployeeBonusPunish, true);
                    addRowDatatableTemplate(tableCancelEmployeeBonusPunish, {
                        name: res.data.data.name,
                        type_name: res.data.data.type_name,
                        bonus: res.data.data.bonus,
                        punish: res.data.data.punish,
                        note: res.data.data.note,
                        time: res.data.data.time,
                        status_text: res.data.data.status_text,
                        action: res.data.data.action,
                        keysearch: res.data.data.keysearch,
                    })
                    $('#total-record-confirmed').text(parseInt($('#total-record-confirmed').text()) - 1);
                    $('#total-record-cancel').text(parseInt($('#total-record-cancel').text()) + 1);
                    SuccessNotify(text);
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null) {
                        text = res.data.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (res.data.message !== null)
                        text = res.data.message;
                    WarningNotify(text);
            }
        }
    })
    // const swalWithBootstrapButtons = Swal.mixin({
    //     customClass: {
    //         confirmButton: 'btn btn-grd-primary btn-sweet-alert',
    //         cancelButton: 'btn btn-grd-disabled btn-sweet-alert'
    //     },
    //     buttonsStyling: false
    // });
    // let text = 'Hủy phiếu thưởng phạt ?';
    // // let icon = 'question';
    // swalWithBootstrapButtons.fire({
    //     title: text,
    //     icon: icon,
    //     showCancelButton: true,
    //     confirmButtonText: 'Đồng ý',
    //     cancelButtonText: 'Hủy',
    //     reverseButtons: true,
    //     focusConfirm: true
    // }).then(async (result) => {
    //     if (result.value) {
    //         saveCancelEmployeeBonusPunish = 1
    //         let method = 'post',
    //             url = 'employee-bonus-punish.cancel',
    //             params = null,
    //             data = {
    //                 id: id,
    //                 branch_id: branch_id
    //             };
    //         let res = await axiosTemplate(method, url, params, data);
    //         saveCancelEmployeeBonusPunish = 0
    //         if (res.data.status === 200) {
    //             let msg_success = 'Hủy phiếu thưởng phạt thành công !';
    //             loadData();
    //             SuccessNotify(msg_success);
    //         } else {
    //             ErrorNotify('Hủy phiếu thưởng phạt thất bại !');
    //         }
    //     } else {
    //         return false;
    //     }
    // })
}
