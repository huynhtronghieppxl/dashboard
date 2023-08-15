let dataMaterialTableChecklist,
    branchIdUpdatePeriodChecklistGoodsInternalManage,
    checkSaveUpdatePeriodChecklistGoodsInternalManage,
    idUpdatePeriodChecklistGoodsInternalManage,checkCancelUpdatePeriodChecklistGoodsInternalManage = 0;
async function openUpdatePeriodChecklistGoodsInternalManage(id, creator_type) {
    if(creator_type === 2) {
        $('#modal-update-period-checklist-goods-internal-manage').modal('show');
        checkSaveUpdatePeriodChecklistGoodsInternalManage = 0;
        shortcut.add('F4', function () {
            saveModalUpdatePeriodChecklistGoodsInternalManage();
        });
        shortcut.add('ESC', function () {
            closeModalUpdatePeriodChecklistGoodsInternalManage();
        });
        $(document).on('input paste', '.confirm-quantity', function () {
            let confirm = removeformatNumber($(this).val()),
                quantity = removeformatNumber($(this).parents('tr').find('td:eq(1)').text());
            $(this).parents('tr').find('td:eq(3)').text(formatNumber(checkDecimal(confirm - quantity)));
        });
        idUpdatePeriodChecklistGoodsInternalManage = id;
        dataUpdatePeriodChecklistGoodsInternalManage(id);
    }else {
        openUpdateChecklistGoodsInternalManage(id, 1)
    }
}

async function dataUpdatePeriodChecklistGoodsInternalManage(id) {
    let method = 'get',
        url = 'checklist-goods-internal-manage.data-update',
        params = {id: id},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#table-material-update-period-checklist-goods-internal-manage_wrapper'), $('#box-list-update-period-checklist-goods-internal-manage')]);
    branchIdUpdatePeriodChecklistGoodsInternalManage = res.data[1].data.branch_id;
    $('#branch-update-period-checklist-goods-internal-manage').text(res.data[1].data.branch_name);
    $('#code-update-period-checklist-goods-internal-manage').text(res.data[1].data.code);
    $('#inventory-update-period-checklist-goods-internal-manage').text(res.data[1].data.inventory);
    $('#type-update-period-checklist-goods-internal-manage').text(res.data[1].data.type === 1 ?  'Kiểm kê ngày' : 'Kiểm kê kỳ');

    $('#employee-create-update-period-checklist-goods-internal-manage').text(res.data[1].data.employee_create.name);
    $('#employee-create-update-period-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[1].data.employee_create.id +')');
    $('#create-update-period-checklist-goods-internal-manage').text(res.data[1].data.employee_create_at);

    if(res.data[1].data.employee_edit.id) {
        $('#employee-update-update-period-checklist-goods-internal-manage').text(res.data[1].data.employee_edit.name);
        $('#employee-update-update-period-checklist-goods-internal-manage').attr('onclick' , 'openModalInfoEmployeeManage('+ res.data[1].data.employee_edit.id +')');
        $('#update-update-period-checklist-goods-internal-manage').text(res.data[1].data.employee_update_at);
    }else {
        $('#employee-update-update-period-checklist-goods-internal-manage').text('---');
    }
    $('#note-from-kitchen-update-period-checklist-goods-internal-manage').text(res.data[1].data.creator_type === 1 ? res.data[1].data.employee_create_note : '---');
    $('#note-update-period-checklist-goods-internal-manage').val(res.data[1].data.creator_type === 1 ? res.data[1].data.employee_update_note : res.data[1].data.employee_create_note);
    dataTableUpdatePeriodCheckListGoodsInternalDayManage(res.data[0].original.data);
}

async function dataTableUpdatePeriodCheckListGoodsInternalDayManage(data) {
    let tableMaterialUpdatePeriodCheckListGoodsInternal = $('#table-material-update-period-checklist-goods-internal-manage'),
        fixed_left = 0,
        fixed_right = 0,
        columns = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'quantity', name: 'quantity', className: 'text-center'},
            {data: 'confirm_quantity', name: 'confirm_quantity', className: 'text-center'},
            {data: 'deficiency_system', name: 'deficiency_system', className: 'text-center'},
            {data: 'confirm_note', name: 'confirm_note', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ], option = [];
    dataMaterialTableChecklist = await DatatableTemplateNew(tableMaterialUpdatePeriodCheckListGoodsInternal, data, columns, '50vh', fixed_left, fixed_right, option);
}

