let drawTableUnAssignBranch, drawTableAssignBranch, checkSaveAssignBranch, uncheckAllAssignBranch;
$(function () {
    loadData();
    $('#select-branch-assign-warehouse-manage').on('change', async function () {
        await drawTableUnAssignBranch.rows().every(function (index, element) {
            let row = $(this.node());
            if (row.find('td:eq(1)').find('button').attr('data-type') === 1) {
                drawTableAssignBranch.row(row.parents('tr')).remove().draw(false);
            }
        });
        loadDataBranchAssignWarehouse();
    })
})

async function loadData() {
    let method = 'get',
        url = 'assign-warehouse-branch.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$("#table-assign-branch-warehouse-manage")]);
    tableUnAssignBranchWarehouseManage(res.data[0].original.data);
    tableAssignBranchWarehouseManage([]);
    $('#select-branch-assign-warehouse-manage').html(res.data[1]);
}

async function loadDataBranchAssignWarehouse() {
    let method = 'get',
        url = 'assign-warehouse-branch.data-branch-assign-warehouse',
        params = {warehouse: $('#select-branch-assign-warehouse-manage').val()},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$("#table-un-assign-branch-warehouse-manage")]);
    tableAssignBranchWarehouseManage(res.data[0].original.data);
}

async function tableUnAssignBranchWarehouseManage(data) {
    let table = $('#table-un-assign-branch-warehouse-manage'),
        fixed_left = 0,
        fixed_right = 2,
        column = [
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'location', name: 'location', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ];
    drawTableUnAssignBranch = await DatatableTemplateNew(table, data, column, vh_of_table, fixed_left, fixed_right, []);
}


async function tableAssignBranchWarehouseManage(data) {
    let table = $('#table-assign-branch-warehouse-manage'),
        fixed_left = 0,
        fixed_right = 0,
        column = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'name', name: 'name', className: 'text-left'},
            {data: 'location', name: 'location', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
                'title': 'Cập nhật',
                'icon': 'fa fa-upload',
                'class': '',
                'function': 'saveAssignBranch',
            }
        ];
    drawTableAssignBranch = await DatatableTemplateNew(table, data, column, vh_of_table, fixed_left, fixed_right, option);
}

async function checkAssignBranch(r) {
    if ($('#select-branch-assign-warehouse-manage').val() === null) {
        WarningNotify('Vui lòng chọn kho tổng !');
        return false;
    }
    let item = {
        'name': r.parents('tr').find('td:eq(0)').html(),
        'location': r.parents('tr').find('td:eq(1)').html(),
        'action': ' <div class="btn-group btn-group-sm"><button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-type="' + r.parents('tr').find('td:eq(2)').find('button').attr('data-type') + '" onclick="unCheckAssignBranch($(this))" data-id="' + r.parents('tr').find('td:eq(2)').find('button').attr('data-id') + '"><i class="fi-rr-arrow-small-left"></i></button></div>',
        'keysearch': r.parents('tr').find('td:eq(2)').text(),
    };
    addRowDatatableTemplate(drawTableAssignBranch, item);
    drawTableUnAssignBranch.row(r.parents('tr')).remove().draw(false);
}

async function unCheckAssignBranch(r) {
    let item = {
        'name': r.parents('tr').find('td:eq(1)').html(),
        'location': r.parents('tr').find('td:eq(2)').html(),
        'action': ' <div class="btn-group btn-group-sm"> <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  data-type="' + r.attr('data-type') + '" onclick="checkAssignBranch($(this))" data-id="' + r.parents('tr').find('td:eq(0)').find('button').attr('data-id') + '"><i class="fi-rr-arrow-small-right"></i></button></div>',
        'keysearch': r.parents('tr').find('td:eq(3)').text(),
    };
    addRowDatatableTemplate(drawTableUnAssignBranch, item);
    drawTableAssignBranch.row(r.parents('tr')).remove().draw(false);
}

async function checkAllAssignBranch() {
    if ($('#select-branch-assign-warehouse-manage').val() === null) {
        WarningNotify('Vui lòng chọn kho tổng !');
        return false;
    }
    await addAllRowDatatableTemplate(drawTableUnAssignBranch, drawTableAssignBranch, itemCheckAssignBranch)
}

async function unCheckAllAssignBranch() {
    if ($('#select-branch-assign-warehouse-manage').val() === null) {
        WarningNotify('Vui lòng chọn kho tổng !');
        return false;
    }
    await addAllRowDatatableTemplate(drawTableAssignBranch, drawTableUnAssignBranch, itemUnCheckAssignBranch)
}

function itemCheckAssignBranch(row) {
    return {
        'name': row.find('td:eq(0)').html(),
        'location': row.find('td:eq(1)').html(),
        'action': ' <div class="btn-group btn-group-sm"> <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="unCheckAssignBranch($(this))" data-type="' + row.find('td:eq(2) button').attr('data-type') + '" data-id="' + row.find('td:eq(2) button').attr('data-id') + '"><i class="fi-rr-arrow-small-left"></i></button> </div>',
        'keysearch': row.find('td:eq(3)').text(),
    };
}

function itemUnCheckAssignBranch(row) {
    return {
        'name': row.find('td:eq(1)').html(),
        'location': row.find('td:eq(2)').html(),
        'action': ' <div class="btn-group btn-group-sm"> <button type="button" class="tabledit-edit-button btn seemt-btn-hover-gray waves-effect waves-light"  onclick="checkAssignBranch($(this))" data-type="' + row.find('td:eq(0) button').attr('data-type') + '" data-id="' + row.find('td:eq(0) button').attr('data-id') + '"><i class="fi-rr-arrow-small-right"></i></button> </div>',
        'keysearch': row.find('td:eq(3)').text(),
    };
}

async function saveAssignBranch() {
    if (checkSaveAssignBranch === 1) {
        return false;
    }
    if ($('#select-branch-assign-warehouse-manage').val() === null) {
        WarningNotify('Vui lòng chọn kho tổng !');
        return false;
    }
    let branch_id_assign = [],
        branch_id_un_assign = [];
    await drawTableAssignBranch.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(0)').find('button').attr('data-type') == 0) {
            branch_id_assign.push(row.find('td:eq(0)').find('button').attr('data-id'));
        }
    });
    await drawTableUnAssignBranch.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(2)').find('button').attr('data-type') == 1) {
            branch_id_un_assign.push(row.find('td:eq(2)').find('button').attr('data-id'));
        }
    });
    checkSaveAssignBranch = 1;
    let method = 'post',
        url = 'assign-warehouse-branch.assign',
        params = null,
        data = {
            warehouse: $('#select-branch-assign-warehouse-manage').val(),
            branch_id_assign: branch_id_assign,
            branch_id_un_assign: branch_id_un_assign,
        };
    let res = await axiosTemplate(method, url, params, data, [
        $("#table-un-assign-branch-warehouse-manage"),
        $("#table-assign-branch-warehouse-manage"),
    ]);
    checkSaveAssignBranch = 0;
    switch (res.data.status) {
        case 200:
            SuccessNotify('Gán kho chi nhánh thành công');
            await drawTableAssignBranch.rows().every(function (index, element) {
                let row = $(this.node());
                row.find('td:eq(0)').find('button').attr('data-type', 1)
            });
            await drawTableUnAssignBranch.rows().every(function (index, element) {
                let row = $(this.node());
                row.find('td:eq(1)').find('button').attr('data-type', 0)
            });
            break;
        case 500:
            ErrorNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify((res.data.message !== null) ? res.data.message : $('#error-post-data-to-server').text());
    }
}
