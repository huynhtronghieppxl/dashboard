let idFoodUpdateFoodBranchManageArea, branchUpdateFoodManageArea, priceUpdateFoodBranchManageArea, tableAreaNotAssignFoodBranchManage, tableAreaAssignFoodBranchManage,
    checkSaveFoodAreaBranchManage = 0;

async function openModalUpdateFoodAreaBranchManage(r) {
    $('#modal-update-food-area-branch-manage').modal('show');
    idFoodUpdateFoodBranchManageArea = r.data('id');
    branchUpdateFoodManageArea = r.data('branch');
    priceUpdateFoodBranchManageArea = r.data('price');
    shortcut.remove('F2');
    shortcut.remove('F3');
    shortcut.add('ESC', function () {
        closeModalUpdateFoodAreaBranchManage();
    });
    dataUpdateFoodArea();
}

async function dataUpdateFoodArea() {
    let method = 'get',
        url = 'food-branch-manage.data-update-food-area',
        params = {
            id: idFoodUpdateFoodBranchManageArea,
            branch: branchUpdateFoodManageArea,
        },
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-update-food-area-branch-manage'),
    ]);
    dataTableAreaNotAssign(res.data[0]);
    dataTableAreaAssign(res.data[1]);
}

async function dataTableAreaNotAssign(data) {
    let id = $('#table-area-not-assign'),
        column = [
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'checkbox', name: 'checkbox', className: 'text-center', width: '5%'},
        ],
        fixed_left = 0,
        fixed_right = 0;
    tableAreaNotAssignFoodBranchManage = await DatatableTemplateNew(id, data.original.data, column, '40vh', fixed_left, fixed_right);
}

async function dataTableAreaAssign(data) {
    let id = $('#table-area-assign'),
        column = [
            {data: 'checkbox', name: 'checkbox', className: 'text-center', width: '5%'},
            {data: 'apply', name: 'apply', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'price', name: 'price', className: 'text-center'},
        ],
        fixed_left = 0,
        fixed_right = 0;
    tableAreaAssignFoodBranchManage = await DatatableTemplateNew(id, data.original.data, column, '40vh', fixed_left, fixed_right);
}

async function checkAreaFood(r) {
    let item = {
        'name': r.parents('tr').find('td:eq(0)').text(),
        'price': '<div class="input-group border-group validate-table-validate">' +
                    '<input value="' + priceUpdateFoodBranchManageArea + '" class="form-control quantity text-right border-0 w-100" data-max="999999999" data-money="1">' +
                    '</div>',
        'apply': `<div class="checkbox-zoom zoom-primary">
                                 <label>
                                     <input type="checkbox" class="edit-price-by-area-food-branch tooltip" >
                                     <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                 </label>
                            </div>`,
        'checkbox': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-right-to-left pointer" onclick="unCheckAreaFood($(this))" data-type="' + r.parents('tr').find('td:eq(1)').find('i').data('type') + '" data-applied = "' + r.parents('tr').find('td:eq(1)').find('i').data('applied') + '" data-id="' + r.parents('tr').find('td:eq(1)').find('i').data('id') + '"></i>',
    };
    addRowDatatableTemplate(tableAreaAssignFoodBranchManage, item);
    tableAreaNotAssignFoodBranchManage.row(r.parents('tr')).remove().draw(false);
}

async function unCheckAreaFood(r) {
    let item = {
        'name': r.parents('tr').find('td:eq(2)').text(),
        'checkbox': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" onclick="checkAreaFood($(this))" data-type="' + r.parents('tr').find('td:eq(0)').find('i').data('type') + '" data-applied = "' + r.parents('tr').find('td:eq(0)').find('i').data('applied') + '" data-id="' + r.parents('tr').find('td:eq(0)').find('i').data('id') + '"></i>',
    };
    addRowDatatableTemplate(tableAreaNotAssignFoodBranchManage, item);
    tableAreaAssignFoodBranchManage.row(r.parents('tr')).remove().draw(false);
}

async function checkAllAreaFood() {
    await addAllRowDatatableTemplate(tableAreaNotAssignFoodBranchManage, tableAreaAssignFoodBranchManage, itemAreaAssignDraw);
}

