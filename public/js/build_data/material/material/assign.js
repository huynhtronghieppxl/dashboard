let checkSaveAssignMaterialBranchData = 0,
    tableAllMaterialBranchData = null;

function openModalAssignMaterialBranchData() {
    $('#modal-assign-material-branch-data').modal('show');
    $('#branch-assign-material-branch-data').select2({
        dropdownParent: $('#modal-assign-material-branch-data'),
    });
    addLoading('material-branch-data.data-assign', '#loading-modal-assign-material-branch-data');
    addLoading('material-branch-data.assign', '#loading-modal-assign-material-branch-data');
    shortcut.add("ESC", function () {
        closeModalAssignMaterialBranchData();
    });
    shortcut.add("F4", function () {
        saveModalAssignMaterialBranchData();
    });
    dataAssignMaterialBranchData();
    $('#branch-assign-material-branch-data').on('select2:select', function () {
        dataAssignMaterialBranchData();
    });
}

async function dataAssignMaterialBranchData() {
    let method = 'get',
        url = 'material-branch-data.data-assign',
        branch = $('#branch-assign-material-branch-data').val(),
        params = {branch: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    dataTableAllAssignMaterialBranchData(res.data[0].original.data);
    $('#table-select-assign-material-branch-data tbody').html(res.data[1]);
    $('#total-select-assign-material-branch-data').text(res.data[2]);
    if (res.data[2] === res.data[3]) $('#check-all-material-branch-data').prop('checked', true);
}

async function dataTableAllAssignMaterialBranchData(data) {
    let id = $('#table-all-assign-material-branch-data'),
        scroll_Y = '40vh',
        columns = [
            {data: 'checkbox', name: 'checkbox', class: 'text-center', width: '5%'},
            {data: 'name', name: 'name', class: 'text-center'},
            {data: 'material_category.name', name: 'material_category', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
        ],
        fixed_left = 0,
        fixed_right = 0;
    tableAllMaterialBranchData = await DatatableTemplate(id, data, columns, scroll_Y, fixed_left, fixed_right);
}

function deleteRowAssignMaterialBranchData(r) {
    $('#table-select-assign-material-branch-data tbody tr').eq(r.parents('tr').index()).remove();
    totalSelectAssignMaterialBranchData();
}

function removeCheckAssignMaterialBranchData(id) {
    tableAllMaterialBranchData.rows().every(function (index, element) {
        let row = $(this.node());
        let statusElement = row.find('td:eq(0)').find('input.d-none').val();
        if (parseInt(statusElement) === parseInt(id)) {
            row.find('td:eq(0)').find('input[type="checkbox"]').prop('checked', false);
        }
    });
}

function deleteAllRowAssignMaterialBranchData() {
    $("#table-select-assign-material-branch-data tbody tr").remove();
    $('#total-select-assign-material-branch-data').text('0');
    tableAllMaterialBranchData.rows().every(function (index, element) {
        let row = $(this.node());
        row.find('td:eq(0)').find('input[type="checkbox"]').prop('checked', false);
    });
}

function convertDataAssignMaterialBranchData() {
    $("#table-select-assign-material-branch-data tbody tr").remove();
    tableAllMaterialBranchData.rows().every(function (index, element) {
        let row = $(this.node());
        let checked = row.find('td:eq(0)').find('input[type="checkbox"]:checked').val();
        if (checked === 'on') {
            let id = row.find('td:eq(0)').find('input.d-none').val(),
                loss = row.find('td:eq(0)').find('input.d-none').data('loss'),
                min = row.find('td:eq(0)').find('input.d-none').data('min'),
                price = row.find('td:eq(0)').find('input.d-none').data('price'),
                name = row.find('td:eq(1)').text();
            $('#table-select-assign-material-branch-data tbody').append('<tr>\n' +
                '<td class="text-center">' + name + '<input class="d-none" value="' + id + '"/></td>\n' +
                '<td class="text-center"><input class="form-control" data-table="1000000" data-type="currency-edit" value="' + min + '"/></td>\n' +
                '<td class="text-center"><input class="form-control" data-table="100" data-type="currency-edit" value="' + loss + '"/></td>\n' +
                '<td class="text-center"><input class="form-control" data-table="10000000" data-type="currency-edit" value="' + price + '"/></td>\n' +
                '<td class="text-center"><div class="btn-group-sm"><button class="tabledit-delete-button btn btn-danger waves-effect waves-light" onclick="deleteRowAssignMaterialBranchData($(this)); removeCheckAssignMaterialBranchData(' + id + ')"><span class="icofont icofont-ui-delete"></span></button></div></td>\n' +
                '</tr>');
        }
    });
    totalSelectAssignMaterialBranchData();
}

function checkAllAssignMaterialBranchData() {
    if ($('#check-all-assign-material-branch-data').is(':checked')) {
        tableAllMaterialBranchData.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(0)').find('input[type="checkbox"]').prop('checked', true);
        });
    } else {
        tableAllMaterialBranchData.rows().every(function (index, element) {
            let row = $(this.node());
            row.find('td:eq(0)').find('input[type="checkbox"]').prop('checked', false);
        });
    }
}

function totalSelectAssignMaterialBranchData() {
    let length = $('#table-select-assign-material-branch-data tbody tr').length;
    $('#total-select-assign-material-branch-data').text(length);
}

async function saveModalAssignMaterialBranchData() {
    if (checkSaveAssignMaterialBranchData !== 0) {
        return false;
    }
    let branch = $('#branch-assign-material-branch-data').val();
    let Table = [];
    await $('#table-select-assign-material-branch-data tbody tr').each(function (row, tr) {
        Table[row] = {
            'id': $(tr).find('td:eq(0)').find('input').val(),
            'out_stock_alert_quantity': removeformatNumber($(tr).find('td:eq(1)').find('input').val()),
            'wastage_rate': removeformatNumber($(tr).find('td:eq(2)').find('input').val()),
            'price': removeformatNumber($(tr).find('td:eq(3)').find('input').val()),
        }
    });
    checkSaveAssignMaterialBranchData = 1;
    let method = 'post',
        url = 'material-branch-data.assign',
        params = null,
        data = {
            materials: Table,
            branch: branch
        };
    let res = await axiosTemplate(method, url, params, data);
    checkSaveAssignMaterialBranchData = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-create-data-to-server').text());
            closeModalAssignMaterialBranchData();
            loadData();
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

function closeModalAssignMaterialBranchData() {
    $('#modal-assign-material-branch-data').modal('hide');
    shortcut.remove('ESC');
    shortcut.remove('F4');
}
