let tableAllHolidayEmployeeBonusPunish = null,
    checkSaveCreateHolidayEmployeeBonusPunish = 0,
    drawDataConvertHolidayEmployeeBonusPunish,
    tableDisSelect,
    tableSelect;

function openModalCreateHolidayEmployeeBonusPunish() {
    $('#modal-create-holiday-employee-bonus-punish-multi').modal('show');
    shortcut.remove("ESC");
    shortcut.add('ESC', function () {
        closeModalCreateHolidayEmployeeBonusPunish();
    });
    shortcut.add('F4', function () {
        saveModalCreateHolidayEmployeeBonusPunish();
    });
    $('#modal-create-holiday-employee-bonus-punish-multi .js-example-basic-single').select2({
        dropdownParent: $('#modal-create-holiday-employee-bonus-punish-multi')
    });
    $('#select-branch-create-holiday-employee-bonus-punish').val($('#select-branch-employee-bonus-punish').val()).trigger('change.select2');
    dateTimePickerMonthYearTemplate($('#time-create-holiday-employee-bonus-punish'));
    $('#modal-create-holiday-employee-bonus-punish-multi select').on('change', function () {
        $('.btn-renew').removeClass('d-none');
    })
    $('#modal-create-holiday-employee-bonus-punish-multi input, #modal-create-holiday-employee-bonus-punish-multi textarea').on('input', function () {
        $('.btn-renew').removeClass('d-none');
    })
    $('#time-create-holiday-employee-bonus-punish').on('dp.change', function () {
        $('.btn-renew').removeClass('d-none');
    })
    $('#note-create-holiday-employee-bonus-punish').text('');
    $('#check-all-holiday-employee-bonus-punish').prop('checked', false);
    $('#select-branch-create-holiday-employee-bonus-punish').unbind('select2:select').on('select2:select', function () {
        dataEmployeeCreateHolidayBonusPunish();
    });
    $('#div-reward-bonus-amount').removeClass('d-none');
    $('#div-reward-bonus-day').addClass('d-none');
    $('#reward-proposer-create-holiday-employee-bonus').on('select2:select', function () {
        switch ($(this).val()) {
            case '1':
                $('#div-reward-bonus-amount').removeClass('d-none');
                $('#div-reward-bonus-day').addClass('d-none');
                break;
            case '10':
                $('#div-reward-bonus-day').removeClass('d-none');
                $('#div-reward-bonus-amount').addClass('d-none');
                break;
            case '3':
                $('#div-reward-bonus-amount').removeClass('d-none');
                $('#div-reward-bonus-day').addClass('d-none');
                break;
            case '11':
                $('#div-reward-bonus-day').removeClass('d-none');
                $('#div-reward-bonus-amount').addClass('d-none');
                break;
        }
    })
    dataEmployeeCreateBonusPunish()
    // dataEmployeeCreateHolidayBonusPunish()

}

async function dataEmployeeCreateHolidayBonusPunish() {
    let method = 'GET',
        branch = $('#select-branch-employee-bonus-punish').val(),
        time = moment($('#time-create-holiday-employee-bonus-punish').val(), 'MM/YYYY').endOf('month').format('DD/MM/YYYY'),
        url = 'employee-bonus-punish.data-employee',
        params = {
            branch: branch,
            time: time,
            restaurant_brand_id: $('#select-brand-employee-bonus-punish').val()
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#proposer-create-holiday-employee-bonus-punish'),
        $('#table-holiday-employee-bonus-punish')
    ]);
    if (res.status === 200) {
        tableEmployeeCreateHolidayBonusPunish(res.data[0].original.data);
        tableConvertEmployeeCreateHolidayBonusPunish([]);
        $('#proposer-create-holiday-employee-bonus-punish').html(res.data[1].proposer)
    }
}


async function tableEmployeeCreateHolidayBonusPunish(data) {
        let id = $('#table-holiday-employee-bonus-punish'),
        scroll_Y = '30vh',
        columns = [
            {data: 'name', className: 'text-left'},
            {data: 'phone', className: 'text-center'},
            {data: 'action', className: 'text-center',  width: '5%'},
            {data: 'keysearch', className: 'd-none text-center'},
        ],
        fixedLeft = 0,
        fixedRight = 0,
        option = [];
    tableDisSelect = await DatatableTemplateNew(id, data, columns, scroll_Y, fixedLeft, fixedRight, option);
}


