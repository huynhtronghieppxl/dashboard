let dataBranchSupplierData = [],
    drawBranchSupplierData,
    isSaveBranchSupplierData = 0,
    saveBranchesSupplierData = 0,
    drawBrandSupplierData,
    dataBrandSupplierData,
    selectBranchSupplier;

$(function () {
    if(getCookieShared('assign-branch-supplier-user-id-' +idSession)){
        let dataCookie = JSON.parse(getCookieShared('assign-branch-supplier-user-id-' +idSession));
        selectBranchSupplier = dataCookie.select;
        $('#select-branch-assign-supplier-data').val(selectBranchSupplier).trigger('change.select2')
    }
    $('#select-branch-assign-supplier-data').on('change', function () {
        selectBranchSupplier = $(this).val()
        updateCookieSelectBranchAssignSupplierData()
        loadData();
    });
    shortcut.add('F4', function () {
        saveBranchSupplierData();
    });
    loadData();
})

function updateCookieSelectBranchAssignSupplierData(){
    saveCookieShared('assign-branch-supplier-user-id-' +idSession, JSON.stringify({
        'select': selectBranchSupplier
    }))
}

async function loadData() {
    await changeBranchAllShared();
    let method = 'get',
        branch = $('#select-branch-assign-supplier-data').val(),
        url = 'branch-assign-supplier-data.data',
        params = {branch_id: branch},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [$('#body-brand-supplier-data'), $('#body-branch-supplier-data')]);
    dataTableSystemSupplierForBranch(res);
    dataBranchSupplierData = await res.data[0].original.data;
    dataBrandSupplierData = await res.data[1].original.data;
}

