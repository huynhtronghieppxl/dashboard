let idConfirmBookingTableManage,
    branchConfirmBookingTableManage, idTableIdBookingUpdateConfirmTable,
    saveConfirmBookingTableManage = 0, idAreaBookingUpdateConfirmTable,
    tableDataBookingManage, idBranchBookingUpdateConfirmTable,
    thisConfirmBookingManage, idBookingManageUpdateConfirmTable, checkChangeAcceptTableMaterialData = 0;

function openModalTableBookingTableManage(r) {
    thisConfirmBookingManage = r;
    $('#modal-confirm-booking-table-manage').modal('show');
    removeAllValidate();
    $('#area-confirm-booking-table-manage, #table-confirm-booking-table-manage').select2({
        dropdownParent: $('#modal-confirm-booking-table-manage'),
    });
    shortcut.add('ESC', function () {
        closeModalTableBookingTableManage();
    });
    shortcut.add('F4', function () {
        saveModalTableBookingTableManage();
    });
    let id = r.data('id');
    idConfirmBookingTableManage = id;
    dataConfirmTableBookingTableManage(id);

    $('#area-confirm-booking-table-manage').unbind('select2:select').on('select2:select', function () {
        dataTableTableBookingTableManage();
    })
}

async function acceptSetUpTableBookingTableManage(r) {
    if(checkChangeAcceptTableMaterialData === 1) return false;
    let title = 'Bạn muốn mở bàn và setup cho phiếu đặt chỗ này không ?',
        content = '',
        icon =  'question';
    sweetAlertComponent(title, content, icon).then(async (result) => {
        if (result.value) {
            let method = 'post',
                url = 'booking-table.accept-setup',
                params = null,
                data = {id: r.data('id'), branch_id: r.data('branch')};
            checkChangeAcceptTableMaterialData = 1;
            let res = await axiosTemplate(method, url, params, data, [$('#content-body-techres')]);
            checkChangeAcceptTableMaterialData = 0;
            switch(res.data.status) {
                case 200:
                    SuccessNotify($('#success-status-data-to-server').text());
                    r.parents('tr').find('td:eq(9)').html(res.data.data.status_text);
                    r.parents('td').html(res.data.data.action);
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
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover',
            container: 'body',
            html: true
        });
    })

}

async function dataConfirmTableBookingTableManage(id) {
    let method = 'get',
        url = 'booking-table-manage.data-confirm-table',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $('#table-food-confirm-booking-table-manage'),
        $('#boxlist-confirm-booking-table-manage')
    ]);

    idBookingManageUpdateConfirmTable = res.data[0].id;
    idBranchBookingUpdateConfirmTable = res.data[0].branch.id;
    idAreaBookingUpdateConfirmTable = res.data[0].area_id;
    idTableIdBookingUpdateConfirmTable = res.data[0].tables;
    $('#status-confirm-booking-table-manage').html(res.data[0].status);
    $('#branch-confirm-booking-table-manage').text(res.data[0].branch.name);
    branchConfirmBookingTableManage = res.data[0].branch.id;
    $('#type-confirm-booking-table-manage').text(res.data[0].booking_type_name);
    $('#employee-confirm-booking-table-manage').text(res.data[0].employee.name);
    $('#create-confirm-booking-table-manage').text(res.data[0].created_at);
    $('#booking-confirm-booking-table-manage').text(res.data[0].booking_time);
    $('#area-confirm-booking-table-manage').html(res.data[2]);
    $('#customer-name-confirm-booking-table-manage').text(res.data[0].customer_name);
    $('#customer-phone-confirm-booking-table-manage').text(res.data[0].customer_phone);
    $('#number-confirm-booking-table-manage').text(res.data[0].number_slot);
    $('#deposit-amount-confirm-booking-table-manage').text(res.data[0].deposit_amount);
    $('#receive-deposit-time-confirm-booking-table-manage').text(res.data[0].receive_deposit_time);
    $('#return-deposit-amount-confirm-booking-table-manage').text(res.data[0].return_deposit_amount);
    $('#return-deposit-time-confirm-booking-table-manage').text(res.data[0].return_deposit_time);
    $('#total-final-confirm-booking-table-manage').text(res.data[0].total_amount);
    $('#note-confirm-booking-table-manage').val(res.data[0].note);
    $('#orther-requirements-confirm-booking-table-manage').val(res.data[0].orther_requirements);
    let id_table = $('#table-food-confirm-booking-table-manage'),
        scroll_Y = '40vh',
        fixed_left = 2,
        fixed_right = 1,
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '5%'},
            {data: 'avatar', name: 'avatar', className: 'text-center'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
            {data: 'total_amount', name: 'total_amount', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ];
    tableDataBookingManage = await DatatableTemplateNew(id_table, res.data[1].original.data, columns, scroll_Y, fixed_left, fixed_right);
}

async function dataTableTableBookingTableManage() {
    let method = 'get',
        url = 'booking-table-manage.table',
        area = $('#area-confirm-booking-table-manage').val(),
        params = {
            id: idConfirmBookingTableManage,
            area: area,
            branch: branchConfirmBookingTableManage
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data,[
        $('#table-confirm-booking-table-manage')
    ]);
    $('#table-confirm-booking-table-manage').html(res.data[0]);
    $('#table-confirm-booking-table-manage option:first').trigger('');
}


async function saveModalTableBookingTableManage() {
    if (saveConfirmBookingTableManage !== 0) {
        return false;
    }
    if(!checkValidateSave($('#boxlist-confirm-booking-table-manage'))) return false;
    let area = $('#area-confirm-booking-table-manage').val();
    let table = $('#table-confirm-booking-table-manage').val();
    let method = 'post',
        url = 'booking-table-manage.confirm-table',
        params = null,
        data = {
            id: idConfirmBookingTableManage,
            area: area,
            branch: branchConfirmBookingTableManage,
            table: table
        };
    saveConfirmBookingTableManage = 1;
    let res = await axiosTemplate(method, url, params, data);
    saveConfirmBookingTableManage = 0;
    let text = '';
    switch(res.data.status) {
        case 200:
            text = $('#success-create-data-to-server').text();
            SuccessNotify(text);
            thisConfirmBookingManage.parents('tr').find('td:eq(9)').html(res.data.data.status_text);
            thisConfirmBookingManage.parents('td').html(res.data.data.action);
            closeModalTableBookingTableManage();
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
            if (res.data.message !== null) {
                text = res.data.message;
            }
            WarningNotify(text);
    }
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        container: 'body',
        html: true
    });
}

function closeModalTableBookingTableManage() {
    $('#area-confirm-booking-table-manage').find('option:first').trigger('change.select2');
    $('#table-confirm-booking-table-manage').val('');
    $('#modal-confirm-booking-table-manage').modal('hide');
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        container: 'body',
        html: true
    });
    removeAllValidate();
}
