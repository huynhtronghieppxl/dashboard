let tableKitchenReturnInventoryInternalManage, tableBarReturnInventoryInternalManage,
    tableFoodEmployeeReturnInventoryInternalManage, tableBusinessEmployeeReturnInventoryInternalManage,
    fromReturnInventory = $('.from-date-return-inventory-internal-manage').val(),
    toReturnInventory = $('.to-date-return-inventory-internal-manage').val(),
    tabActiveReturnInventory = 1;
$(function () {
    dateTimePickerFromMaxToDate($('.from-date-return-inventory-internal-manage'), $('.to-date-return-inventory-internal-manage'))
    $('#nav-tab-return-inventory-internal-manage .nav-link').on('click', function (){
        tabActiveReturnInventory = $(this).attr('data-id')
        updateCookieReturnInventory()
    })
    if(getCookieShared('return-inventory-internal-manage-user-id-' + idSession)){
        let dataCookie = JSON.parse(getCookieShared('return-inventory-internal-manage-user-id-' + idSession));
        fromReturnInventory = dataCookie.from;
        toReturnInventory = dataCookie.to;
        tabActiveReturnInventory = dataCookie.tab;

        $('.from-date-return-inventory-internal-manage').val(fromReturnInventory);
        $('.to-date-return-inventory-internal-manage').val(toReturnInventory)
    }
    $('.search-btn-return-inventory-internal-manage').on('click', function () {
        if(!checkDateTimePicker($(this))) return false
        fromReturnInventory = $('.from-date-return-inventory-internal-manage').val();
        toReturnInventory = $('.to-date-return-inventory-internal-manage').val();
        validateDateTemplate($('.from-date-return-inventory-internal-manage'), $('.to-date-return-inventory-internal-manage'), loadData);
    });
    $('.from-date-return-inventory-internal-manage').on('dp.change', function () {
        $('.from-date-return-inventory-internal-manage').val($(this).val());
    });
    $('.to-date-return-inventory-internal-manage').on('dp.change', function () {
        $('.to-date-return-inventory-internal-manage').val($(this).val());
    });
    loadData();
    $('#nav-tab-return-inventory-internal-manage a[data-id="' + tabActiveReturnInventory + '"]').click()
});

function updateCookieReturnInventory(){
    saveCookieShared('return-inventory-internal-manage-user-id-' + idSession, JSON.stringify({
        'tab' : tabActiveReturnInventory,
        'from' : fromReturnInventory,
        'to' : toReturnInventory
    }))
}

async function loadData() {
    updateCookieReturnInventory()
    !$('.select-branch').val() ? await updateSessionBrandNew($('.select-brand')) : false;
    let branch = $('#select-branch-return-inventory-internal').val(),
        from = $('.from-date-return-inventory-internal-manage').val(),
        to = $('.to-date-return-inventory-internal-manage').val(),
        method = 'get',
        url = 'return-inventory-internal-manage.data',
        params = {branch: branch, from: from, to: to},
        data = null;
    let res = await axiosTemplate(method, url, params, data, [
        $('#content-body-techres')
    ]);
    dataTotalReturnInventoryInternalManage(res.data[4]);
    dataTableReturnInventoryInternalManage(res);
}

async function dataTableReturnInventoryInternalManage(data) {
    let kitchenReturnInventoryInternalManage = $('#table-kitchen-return-inventory-internal-manage'),
        barReturnInventoryInternalManage = $('#table-bar-return-inventory-internal-manage'),
        businessEmployeeReturnInventoryInternalManage = $('#table-business-employee-return-inventory-internal-manage'),
        employeeFoodReturnInventoryInternalManage = $('#table-employee-food-return-inventory-internal-manage'),
        columns = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', class: 'text-center', width: '5%'},
            {data: 'code', name: 'code',  className: 'text-left'},
            {data: 'employee', name: 'employee',  className: 'text-left'},
            {data: 'delivery_date', name: 'delivery_date', className: 'text-center'},
            {data: 'total_material', name: 'total_material', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', width: '5%'},
            {data: 'keysearch', className: 'd-none'},
        ],
        option = [
            {
                'title': 'Thêm mới',
                'icon': 'fa fa-plus text-primary',
                'class': '',
                'function': 'openCreateReturnInventoryInternalManage'
            }
        ],
        fixed_left = 0,
        fixed_right = 0;
    tableKitchenReturnInventoryInternalManage = await DatatableTemplateNew(kitchenReturnInventoryInternalManage, data.data[0].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    tableBarReturnInventoryInternalManage = await DatatableTemplateNew(barReturnInventoryInternalManage, data.data[1].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    tableBusinessEmployeeReturnInventoryInternalManage = await DatatableTemplateNew(businessEmployeeReturnInventoryInternalManage, data.data[2].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    tableFoodEmployeeReturnInventoryInternalManage = await DatatableTemplateNew(employeeFoodReturnInventoryInternalManage, data.data[3].original.data, columns, vh_of_table, fixed_left, fixed_right, option);
    $(document).on('input paste', 'input[type="search"]', async function () {
        $('#total-record-kitchen').text(tableKitchenReturnInventoryInternalManage.rows({'search': 'applied'}).count())
        $('#total-record-bar').text(tableBarReturnInventoryInternalManage.rows({'search': 'applied'}).count())
        $('#total-record-business-employee').text(tableBusinessEmployeeReturnInventoryInternalManage.rows({'search': 'applied'}).count())
        $('#total-record-food-employee').text(tableFoodEmployeeReturnInventoryInternalManage.rows({'search': 'applied'}).count())
    })
}

function dataTotalReturnInventoryInternalManage(data) {
    $('#total-record-kitchen').text(data.total_record_kitchen);
    $('#total-record-bar').text(data.total_record_bar);
    $('#total-record-business-employee').text(data.total_record_business_employee);
    $('#total-record-food-employee').text(data.total_record_food_employee);
}