async function dataTableSystemSupplierForBranch(data) {
    let tableBrand = $('#table-brand-supplier-data'),
        tableBranch = $('#table-branch-supplier-data'),
        scroll_Y = vh_of_table,
        fixed_left = 0,
        fixed_right = 0,
        columnBrand = [
            {data: 'name', name: 'name', className: 'text-center'},
            {data: 'phone', name: 'phone', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center' , width: '10%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        columnBranch = [
            {data: 'action', name: 'action', className: 'text-center' , width: '10%'},
            {data: 'name', name: 'name', className: 'text-center py-2'},
            {data: 'phone', name: 'phone', className: 'text-center'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
                'title': 'Gán toàn bộ',
                'icon': 'fa fa-exchange text-info',
                'class': '',
                'function': 'openModalSaveBrandSupplierForBranches',
            },
            {
                'title': 'Cập nhật',
                'icon': 'fa fa-upload',
                'class': '',
                'function': 'saveBranchSupplierData',
            }
        ];
    drawBrandSupplierData = await DatatableTemplateNew(tableBrand, data.data[1].original.data, columnBrand, scroll_Y, fixed_left, 2, []);
    drawBranchSupplierData = await DatatableTemplateNew(tableBranch, data.data[0].original.data, columnBranch, scroll_Y, 1, fixed_right,option);
}

async function saveBranchSupplierData() {
    if (isSaveBranchSupplierData === 1) return false;
    let supplier_ids = [];
    await drawBranchSupplierData.rows().every(function (index, element) {
        let row = $(this.node());
        supplier_ids.push(row.find('td:eq(0)').find('i').data('id'));
    });
    isSaveBranchSupplierData = 1;
    let method = 'post',
        url = 'branch-assign-supplier-data.update',
        params = null,
        data = {
            supplier_ids: supplier_ids,
            branch_id: $('#select-branch-assign-supplier-data').val()
        };
    let res = await axiosTemplate(method, url, params, data, [$('#body-branch-supplier-data')]);
    isSaveBranchSupplierData = 0;
    switch (res.data.status){
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

function openModalSaveBrandSupplierForBranches() {
    shortcut.add('ESC', function () {
        closeModalSaveBrandSupplierForBranches();
    });
    shortcut.add('F4', function () {
        saveBrandSupplierForBranches();
    });
    $('#modal-assign-brand-supplier-for-branches').modal('show');

    let count = 0;

    $(document).unbind('click').on('click', '.custom-card-value', async function () {
        if ($(this).hasClass('custom-card-value-focus-2')){
            count--;
            $(this).removeClass('custom-card-value-focus-2');
        }else{
            if ($(this).data('id') === -1){
                count = 0;
                $(this).addClass('custom-card-value-focus-2');
                $('.custom-card-value').not(this).removeClass('custom-card-value-focus-2');
            }else{
                count++;
                $('.custom-card-value[data-id="-1"]').removeClass('custom-card-value-focus-2');
                $(this).addClass('custom-card-value-focus-2');
            }
        }

        if (count == $('#choose-branches-for-assign-supplier').data('branch')){
            count = 0;
            $('.custom-card-value[data-id="-1"]').addClass('custom-card-value-focus-2');
            $('.custom-card-value[data-id!="-1"]').removeClass('custom-card-value-focus-2');
        }
    })
}

async function saveBrandSupplierForBranches() {
    if (saveBranchesSupplierData !== 0) {
        return false;
    }
    let branches = [];
    $('#choose-branches-for-assign-supplier .custom-card-value').each(function(){
        if ($(this).hasClass('custom-card-value-focus-2')){
            if ($(this).data('id') == -1){
                branches = [];
                $('#choose-branches-for-assign-supplier .custom-card-value').each(function(){
                    if ($(this).data('id') != -1){
                        branches.push($(this).data('id'));
                    }
                });
            }else{
                branches.push($(this).data('id'));
            }
        }
    });

    saveBranchesSupplierData = 1;
    if (branches.length == 0){
        saveBranchesSupplierData = 0;
        sweetAlertComponent('Vui lòng chọn chi nhánh!', '', 'warning');
        return false;
    }

    let method = 'post',
        url = 'branch-assign-supplier-data.update-branches',
        params = null,
        data = {
            restaurant_brand_id : $('.select-brand').val(),
            branch_ids: branches
        };
    let res = await axiosTemplate(method, url, params, data, [$('#loading-modal-assign-brand-supplier-for-branches')]);

    saveBranchesSupplierData = 0;
    switch (res.data.status){
        case 200:
            SuccessNotify($('#success-update-data-to-server').text());
            closeModalSaveBrandSupplierForBranches();
            loadData();
            break;
        case 500:
            ErrorNotify($('#error-post-data-to-server').text());
            break;
        default:
            WarningNotify(res.data.message);
    }
}

async function checkBranchSupplierData(r) {
    let item = {
        'id': r.parents('tr').find('td:eq(2)').find('i').data('id'),
        'name': r.parents('tr').find('td:eq(0)').html(),
        'phone': r.parents('tr').find('td:eq(1)').text(),
        'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" onclick="unCheckBranchSupplierData($(this))" data-id="' + r.parents('tr').find('td:eq(2)').find('i').data('id') + '"></i>',
        'keysearch': r.parents('tr').find('td:eq(4)').text(),
    };
    addRowDatatableTemplate(drawBranchSupplierData , item);
    drawBrandSupplierData.row(r.parents('tr')).remove().draw(false);
}

async function unCheckBranchSupplierData(r) {
    let item = {
        'id': r.parents('tr').find('td:eq(0)').find('i').data('id'),
        'name': r.parents('tr').find('td:eq(1)').html(),
        'phone': r.parents('tr').find('td:eq(2)').text(),
        'action': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right" onclick="checkBranchSupplierData($(this))" data-id="' + r.parents('tr').find('td:eq(0)').find('i').data('id') + '"></i>',
        'keysearch': r.parents('tr').find('td:eq(4)').text(),

    };
    addRowDatatableTemplate(drawBrandSupplierData ,item);
    drawBranchSupplierData.row(r.parents('tr')).remove().draw(false);
}

async function checkAllBranchSupplierData(r) {
    addAllRowDatatableTemplate(drawBrandSupplierData,drawBranchSupplierData,itemBranchDraw)
}

async function unCheckAllBranchSupplierData(r) {
    addAllRowDatatableTemplate(drawBranchSupplierData,drawBrandSupplierData,itemBrandDraw)
}
function itemBrandDraw(row) {
    return {
        'id': row.find('td:eq(0)').find('i').data('id'),
        'name': row.find('td:eq(1)').html(),
        'phone': row.find('td:eq(2)').text(),
        'action': '<i class="fa fa-2x fa-arrow-circle-right btn-convert-left-to-right" onclick="checkBranchSupplierData($(this))" data-id="' + row.find('td:eq(0)').find('i').data('id') + '"></i>',
        'keysearch': row.find('td:eq(4)').text(),
    }
}
function itemBranchDraw(row) {
    return {
        'id': row.find('td:eq(2)').find('i').data('id'),
        'name': row.find('td:eq(0)').html(),
        'phone': row.find('td:eq(1)').text(),
        'action': '<i class="fa fa-2x fa-arrow-circle-left btn-convert-left-to-right" onclick="unCheckBranchSupplierData($(this))" data-id="' + row.find('td:eq(2)').find('i').data('id') + '"></i>',
        'keysearch': row.find('td:eq(4)').text(),
    }
}

function closeModalSaveBrandSupplierForBranches() {
    $('#modal-assign-brand-supplier-for-branches').modal('hide');
    $('.custom-card-value').removeClass('custom-card-value-focus-2');
}