async function tableConvertEmployeeCreateHolidayBonusPunish() {
    let id = $('#table-convert-holiday-employee-bonus-punish'),
        scroll_Y = '30vh',
        columns = [
            {data: 'action', className: 'text-center', width: '5%'},
            {data: 'name', className: 'text-left'},
            {data: 'phone', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'}
        ],
        fixedLeft = 0,
        fixedRight = 0,
        option = [];
    tableSelect = await DatatableTemplateNew(id, [], columns, scroll_Y, fixedLeft, fixedRight, option);
}

async function selectEmployeeBonusPunish(r){
    $('.btn-renew').removeClass('d-none');
    addRowDatatableTemplate(tableSelect,{
        'action': `<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id=" ${r.data('id')}  "
                                onclick="unSelectEmployeeBonusPunish($(this))">
                            <i class="fi-rr-arrow-small-left"></i>
                        </button>
                    </div>`,
        'name': r.parents('tr').find('td:eq(0)').html(),
        'phone': r.parents('tr').find('td:eq(1)').html(),
        'keysearch': r.parents('tr').find('td:eq(3)').text(),
    })
    tableDisSelect.row(r.parents('tr')).remove().draw(false);
}

async function unSelectEmployeeBonusPunish(r){
    addRowDatatableTemplate(tableDisSelect,{
        'action': `<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id=" ${r.data('id')}  "
                                onclick="selectEmployeeBonusPunish($(this))">
                            <i class="fi-rr-arrow-small-right"></i>
                        </button>
                    </div>`,
        'name': r.parents('tr').find('td:eq(1)').html(),
        'phone': r.parents('tr').find('td:eq(2)').html(),
        'keysearch': r.parents('tr').find('td:eq(3)').text(),
    })
    tableSelect.row(r.parents('tr')).remove().draw(false);
}

async function checkAllCreateHoliday() {
    addAllRowDatatableTemplate(tableDisSelect, tableSelect, itemCheckAllCreateHoliday)
}

async function unCheckAllCreateHoliday() {
    addAllRowDatatableTemplate(tableSelect, tableDisSelect, unItemCheckAllCreateHoliday)
}

function itemCheckAllCreateHoliday(row) {
    return {
        'action': `<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id=" ${row.find('td:eq(2) button').data('id')}  "
                                onclick="unSelectEmployeeBonusPunish($(this))">
                            <i class="fi-rr-arrow-small-left"></i>
                        </button>
                    </div>`,
        'name': row.find('td:eq(0)').html(),
        'phone':row.find('td:eq(1)').html(),
        'keysearch':row.find('td:eq(3)').text(),
    };
}

function unItemCheckAllCreateHoliday(row) {
    return {
        'action': `<div class="btn-group btn-group-sm">
                        <button type="button"
                                class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"
                                data-id=" ${row.find('td:eq(0) button').data('id')}  "
                                onclick="selectEmployeeBonusPunish($(this))">
                            <i class="fi-rr-arrow-small-right"></i>
                        </button>
                    </div>`,
        'name': row.find('td:eq(1)').html(),
        'phone': row.find('td:eq(2)').html(),
        'keysearch': row.find('td:eq(3)').text(),
    }
}

async function saveModalCreateHolidayEmployeeBonusPunish() {
    if (checkSaveCreateHolidayEmployeeBonusPunish === 1) return false;
    if (!checkValidateSave($('#form-header-bonus-punish'))) return false;
    let branch = $('#select-branch-employee-bonus-punish').val(),
        type = $('#reward-proposer-create-holiday-employee-bonus').val(),
        amount = removeformatNumber($('#amount-create-holiday-employee-bonus-punish').val()),
        quantity = removeformatNumber($('#quantity-create-holiday-employee-bonus-punish').val()),
        note = $('#note-create-holiday-employee-bonus-punish').val(),
        proposer_id = $('#proposer-create-holiday-employee-bonus-punish').val(),
        time = $('#time-create-holiday-employee-bonus-punish').val(),
        Table = [];
    await tableSelect.rows().every(function () {
        let row = $(this.node());
        Table.push(row.find('td:eq(0) button').data('id'))
    });
    // let employee = $('#table-convert-holiday-employee-bonus-punish tbody tr td').length;
    if (!Table.length) {
        sweetAlertNotifyComponent('', 'Vui lòng chọn nhân viên để tạo phiếu thưởng / phạt!', 'warning');
        return false;
    }
    checkSaveCreateHolidayEmployeeBonusPunish = 1;
    let method = 'POST',
        url = 'employee-bonus-punish.create-holiday',
        params = null,
        data = {
            branch_id: branch,
            employee_ids: Table,
            time: time,
            amount: amount,
            quantity: quantity,
            note: note,
            proposer_id: proposer_id,
            type: type
        };
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-modal-create-holiday-employee-bonus-punish-multi')
    ]);
    checkSaveCreateHolidayEmployeeBonusPunish = 0;
    let text = $('#success-create-data-to-server').text();
    switch (res.data.status) {
        case 200:
            SuccessNotify(text);
            loadData();
            closeModalCreateHolidayEmployeeBonusPunish();
            break;
        case 205:
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    container: "modal-create-note, modal, popup-swal-205",
                    // confirmButton: 'btn btn-primary btn-sweet-alert',
                    cancelButton: 'swal2-cancel btn btn-grd-disabled btn-sweet-alert swal-button--cancel'
                },
                buttonsStyling: false,
                allowOutsideClick: false,
            });
            swalWithBootstrapButtons.fire({
                title: 'Lương các nhân viên tháng này đã được chốt !',
                icon: 'warning',
                html:`
                            <div class="card-block px-0 seemt-main-content">
                            <div class="table-responsive new-table">
                                <h5 class="text-center font-weight-bold mt-0">${res.data.message}</h5>
                                    <table class="table" id="table-change-status-create-holiday-employee-data">
                                        <thead>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th class="text-left">Tên nhân viên</th>
                                                <th class="text-center">SĐT</th>
                                                <th class="text-center"></th>
                                                <th class="d-none"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>`,
                showConfirmButton: false,
                showCloseButton: false,
                showCancelButton: true,
                confirmButtonText: $('#button-btn-confirm-component').text(),
                cancelButtonText: $('#button-btn-cancel-component').text(),
                reverseButtons: true,
                focusConfirm: true,
            })
            // closeModalCreateHolidayEmployeeBonusPunish()
            drawTableChangeStatusCreateHolidayEmployeeData(res);
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
async function drawTableChangeStatusCreateHolidayEmployeeData(data) {
    let tableChangeStatusCreateHolidayEmployeeData = $('#table-change-status-create-holiday-employee-data'),
        scroll_Y = '300px',
        fixed_left = 0,
        fixed_right = 0,
        columnArea = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '8%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'phone', name: 'phone', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ];
    let dataTableChangeStatusCreateHolidayEmployeeData = await DatatableTemplateNew(tableChangeStatusCreateHolidayEmployeeData, data.data.data.original.data, columnArea, scroll_Y, fixed_left, fixed_right, []);
    $(document).on('input paste','#table-change-status-create-holiday-employee-data_filter input', function (){
        let indexShift = 1;
        dataTableChangeStatusCreateHolidayEmployeeData.rows({'search':'applied'}).every(function () {
            let row = $(this.node())
            row.find('td:eq(0)').text(indexShift)
            indexShift++;
        });
        let keysearch=removeVietnameseString($(this).val())
        dataTableChangeStatusCreateHolidayEmployeeData.column(4).search(keysearch).draw(false);
    })
}
function closeModalCreateHolidayEmployeeBonusPunish() {
    $('#modal-create-holiday-employee-bonus-punish-multi').modal('hide')
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#note-create-holiday-employee-bonus-punish').parents('.form-group').find('.error').remove();
    removeAllValidate();
    resetModalCreateHolidayEmployeeBonusPunish();
}

function resetModalCreateHolidayEmployeeBonusPunish() {
    removeAllValidate()
    $('#note-create-holiday-employee-bonus-punish').parents('.form-group').find('.error').remove();
    $('#amount-create-holiday-employee-bonus-punish').val(100);
    $('#note-create-holiday-employee-bonus-punish').val('');
    $('#quantity-create-holiday-employee-bonus-punish').val(1);
    $('#reward-proposer-create-holiday-employee-bonus').val('1').trigger('change.select2');
    $('#table-holiday-employee-bonus-punish_wrapper tbody td:first-child input').prop('checked', false);
    $('#check-all-holiday-employee-bonus-punish').prop('checked', false);
    $('#time-create-holiday-employee-bonus-punish').val(moment(new Date).format('MM/YYYY'));
    $('.btn-renew').addClass('d-none');
    tableSelect.clear().draw(false);
    tableDisSelect.clear().draw(false);
    // dataEmployeeCreateHolidayBonusPunish()
}