async function saveModalUpdatePeriodChecklistGoodsInternalManage() {
    if (checkSaveUpdatePeriodChecklistGoodsInternalManage === 1) return false;
    if (!checkValidateSave($('#modal-update-period-checklist-goods-internal-manage'))) return false;
    let tableData = [];
    await dataMaterialTableChecklist.rows().every(function (index, element) {
        let row = $(this.node());
        tableData.push({
            "id" : row.find('button').data('material-id'),
            "quantity" : removeformatNumber(row.find('td:eq(2)').find('input').val()),
            "note": row.find('td:eq(4)').find('input').val(),
            "user_input_unit_type": row.find('td:eq(0)').find('div').data('cate-type-parent') === 2 ? 2 : 1,
        })
    });
    checkSaveUpdatePeriodChecklistGoodsInternalManage = 1;
    let method = 'post',
        url = 'checklist-goods-internal-manage.update',
        params = null,
        data = {
            "creator_type" : 2,
            details_material: tableData,
            id: idUpdatePeriodChecklistGoodsInternalManage,
            confirm_note: $('#note-update-period-checklist-goods-internal-manage').val(),
        };
    let res = await axiosTemplate(method, url, params, data, [$('#modal-update-period-checklist-goods-internal-manage')]);
    checkSaveUpdatePeriodChecklistGoodsInternalManage = 0;
    if (res.data.status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        loadData();
        closeModalUpdatePeriodChecklistGoodsInternalManage();
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data.message !== null) {
            text = res.data.message;
        }
        WarningNotify(text);
    }
}

function cancelUpdatePeriodChecklistGoodsInternalManage() {
    if (checkCancelUpdatePeriodChecklistGoodsInternalManage === 1) return false;
    let title = 'Huỷ phiếu kiểm kê',
        content = '',
        icon = 'warning';
    sweetAlertInputComponent(title, 'id-cancel-period', content, icon).then(async (result) => {
        if (result.value) {
            checkCancelUpdatePeriodChecklistGoodsInternalManage = 1;
            let method = 'post',
                url = 'checklist-goods-internal-manage.cancel',
                params = null,
                data = {
                    id: idUpdatePeriodChecklistGoodsInternalManage,
                    reason:result.value,
                    status: 3,
                    is_export_inventory_next_month: 0
            };
            let res = await axiosTemplate(method, url, params, data, [
                $('#loading-update-period-checklist-goods-internal-manage')
            ]);
            checkCancelUpdatePeriodChecklistGoodsInternalManage = 0;
            let text = $('#success-cancel-data-to-server').text();
            switch (res.data.status){
                case 200:
                    SuccessNotify(text);
                    closeModalUpdatePeriodChecklistGoodsInternalManage();
                    loadData();
                    break;
                case 500:
                    text = $('#error-post-data-to-server').text();
                    if (data.data.message !== null) {
                        text = data.data.message;
                    }
                    ErrorNotify(text);
                    break;
                default:
                    text = $('#error-post-data-to-server').text();
                    if (data.data.message !== null) {
                        text = data.data.message;
                    }
                    WarningNotify(text);
            }

        }
    })
}

function closeModalUpdatePeriodChecklistGoodsInternalManage() {
    shortcut.remove('ESC');
    shortcut.remove('F4');
    $('#modal-update-period-checklist-goods-internal-manage').modal('hide');
    $('#branch-update-period-checklist-goods-internal-manage').text('---');
    $('#code-update-period-checklist-goods-internal-manage').text('---');
    $('#inventory-update-period-checklist-goods-internal-manage').text('---');
    $('#employee-create-update-period-checklist-goods-internal-manage').text('---');
    $('#create-update-period-checklist-goods-internal-manage').text('---');
    $('#employee-update-update-period-checklist-goods-internal-manage').text('---');
    $('#update-update-period-checklist-goods-internal-manage').text('---');
    $('#note-create-period-checklist-goods-internal-manage').val('');
    countCharacterTextarea();
}
