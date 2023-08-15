let dataBranchSupplierMaterialData = [],
    drawBranchSupplierMaterialData,
    isSaveBranchSupplierMaterialData = 0,
    drawBrandSupplierMaterialData,
    dataBrandSupplierMaterialData = [],
    selectBranchSupplierMaterial = $('#select-branch-assign-supplier-material-data').val();

$(function () {
    //get cookie
    if(getCookieShared('supplier-material-for-branch-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('supplier-material-for-branch-user-id-' + idSession));
        selectBranchSupplierMaterial = dataCookie.selectBranchSupplierMaterial;
        $('#select-branch-assign-supplier-material-data').val(selectBranchSupplierMaterial).trigger('change.select2')
    }
    $('#select-branch-assign-supplier-material-data').on('change', function () {
        updateCookieSupplierMaterialForBranch();
        loadData();
    })
    shortcut.add('F4', function () {
        saveBranchSupplierMaterialData();
    });
    loadData();
})

//save cookie
function updateCookieSupplierMaterialForBranch(){
    saveCookieShared('supplier-material-for-branch-user-id-' + idSession, JSON.stringify({
        selectBranchSupplierMaterial : $('#select-branch-assign-supplier-material-data').val()
    }))
}

async function loadData() {
    let method = 'get',
        url = 'branch-material-data.data',
        params = {branch: $('#select-branch-assign-supplier-material-data').val()},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#body-brand-supplier-material-data'), $('#body-branch-supplier-material-data')]);
    dataTableSupplierMaterialForBranch(res.data);
    dataBrandSupplierMaterialData = await res.data[0].original.data;
    dataBranchSupplierMaterialData = await res.data[1].original.data;
}

async function dataTableSupplierMaterialForBranch(data) {
    let tableBrand = $('#table-brand-supplier-material-data'),
        tableBranch = $('#table-branch-supplier-material-data'),
        fixed_left = 0,
        fixed_right = 0,
        columnBrand = [
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-center'},
            {data: 'supplier_names', name: 'supplier_names', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        columnBranch = [
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'restaurant_material_name', name: 'restaurant_material_name', className: 'text-center'},
            {
                data: 'restaurant_material_unit_full_name',
                name: 'restaurant_material_unit_full_name',
                className: 'text-center'
            },
            {data: 'material_category_name', name: 'material_category_name', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
            'title': 'Cập nhật',
            'icon': 'fa fa-upload',
            'class': '',
            'function': 'saveBranchSupplierMaterialData',
             }
        ];
    drawBrandSupplierMaterialData = await DatatableTemplateNew(tableBrand, data[0].original.data, columnBrand, vh_of_table, fixed_left, 2);
    drawBranchSupplierMaterialData = await DatatableTemplateNew(tableBranch, data[1].original.data, columnBranch, vh_of_table, 1, fixed_right, option);
}


async function checkSystemSupplierMaterialData(r) {
    let item = {
        'restaurant_material_id': r.parents('tr').find('td:eq(2)').find('i').data('id'),
        'restaurant_material_name': r.parents('tr').find('td:eq(0)').text(),
        'restaurant_material_unit_full_name': r.parents('tr').find('td:eq(2)').find('i').data('unit'),
        'material_category_name': r.parents('tr').find('td:eq(2)').find('i').data('category'),
        'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" data-action="' + r.parents('tr').find('td:eq(2)').find('i').data('action') + '" onclick="unCheckSystemSupplierMaterialData($(this))" data-id="' + r.parents('tr').find('td:eq(2)').find('i').data('id') + '" data-supplier="' + r.parents('tr').find('td:eq(1)').text() + '"></i>',
        'keysearch': r.parents('tr').find('td:eq(3)').text()
    };
    addRowDatatableTemplate(drawBranchSupplierMaterialData, item);
    drawBrandSupplierMaterialData.row(r.parents('tr')).remove().draw(false);
}

async function unCheckSystemSupplierMaterialData(r) {
    let item = {
        'restaurant_material_id': r.parents('tr').find('td:eq(0)').find('i').data('id'),
        'restaurant_material_name': r.parents('tr').find('td:eq(1)').text(),
        'supplier_names': r.parents('tr').find('td:eq(0)').find('i').data('supplier'),
        'action': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right" data-action="' + r.parents('tr').find('td:eq(0)').find('i').data('action') + '" onclick="checkSystemSupplierMaterialData($(this))" data-id="' + r.parents('tr').find('td:eq(0)').find('i').data('id') + '" data-unit="' + r.parents('tr').find('td:eq(2)').text() + '" data-category="' + r.parents('tr').find('td:eq(3)').text() + '"></i>',
        'keysearch': r.parents('tr').find('td:eq(4)').text()
    };
    addRowDatatableTemplate(drawBrandSupplierMaterialData, item);
    drawBranchSupplierMaterialData.row(r.parents('tr')).remove().draw(false);
}

async function checkAllSystemSupplierMaterialData() {
    addAllRowDatatableTemplate(drawBrandSupplierMaterialData, drawBranchSupplierMaterialData, itemBranchDraw);
    $('#btn-check-all-System-supplier-data').removeClass('d-none')
}

async function unCheckAllSystemSupplierMaterialData() {
    addAllRowDatatableTemplate(drawBranchSupplierMaterialData, drawBrandSupplierMaterialData, itemBrandDraw)
}

function itemBrandDraw(r) {
    return {
        'restaurant_material_id': r.find('td:eq(0)').find('i').data('id'),
        'restaurant_material_name': r.find('td:eq(1)').text(),
        'supplier_names': r.find('td:eq(0)').find('i').data('supplier'),
        'action': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right" data-action="' + r.find('td:eq(0)').find('i').data('action') + '" onclick="checkSystemSupplierMaterialData($(this))" data-id="' + r.find('td:eq(0)').find('i').data('id') + '" data-unit="' + r.find('td:eq(2)').text() + '" data-category="' + r.find('td:eq(3)').text() + '"></i>',
        'keysearch': r.parents('tr').find('td:eq(4)').text()
    }

}

function itemBranchDraw(r) {
    return {
        'restaurant_material_id': r.find('td:eq(2)').find('i').data('id'),
        'restaurant_material_name': r.find('td:eq(0)').text(),
        'restaurant_material_unit_full_name': r.find('td:eq(2)').find('i').data('unit'),
        'material_category_name': r.find('td:eq(2)').find('i').data('category'),
        'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" data-action="' + r.find('td:eq(2)').find('i').data('action') + '" onclick="unCheckSystemSupplierMaterialData($(this))" data-id="' + r.find('td:eq(2)').find('i').data('id') + '" data-supplier="' + r.find('td:eq(1)').text() + '"></i>',
        'keysearch': r.parents('tr').find('td:eq(3)').text()
    };
}

async function saveBranchSupplierMaterialData() {
    if (isSaveBranchSupplierMaterialData !== 0) {
        return false;
    }
    isSaveBranchSupplierMaterialData = 1;
    let material_insert = [],
        material_delete = [];
    await drawBranchSupplierMaterialData.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(0)').find('i').data('action') === 0) {
            material_insert.push(row.find('td:eq(0)').find('i').data('id'));
        }
    });
    await drawBrandSupplierMaterialData.rows().every(function (index, element) {
        let row = $(this.node());
        if (row.find('td:eq(2)').find('i').data('action') === 1) {
            material_delete.push(row.find('td:eq(2)').find('i').data('id'));
        }
    });
    let url = 'branch-material-data.update',
        data = {
            restaurant_brand_id: $('.select-brand').val(),
            branch_id: $('#select-branch-assign-supplier-material-data').val(),
            material_insert: material_insert,
            material_delete: material_delete,
        };
    let res = await axiosTemplate('post', url, null, data, [$('#body-branch-supplier-material-data')]);
    isSaveBranchSupplierMaterialData = 0;
    switch(res.data.status) {
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}