async function unCheckAllAreaFood() {
    await addAllRowDatatableTemplate(tableAreaAssignFoodBranchManage, tableAreaNotAssignFoodBranchManage, itemAreaNotAssignDraw);
}

function itemAreaAssignDraw(row) {
    return {
        'name': row.find('td:eq(0)').text(),
        'price': '<div class="input-group border-group validate-table-validate">' +
                    '<input value="' + priceUpdateFoodBranchManageArea + '" class="form-control quantity text-right border-0 w-100" data-max="999999999" data-money="1">' +
                '</div>',
        'apply': `<div class="checkbox-zoom zoom-primary">
                                 <label>
                                     <input type="checkbox" class="edit-price-by-area-food-branch tooltip">
                                     <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                 </label>
                            </div>`,
        'checkbox': '<i class=" fa fa-2x fa-arrow-circle-left btn-convert-right-to-left pointer" onclick="unCheckAreaFood($(this))" data-type="' + row.find('td:eq(1)').find('i').data('id') + '" data-id="' + row.find('td:eq(1)').find('i').data('id') + '"></i>',
    }
}

function itemAreaNotAssignDraw(row) {
    return {
        'name': row.find('td:eq(2)').text(),
        'checkbox': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right pointer" onclick="checkAreaFood($(this))" data-type="' + row.find('td:eq(0)').find('i').data('id') + '" data-id="' + row.find('td:eq(0)').find('i').data('id') + '"></i>',
    }
}

async function saveModalUpdateFoodAreaBranchManage() {
    if(checkSaveFoodAreaBranchManage !== 0) return false;
    if(!checkValidateSave($('#modal-update-food-area-branch-manage'))) return false;
    let areaInsert = [], areaDelete = [], foodUpdate = [];
    tableAreaAssignFoodBranchManage.rows().every(function () {
        let x = $(this.node());
        if (x.find('td:eq(0)').find('i').data('type') === 0) {
            areaInsert.push(x.find('td:eq(0)').find('i').data('id'))
        }
        foodUpdate.push({
            food_id: idFoodUpdateFoodBranchManageArea,
            area_id: x.find('td:eq(0)').find('i').data('id'),
            is_applied: (x.find('td:eq(1)').find('input').prop('checked') === true) ? 1 : 0,
            price: removeformatNumber(x.find('td:eq(3)').find('input').val())
        })
    })

    tableAreaNotAssignFoodBranchManage.rows().every(function () {
        let x = $(this.node());
        if (x.find('td:eq(1)').find('i').data('type') === 1) {
            areaDelete.push(x.find('td:eq(1)').find('i').data('id'))
        }
    })
    let method = 'post',
        url = 'food-branch-manage.update-food-area',
        params = null,
        data = {
            branch: branchUpdateFoodManageArea,
            area_insert: areaInsert,
            area_delete: areaDelete,
            id: idFoodUpdateFoodBranchManageArea,
            food_update: foodUpdate,
        };
    checkSaveFoodAreaBranchManage = 1;
    let res = await axiosTemplate(method, url, params, data, [
        $('#loading-update-food-area-branch-manage'),
    ]);
    checkSaveFoodAreaBranchManage = 0;
    if (res.data[0].status === 200 && res.data[1].status === 200) {
        let text = $('#success-update-data-to-server').text();
        SuccessNotify(text);
        closeModalUpdateFoodAreaBranchManage();
    } else if (res.data[0].status !== 200) {
        let text = $('#error-post-data-to-server').text();
        if (res.data[0].message !== null) {
            text = res.data[0].message;
        }
        ErrorNotify(text);
    } else {
        let text = $('#error-post-data-to-server').text();
        if (res.data[1].message !== null) {
            text = res.data[1].message;
        }
        ErrorNotify(text);
    }
}

function closeModalUpdateFoodAreaBranchManage() {
    $('#modal-update-food-area-branch-manage').modal('hide');
    shortcut.remove('ESC');
    shortcut.add('F2', function () {
        openModalCreateFoodManage();
    });
    removeAllValidate();
}
